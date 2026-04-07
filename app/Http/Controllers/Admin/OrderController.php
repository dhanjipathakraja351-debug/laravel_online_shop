<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    // Orders List Page
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.orders.list', compact('orders'));
    }

    // Order Detail Page
    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        return view('admin.orders.detail', compact('order'));
    }

    // Update Order Status
    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);

        $order->status = $status;

        // ✅ Set shipped_date automatically
        if ($status == 'shipped') {
            $order->shipped_date = now();
        }

        $order->save();

        return redirect()->back()->with('success', 'Order status updated!');
    }
}