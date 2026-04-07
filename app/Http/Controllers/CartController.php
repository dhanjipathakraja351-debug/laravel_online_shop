<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CustomersAddress;
use Illuminate\Support\Facades\Auth;
use App\Models\Shipping;
use App\Models\DiscountCoupon;
use App\Mail\OrderPlacedMail;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
   public function addToCart(Request $request)
   {
    $product = Product::findOrFail($request->id);

    // ✅ STOCK CHECK (only addition)
   if ($product->track_qty && $product->qty <= 0) {
    return response()->json([
        'status' => false,
        'message' => 'This product is out of stock'
    ]);
}

    $cart = session()->get('cart', []);

    if (isset($cart[$product->id])) {
        return response()->json([
            'status' => false,
            'message' => 'Item already added to cart'
        ]);
    }

    $cart[$product->id] = [
        "title" => $product->title,
        "price" => $product->price,
        "image" => $product->image,
        "quantity" => 1
    ];

    session()->put('cart', $cart);

    return response()->json([
        'status' => true,
        'message' => 'Item added to cart successfully'
    ]);
}

    public function cart()
    {
        return view('front.cart');
    }

    public function removeCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'status' => true,
            'message' => 'Item removed successfully'
        ]);
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            if ($request->type == 'increase') {
                $cart[$id]['quantity']++;
            }

            if ($request->type == 'decrease') {
                if ($cart[$id]['quantity'] > 1) {
                    $cart[$id]['quantity']--;
                }
            }

            session()->put('cart', $cart);

            return response()->json([
                'status' => true,
                'message' => 'Cart updated successfully'
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }

    public function checkout()
    {
        if (!session()->has('cart') || count(session('cart')) == 0) {
            return redirect()->route('front.cart');
        }

        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to continue checkout');
        }

        return view('front.checkout');
    }

    public function placeOrder(Request $request)
    {
        try {

            if (!session()->has('cart')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart is empty'
                ]);
            }

            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name'  => 'required',
                'email'      => 'required|email',
                'mobile'     => 'required',
                'address'    => 'required',
                'city'       => 'required',
                'state'      => 'required',
                'country'    => 'required',
                'zip'        => 'required',
                'payment_method' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }

            if ($request->payment_method == 'card') {
                $cardValidator = Validator::make($request->all(), [
                    'card_number' => 'required',
                    'cvv' => 'required'
                ]);

                if ($cardValidator->fails()) {
                    return response()->json([
                        'status' => false,
                        'errors' => $cardValidator->errors()
                    ]);
                }
            }

            $cart = session('cart');
            $subtotal = 0;

            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            $shipping = Shipping::where('country_id', $request->country)->first();
            $shippingAmount = $shipping ? $shipping->amount : ($request->shipping ?? 50);

            $coupon = session('coupon');
            $discount = $coupon['discount'] ?? 0;

            $grandTotal = $subtotal + $shippingAmount - $discount;

            // CREATE ORDER
            $order = Order::create([
                'user_id' => Auth::id(),
                'subtotal' => $subtotal,
                'shipping' => $shippingAmount,
                'coupon_code' => $coupon['code'] ?? null,
                'discount' => $discount,
                'grand_total' => $grandTotal,

                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'phone'      => $request->mobile,
                'address'    => $request->address,
                'city'       => $request->city,
                'state'      => $request->state,
                'country'    => $request->country,
                'zip'        => $request->zip,
            ]);

            // SAVE ADDRESS
            CustomersAddress::create([
                'user_id' => Auth::id(),
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'phone'      => $request->mobile,
                'address'    => $request->address,
                'city'       => $request->city,
                'state'      => $request->state,
                'country'    => $request->country,
                'zip'        => $request->zip,
            ]);

            // ORDER ITEMS
            foreach ($cart as $id => $item) {

                $itemTotal = $item['price'] * $item['quantity'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'title' => $item['title'],
                    'price' => $item['price'],
                    'qty' => $item['quantity'],
                    'total' => $itemTotal,
                ]);
            }

            // ✅ LOAD ITEMS FOR EMAIL
            $order->load('orderItems.product');

            // ✅ SEND EMAIL (FIXED)
            Mail::to($order->email)->send(new OrderPlacedMail($order));

            // COUPON UPDATE
            if ($coupon) {
                $couponModel = DiscountCoupon::where('code', $coupon['code'])->first();

                if ($couponModel && $couponModel->max_uses) {
                    $couponModel->decrement('max_uses');
                }
            }

            session()->forget('cart');
            session()->forget('coupon');

            return response()->json([
                'status' => true,
                'message' => 'Order placed successfully!'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getShippingCharge(Request $request)
    {
        if (empty($request->country_id)) {
            return response()->json([
                'amount' => 0
            ]);
        }

        $shipping = Shipping::where('country_id', $request->country_id)->first();

        return response()->json([
            'amount' => $shipping ? $shipping->amount : 50
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $coupon = DiscountCoupon::where('code', $request->code)
            ->where('status', 1)
            ->first();

        if (!$coupon) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid coupon code'
            ]);
        }

        if ($coupon->expires_at && now()->gt($coupon->expires_at)) {
            return response()->json([
                'status' => false,
                'message' => 'Coupon expired'
            ]);
        }

        if ($coupon->max_uses && $coupon->max_uses <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Coupon limit reached'
            ]);
        }

        $cart = session('cart');
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        if ($coupon->type == 'percent') {
            $discount = ($subtotal * $coupon->discount_amount) / 100;
        } else {
            $discount = $coupon->discount_amount;
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $discount
        ]);

        return response()->json([
            'status' => true,
            'discount' => $discount,
            'message' => 'Coupon applied successfully'
        ]);
    }
}