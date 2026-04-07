<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Subcategory;

class ShopController extends Controller
{
   public function index($categorySlug = null, $subCategorySlug = null)
{
    // ===== CATEGORIES =====
    $categories = Category::orderBy('name','asc')
        ->with('subCategories')
        ->where('status',1)
        ->get();

    // ===== BRANDS =====
    $brands = Brand::orderBy('name','asc')
        ->where('status',1)
        ->get();

    // ===== BASE QUERY =====
    $products = Product::where('status',1);

    // ===== SEARCH =====
if (!empty(request()->keyword)) {
    $products->where(function($query){
        $query->where('title', 'like', '%' . request()->keyword . '%')
              ->orWhere('description', 'like', '%' . request()->keyword . '%');
    });
}

    $selectedCategory = null;
    $selectedSubCategory = null;

    // ===== FIXED FILTER LOGIC =====
    if ($categorySlug && $subCategorySlug) {

        $selectedCategory = Category::where('slug', $categorySlug)->first();
        $selectedSubCategory = Subcategory::where('slug', $subCategorySlug)->first();

        if ($selectedCategory && $selectedSubCategory) {
            $products->where([
                ['category_id', '=', $selectedCategory->id],
                ['sub_category_id', '=', $selectedSubCategory->id],
            ]);
        }

    } elseif ($categorySlug) {

        $selectedCategory = Category::where('slug', $categorySlug)->first();

        if ($selectedCategory) {
            $products->where('category_id', $selectedCategory->id);
        }
    }

    // ===== CHECKBOX SUBCATEGORY =====
    if (!empty(request()->subCategory)) {
        $products->whereIn('sub_category_id', request()->subCategory);
    }

    // ===== BRAND FILTER =====
    if (!empty(request()->brand)) {
        $products->whereIn('brand_id', request()->brand);
    }

    // ===== PRICE FILTER =====
    if (!empty(request()->price)) {
        $products->where(function($query){
            foreach(request()->price as $price){

                if($price == '0-100'){
                    $query->orWhereBetween('price',[0,100]);
                }

                if($price == '100-200'){
                    $query->orWhereBetween('price',[100,200]);
                }

                if($price == '200-500'){
                    $query->orWhereBetween('price',[200,500]);
                }

                if($price == '500+'){
                    $query->orWhere('price','>=',500);
                }
            }
        });
    }

    // ===== PAGINATION =====
    $products = $products->orderBy('id','desc')->paginate(6);

    return view('front.shop', compact(
        'categories',
        'brands',
        'products',
        'selectedCategory',
        'selectedSubCategory'
    ));

   }

   public function product($slug)
{
    $product = Product::where('slug', $slug)
        ->where('status', 1)
        ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
    ->where('id', '!=', $product->id)
    ->take(4)
    ->get();

    return view('front.product', compact('product','relatedProducts'));
}


}