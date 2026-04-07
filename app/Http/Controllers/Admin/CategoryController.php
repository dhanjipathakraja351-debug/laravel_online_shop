<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.list', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $slug = $request->slug;

        if (empty($slug)) {
            $slug = Str::slug($request->name);
        }

        $validator = Validator::make(
            array_merge($request->all(), ['slug' => $slug]),
            [
                'name' => 'required',
                'slug' => 'required|unique:categories,slug',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $category = Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status,
            'showHome' => $request->showHome
        ]);

        // HANDLE IMAGE
        if (!empty($request->image_id)) {

            $tempImage = TempImage::find($request->image_id);

            if ($tempImage != null) {

                $ext = pathinfo($tempImage->name, PATHINFO_EXTENSION);
                $newImageName = $category->id . '.' . $ext;

                $sourcePath = public_path('temp/' . $tempImage->name);
                $destinationPath = public_path('uploads/' . $newImageName);

                $image = Image::read($sourcePath)
                    ->resize(600, 600);

                $image->save($destinationPath);

                $category->image = $newImageName;
                $category->save();

                File::delete($sourcePath);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Category created successfully'
        ]);
    }

    public function edit($categoryId, Request $request)
    {
        $category = Category::find($categoryId);

        if (empty($category)) {
            return redirect()->route('admin.categories.index');
        }

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $slug = $request->slug;

        if (empty($slug)) {
            $slug = Str::slug($request->name);
        }

        $validator = Validator::make(
            array_merge($request->all(), ['slug' => $slug]),
            [
                'name' => 'required',
                'slug' => 'required|unique:categories,slug,' . $category->id,
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status,
            'showHome' => $request->showHome
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

   public function destroy($id)
{
    $category = Category::find($id);

    if (empty($category)) {
        return redirect()->route('admin.categories.index');
    }

    // Check if category has subcategories
    if ($category->subCategories()->count() > 0) {
        return redirect()
            ->route('admin.categories.index')
            ->with('error','Cannot delete category. Subcategories exist.');
    }

    // delete image
    if (!empty($category->image)) {
        $imagePath = public_path('uploads/'.$category->image);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }

    $category->delete();

    return redirect()
        ->route('admin.categories.index')
        ->with('success','Category deleted successfully');
   }
}