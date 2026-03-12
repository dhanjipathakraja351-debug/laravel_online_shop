<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use App\Models\Brand;

class SubcategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display Sub Categories
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $subcategories = Subcategory::with('category')
                            ->latest()
                            ->paginate(10);

        return view('admin.sub_categories.list', compact('subcategories'));
    }

    /*
    |--------------------------------------------------------------------------
    | Show Create Form
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('admin.sub_categories.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store New Sub Category (AJAX + Auto Unique Slug)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Auto generate unique slug
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;

        while (Subcategory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        Subcategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'status' => true
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Show Edit Form
    |--------------------------------------------------------------------------
    */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('admin.sub_category.edit',
            compact('subcategory', 'categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update Sub Category
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Subcategory $subcategory)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Auto unique slug on update
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;

        while (Subcategory::where('slug', $slug)
                ->where('id', '!=', $subcategory->id)
                ->exists()) {

            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $subcategory->update([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'status' => true
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Sub Category
    |--------------------------------------------------------------------------
    */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return response()->json([
            'status' => true
        ]);
    }
}