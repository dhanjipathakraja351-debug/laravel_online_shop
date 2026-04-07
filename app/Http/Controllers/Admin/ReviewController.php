<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('product')->latest()->get();
        return view('admin.reviews.list', compact('reviews'));
    }

    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->status = 1;
        $review->save();

        return back()->with('success','Review approved');
    }

    public function delete($id)
    {
        Review::findOrFail($id)->delete();
        return back()->with('success','Review deleted');
    }
}