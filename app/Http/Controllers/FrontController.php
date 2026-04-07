<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Page;

class FrontController extends Controller
{
    public function index()
    {
        // Categories for homepage
        $categories = Category::where('status', 1)
            ->where('showHome', 1)
            ->orderBy('name', 'ASC')
            ->get();

        // Featured products
        $featuredProducts = Product::where('status', 1)
            ->where('is_featured', 1)
            ->latest()
            ->take(8)
            ->get(); // ✅ ensures all fields including quantity

        // Latest products
        $latestProducts = Product::where('status', 1)
            ->latest()
            ->take(8)
            ->get(); // ✅ ensures all fields including quantity

        return view('front.home', compact(
            'categories',
            'featuredProducts',
            'latestProducts'
        ));
    }


    public function page($slug)
    {
    $page = Page::where('slug', $slug)->firstOrFail();

    return view('front.page', compact('page'));
  }

}