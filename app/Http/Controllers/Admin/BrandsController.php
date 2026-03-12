<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;

class BrandsController extends Controller
{
    /**
     * Display a listing of brands
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'desc')->paginate(10);
        return view('admin.brands.list', compact('brands'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store new brand
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required|string|max:255',
            'slug'   => 'required|string|max:255|unique:brands,slug',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Brand::create([
            'name'   => $request->name,
            'slug'   => $request->slug,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand added successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update brand
     */
    public function update(Request $request, Brand $brand)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required|string|max:255',
            'slug'   => 'required|string|max:255|unique:brands,slug,' . $brand->id,
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $brand->update([
            'name'   => $request->name,
            'slug'   => $request->slug,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    /**
     * Delete brand
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }
}