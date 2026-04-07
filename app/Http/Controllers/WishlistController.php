<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // SHOW WISHLIST
    public function index()
    {
        $items = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('front.wishlist', compact('items'));
    }

   // ADD TO WISHLIST
public function add($id)
{
    $userId = Auth::id();

    // ✅ Get product
    $product = \App\Models\Product::findOrFail($id);

    // ✅ Check exists
    $exists = Wishlist::where('user_id', $userId)
        ->where('product_id', $id)
        ->exists();

    if ($exists) {
        return back()->with('success', $product->title . ' is already in wishlist');
    }

    // ✅ Insert
    Wishlist::create([
        'user_id' => $userId,
        'product_id' => $id
    ]);

    return back()->with('success', $product->title . ' added to wishlist');
}


// REMOVE FROM WISHLIST
public function remove($id)
{
    $userId = Auth::id();

    // ✅ Get product
    $product = \App\Models\Product::find($id);

    Wishlist::where('user_id', $userId)
        ->where('product_id', $id)
        ->delete();

    return back()->with(
        'success',
        ($product->title ?? 'Item') . ' removed from wishlist'
    );
    
  }

}