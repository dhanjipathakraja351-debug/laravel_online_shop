<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest('id')->with('product_images')->paginate();
        $data['products'] = $products;

        return view('admin.products.list',$data);
    }

    public function create()
    {
        $categories = Category::orderBy('name','asc')->get();
        $brands = Brand::orderBy('name','asc')->get();

        return view('admin.products.create', compact('categories','brands'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'title' => 'required|max:255',
            'slug' => 'required|unique:products,slug',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric',
            'sku' => 'required|unique:products,sku',
            'category_id' => 'required',
            'status' => 'required',
            'is_featured' => 'required'

        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }

        $product = new Product();

        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->description = strip_tags(
    $request->description,
    '<p><br><strong><b><ul><ol><li>'
);

        $product->price = $request->price;
        $product->compare_price = $request->compare_price;

        $product->sku = $request->sku;
        $product->barcode = $request->barcode;

        // ✅ FIXED
        $product->track_qty = $request->track_qty ? 1 : 0;
        $product->qty = $request->qty ?? 0;

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $product->status = $request->status;

        // ✅ FIXED
        $product->is_featured = $request->is_featured ? 1 : 0;

        $product->save();


        /* IMAGE UPLOAD */

        if($request->has('image_array')){

            foreach($request->image_array as $temp_image){

                $tempPath = public_path('temp/'.$temp_image);

                if(!File::exists($tempPath)){
                    continue;
                }

                $uploadPath = public_path('uploads/products');

                if(!File::exists($uploadPath)){
                    File::makeDirectory($uploadPath,0755,true,true);
                }

                $ext = pathinfo($temp_image, PATHINFO_EXTENSION);

                $newName = $product->id.'_'.time().'_'.rand(1,9999).'.'.$ext;

                $img = Image::read($tempPath);

                $img->scaleDown(800,800)
                    ->save($uploadPath.'/'.$newName);

                File::delete($tempPath);

                ProductImage::create([
                    'product_id'=>$product->id,
                    'image'=>$newName
                ]);
            }
        }

        return response()->json([
            'status'=>true,
            'message'=>'Product created successfully'
        ]);
    }


    public function edit($id)
    {
        $product = Product::with('product_images')->findOrFail($id);

        $categories = Category::orderBy('name','asc')->get();
        $subCategories = SubCategory::orderBy('name','asc')->get();
        $brands = Brand::orderBy('name','asc')->get();

        return view('admin.products.edit',compact(
            'product',
            'categories',
            'subCategories',
            'brands'
        ));
    }


    public function update(Request $request,$id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [

            'title' => 'required|max:255',
            'slug' => 'required|unique:products,slug,'.$id,
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric',
            'sku' => 'required|unique:products,sku,'.$id,
            'category_id' => 'required',
            'status' => 'required'

        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }

        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->description = strip_tags(
    $request->description,
    '<p><br><strong><b><ul><ol><li>'
);

        $product->price = $request->price;
        $product->compare_price = $request->compare_price;

        $product->sku = $request->sku;
        $product->barcode = $request->barcode;

        // ✅ FIXED
        $product->track_qty = $request->track_qty ? 1 : 0;
        $product->qty = $request->qty ?? 0;

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $product->status = $request->status;

        // ✅ FIXED
        $product->is_featured = $request->is_featured ? 1 : 0;

        $product->save();

        return response()->json([
            'status'=>true,
            'message'=>'Product updated successfully'
        ]);
    }


    public function destroy($id)
    {
        $product = Product::with('product_images')->findOrFail($id);

        foreach($product->product_images as $image){

            $path = public_path('uploads/products/'.$image->image);

            if(File::exists($path)){
                File::delete($path);
            }

            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success','Product deleted');
    }

}