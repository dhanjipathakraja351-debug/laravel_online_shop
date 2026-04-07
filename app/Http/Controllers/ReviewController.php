<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
    $request->validate([
        'product_id' => 'required',
        'name' => 'required',
        'email' => 'required|email',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required'
    ]);

    // ✅ CHECK IF ALREADY REVIEWED
    $exists = \App\Models\Review::where('product_id', $request->product_id)
        ->where('email', $request->email)
        ->exists();

    if ($exists) {
        return back()->withErrors(['email' => 'You have already submitted review']);
    }

    \App\Models\Review::create($request->all());

    return back()->with('success', 'Review submitted successfully');
  }
}