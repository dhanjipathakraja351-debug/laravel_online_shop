@extends('admin.layouts.app')

@section('content')

<section class="content-header">
<div class="container-fluid my-2">
<div class="row mb-2">

<div class="col-sm-6">
<h1>Edit Product</h1>
</div>

<div class="col-sm-6 text-end">
<a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
<i class="fas fa-arrow-left"></i> Back
</a>
</div>

</div>
</div>
</section>


<section class="content">

<div class="container-fluid">

<form method="POST" action="{{ route('admin.products.update',$product->id) }}">
@csrf
@method('PUT')

<div class="row">

{{-- LEFT SIDE --}}
<div class="col-md-8">

{{-- BASIC INFO --}}
<div class="card">
<div class="card-header">
<h3 class="card-title">Basic Information</h3>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">
<label>Title</label>
<input type="text"
name="title"
value="{{ old('title',$product->title) }}"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Slug</label>
<input type="text"
name="slug"
value="{{ old('slug',$product->slug) }}"
class="form-control">
</div>

</div>

</div>
</div>


{{-- DESCRIPTION --}}
<div class="card">
<div class="card-header">
<h3 class="card-title">Description</h3>
</div>

<div class="card-body">

<textarea name="description" class="form-control summernote">
{{ old('description',$product->description) }}
</textarea>

</div>
</div>


{{-- PRODUCT IMAGES --}}
<div class="card">

<div class="card-header">
<h3 class="card-title">Product Images</h3>
</div>

<div class="card-body">

<div id="image" class="dropzone">
<div class="dz-message text-center">
Drop files here or click to upload
</div>
</div>

@if($product->product_images->count()>0)

<div class="row mt-3">

@foreach($product->product_images as $image)

<div class="col-md-2 text-center">
<img src="{{ asset('storage/products/'.$image->image) }}" class="img-fluid mb-2">
</div>

@endforeach

</div>

@endif

</div>
</div>


{{-- PRICING --}}
<div class="card">

<div class="card-header">
<h3 class="card-title">Pricing</h3>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">
<label>Price</label>
<input type="text"
name="price"
value="{{ old('price',$product->price) }}"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Compare Price</label>
<input type="text"
name="compare_price"
value="{{ old('compare_price',$product->compare_price) }}"
class="form-control">
</div>

</div>

</div>
</div>


{{-- INVENTORY --}}
<div class="card">

<div class="card-header">
<h3 class="card-title">Inventory</h3>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">
<label>SKU</label>
<input type="text"
name="sku"
value="{{ old('sku',$product->sku) }}"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Barcode</label>
<input type="text"
name="barcode"
value="{{ old('barcode',$product->barcode) }}"
class="form-control">
</div>

</div>

<div class="form-check mb-3">
<input type="checkbox"
name="track_qty"
value="1"
class="form-check-input"
{{ $product->track_qty ? 'checked':'' }}>
<label class="form-check-label">Track Quantity</label>
</div>

<div class="mb-3">
<label>Quantity</label>
<input type="number"
name="qty"
value="{{ old('qty',$product->qty) }}"
class="form-control">
</div>

</div>
</div>

</div>


{{-- RIGHT SIDE --}}
<div class="col-md-4">

{{-- CATEGORY --}}
<div class="card">

<div class="card-header">
<h3 class="card-title">Category</h3>
</div>

<div class="card-body">

<div class="mb-3">
<label>Category</label>

<select name="category_id" class="form-control">

<option value="">Select Category</option>

@foreach($categories as $category)

<option value="{{ $category->id }}"
{{ $product->category_id==$category->id ? 'selected':'' }}>

{{ $category->name }}

</option>

@endforeach

</select>

</div>


<div class="mb-3">
<label>Sub Category</label>

<select name="sub_category_id" class="form-control">

<option value="">Select Sub Category</option>

@foreach($subCategories as $sub)

<option value="{{ $sub->id }}"
{{ $product->sub_category_id==$sub->id ? 'selected':'' }}>

{{ $sub->name }}

</option>

@endforeach

</select>

</div>

</div>
</div>


{{-- BRAND --}}
<div class="card">

<div class="card-header">
<h3 class="card-title">Brand</h3>
</div>

<div class="card-body">

<select name="brand_id" class="form-control">

<option value="">Select Brand</option>

@foreach($brands as $brand)

<option value="{{ $brand->id }}"
{{ $product->brand_id==$brand->id ? 'selected':'' }}>

{{ $brand->name }}

</option>

@endforeach

</select>

</div>
</div>


{{-- STATUS --}}
<div class="card">
<div class="card-header">
<h3 class="card-title">Status</h3>
</div>

<div class="card-body">

<select name="status" class="form-control">

<option value="1" {{ $product->status==1?'selected':'' }}>
Active
</option>

<option value="0" {{ $product->status==0?'selected':'' }}>
Blocked
</option>

</select>

</div>
</div>


{{-- FEATURED --}}
<div class="card">

<div class="card-header">
<h3 class="card-title">Featured</h3>
</div>

<div class="card-body">

<select name="is_featured" class="form-control">

<option value="0" {{ $product->is_featured==0?'selected':'' }}>
No
</option>

<option value="1" {{ $product->is_featured==1?'selected':'' }}>
Yes
</option>

</select>

</div>

</div>

</div>

</div>


<div class="mt-3">

<button type="submit" class="btn btn-success">
<i class="fas fa-save"></i> Update Product
</button>

<a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark">
Cancel
</a>

</div>

</form>

</div>

</section>

@endsection


@section('customjs')

<script>

Dropzone.autoDiscover=false;

var myDropzone=new Dropzone("#image",{

url:"{{ route('admin.product-images.store') }}",

paramName:"image",

maxFiles:5,

acceptedFiles:"image/jpeg,image/png,image/gif",

headers:{
'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
},

success:function(file,response){

if(response.status){

var html=`<input type="hidden" name="product_images[]" value="${response.image_id}">`;

$('#image').append(html);

}

}

});

</script>

@endsection