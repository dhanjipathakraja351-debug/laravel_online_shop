<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiscountCoupon;

class DiscountCodeController extends Controller
{
    // ✅ LIST ALL COUPONS
    public function index() {
        $coupons = DiscountCoupon::latest()->get();
        return view('admin.coupon.list', compact('coupons'));
    }

    // ✅ CREATE PAGE
    public function create() {
        return view('admin.coupon.create');
    }

    // ✅ STORE COUPON
    public function store(Request $request) {

        $request->validate([
            'code' => 'required|unique:discount_coupons,code',
            'discount_amount' => 'required|numeric',
            'type' => 'required',
        ]);

        DiscountCoupon::create([
            'code' => $request->code,
            'description' => $request->description,
            'max_uses' => $request->max_uses,
            'type' => $request->type,
            'discount_amount' => $request->discount_amount,
            'status' => $request->status ?? 1,
            'starts_at' => $request->starts_at,
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon created successfully');
    }

    // ✅ EDIT PAGE
    public function edit($id) {
        $coupon = DiscountCoupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    // ✅ UPDATE
    public function update(Request $request, $id) {

        $request->validate([
            'code' => 'required|unique:discount_coupons,code,' . $id,
            'discount_amount' => 'required|numeric',
            'type' => 'required',
        ]);

        $coupon = DiscountCoupon::findOrFail($id);

        $coupon->update([
            'code' => $request->code,
            'description' => $request->description,
            'max_uses' => $request->max_uses,
            'type' => $request->type,
            'discount_amount' => $request->discount_amount,
            'status' => $request->status ?? 1,
            'starts_at' => $request->starts_at,
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon updated successfully');
    }

    // ✅ DELETE
    public function destroy($id) {
        $coupon = DiscountCoupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon deleted successfully');
    }
}