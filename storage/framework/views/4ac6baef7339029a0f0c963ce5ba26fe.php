

<?php $__env->startSection('content'); ?>

<section class="content-header">
<div class="container-fluid my-2">
<div class="row mb-2">

<div class="col-sm-6">
<h1>Create Product</h1>
</div>

<div class="col-sm-6 text-end">
<a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-primary">Back</a>
</div>

</div>
</div>
</section>

<section class="content">
<div class="container-fluid">

<form id="productForm" action="<?php echo e(route('admin.products.store')); ?>" method="POST">
<?php echo csrf_field(); ?>

<div class="row">

<div class="col-md-8">

<div class="card mb-3">
<div class="card-body">

<div class="mb-3">
<label>Title</label>
<input type="text" name="title" id="title" class="form-control">
</div>

<div class="mb-3">
<label>Slug</label>
<input type="text" name="slug" id="slug" class="form-control" readonly>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" id="description" class="form-control summernote"></textarea>
</div>

</div>
</div>

<div class="card mb-3">
<div class="card-body">

<h4>Product Images</h4>

<div id="image" class="dropzone border p-4 text-center">
<div class="dz-message">
Drop files here or click to upload
</div>
</div>

<input type="hidden" name="image_id" id="image_id">

</div>
</div>

<div class="card mb-3">
<div class="card-body">

<h4>Pricing</h4>

<div class="row">

<div class="col-md-6">
<label>Price</label>
<input type="text" name="price" id="price" class="form-control">
</div>

<div class="col-md-6">
<label>Compare Price</label>
<input type="text" name="compare_price" id="compare_price" class="form-control">
</div>

</div>

</div>
</div>

<div class="card mb-3">
<div class="card-body">

<h4>Inventory</h4>

<div class="row">

<div class="col-md-6">
<label>SKU</label>
<input type="text" name="sku" id="sku" class="form-control">
</div>

<div class="col-md-6">
<label>Barcode</label>
<input type="text" name="barcode" id="barcode" class="form-control">
</div>

<div class="col-md-12 mt-2">
<div class="form-check">
<input type="checkbox" class="form-check-input" name="track_qty" id="track_qty" value="1">
<label class="form-check-label">Track Quantity</label>
</div>
</div>

<div class="col-md-12 mt-2">
<label>Quantity</label>
<input type="number" name="qty" id="qty" class="form-control">
</div>

</div>

</div>
</div>

</div>

<div class="col-md-4">

<div class="card mb-3">
<div class="card-body">

<h4>Status</h4>

<select name="status" class="form-control">
<option value="1">Active</option>
<option value="0">Block</option>
</select>

</div>
</div>

<div class="card mb-3">
<div class="card-body">

<h4>Category</h4>

<select name="category_id" id="category_id" class="form-control">
<option value="">Select Category</option>

<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</select>

<div class="mt-3">
<label>Sub Category</label>

<select name="sub_category_id" id="sub_category_id" class="form-control">
<option value="">Select Sub Category</option>
</select>

</div>

</div>
</div>

<div class="card mb-3">
<div class="card-body">

<h4>Brand</h4>

<select name="brand_id" class="form-control">

<option value="">Select Brand</option>

<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</select>

</div>
</div>

<div class="card mb-3">
<div class="card-body">

<h4>Featured</h4>

<select name="is_featured" class="form-control">
<option value="0">No</option>
<option value="1">Yes</option>
</select>

</div>
</div>

</div>

</div>

<div class="mt-3">
<button type="submit" class="btn btn-primary">Create</button>
<a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-secondary">Cancel</a>
</div>

</form>

</div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('customjs'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

<script>

$(document).ready(function(){

/* SLUG GENERATOR */

$("#title").keyup(function(){

$.ajax({
url:"<?php echo e(route('admin.getSlug')); ?>",
type:"GET",
data:{title:$(this).val()},

success:function(response){
if(response.status){
$("#slug").val(response.slug);
}
}

});

});


/* LOAD SUBCATEGORIES */

$("#category_id").change(function(){

let category_id=$(this).val();

$.ajax({

url:"<?php echo e(route('admin.subcategories')); ?>",
type:"GET",
data:{category_id:category_id},

success:function(response){

$("#sub_category_id").html('<option value="">Select Sub Category</option>');

$.each(response.subCategories,function(key,item){

$("#sub_category_id").append('<option value="'+item.id+'">'+item.name+'</option>');

});

}

});

});


/* DROPZONE IMAGE UPLOAD */

Dropzone.autoDiscover=false;

var myDropzone=new Dropzone("#image",{

url:"<?php echo e(route('admin.temp-images.create')); ?>",

paramName:"image",

maxFiles:5,

addRemoveLinks:true,

clickable:true,

acceptedFiles:"image/jpeg,image/png,image/jpg,image/webp",

headers:{
'X-CSRF-TOKEN':"<?php echo e(csrf_token()); ?>"
},

success:function(file,response){

if(response.status){

$("#image_id").val(response.image_id);

}

}

});

});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views\admin\products\create.blade.php ENDPATH**/ ?>