<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::count();

       $totalSale = Order::sum('grand_total');

       $monthlySale = Order::whereMonth('created_at', now()->month)
                    ->sum('grand_total');

       $lastMonthSale = Order::whereMonth('created_at', now()->subMonth()->month)
                      ->sum('grand_total');

       $last30DaysSale = Order::where('created_at', '>=', now()->subDays(30))
                        ->sum('grand_total');

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'totalSale',
            'monthlySale',
            'lastMonthSale',
            'last30DaysSale'
        ));
    }
}