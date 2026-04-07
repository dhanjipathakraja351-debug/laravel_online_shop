<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;

class AuthController extends Controller
{
    // ✅ SHOW LOGIN PAGE
    public function login() {
        return view('front.account.login');
    }

    // ✅ SHOW REGISTER PAGE
    public function register() {
        return view('front.account.register');
    }

    // ✅ STORE REGISTER (AJAX)
    public function storeRegister(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);

        // ❌ VALIDATION FAIL
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // ✅ CREATE USER
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);

        // ✅ SUCCESS RESPONSE
        return response()->json([
            'status' => true,
            'message' => 'Registration successful! Please login.'
        ]);
    }

    // ✅ LOGIN USER (AJAX)
    public function loginUser(Request $request)
    {
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            return response()->json([
                'status' => true,
                'redirect' => route('profile') // ✅ FIX (redirect to profile)
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid email or password'
        ]);
    }

    // ✅ PROFILE PAGE
    public function profile() {
        return view('front.account.profile');
    }

    // ✅ LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','Logged out successfully');
    }

    public function updateProfile(Request $request)
   {
    $user = Auth::user();

    $request->validate([
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => 'required|email|unique:users,email,' . $user->id,
        'phone'      => 'required',
        'address'    => 'required',
        'apartment'  => 'required',
        'city'       => 'required',
        'state'      => 'required',
        'country'    => 'required',
        'zipcode'    => 'required',
    ],

     [
        'first_name.required' => 'This field is required',
        'last_name.required'  => 'This field is required',
        'email.required'      => 'This field is required',
        'email.email'         => 'Enter valid email',
        'email.unique'        => 'This email has already registered',
        'phone.required'      => 'This field is required',
        'address.required'    => 'This field is required',
        'apartment.required'  => 'This field is required',
        'city.required'       => 'This field is required',
        'state.required'      => 'This field is required',
        'country.required'    => 'This field is required',
        'zipcode.required'    => 'This field is required',
    ]);

    $user->first_name = $request->first_name;
    $user->last_name  = $request->last_name;

    $user->email = $request->email;
    $user->phone = $request->phone;

    $user->address   = $request->address;
    $user->apartment = $request->apartment;

    $user->city    = $request->city;
    $user->state   = $request->state;
    $user->country = $request->country;
    $user->zipcode = $request->zipcode;

    $user->save();

    return back()->with('success','Profile updated successfully');
}

    public function orders() {

    $orders = Order::where('user_id', auth()->id())
                    ->latest()
                    ->get();

    return view('front.account.order', compact('orders'));
    
   }


 public function orderDetail($id)
{
    // ✅ check if order belongs to logged-in user
    $order = Order::where('id', $id)
                  ->where('user_id', Auth::id())
                  ->first();

    // ❌ if not found or not authorized
    if (!$order) {
        return redirect()->route('orders')
            ->with('error', 'Order not found');
    }

    // ✅ get items with product (ONLY ONCE)
    $orderItems = OrderItem::with('product')
                    ->where('order_id', $order->id)
                    ->get();

    // ✅ total qty
    $totalQty = $orderItems->sum('qty');

    // ✅ return view (FIX: include totalQty)
    return view('front.account.order-detail', compact('order', 'orderItems', 'totalQty'));

   }

public function changePassword()
{
    return view('front.account.change-password');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:6|confirmed'
    ]);

    $user = auth()->user();

    // CHECK OLD PASSWORD
    if (!Hash::check($request->old_password, $user->password)) {
        return back()->withErrors([
            'old_password' => 'Old password is incorrect'
        ]);
    }

    // UPDATE PASSWORD
    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password updated successfully');
 }
    
}