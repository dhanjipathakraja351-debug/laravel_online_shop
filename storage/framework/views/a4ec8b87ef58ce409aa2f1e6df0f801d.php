

<?php $__env->startSection('content'); ?>

<section class="content-header">
<div class="container-fluid my-2">
<div class="row mb-2">

<div class="col-sm-6">
<h1>Edit Product</h1>
</div>

<div class="col-sm-6 text-end">
<a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-secondary">
<i class="fas fa-arrow-left"></i> Back
</a>
</div>

</div>
</div>
</section>


<section class="content">

<div class="container-fluid">

<form method="POST" action="<?php echo e(route('admin.products.update',$product->id)); ?>">
<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<div class="row">


<div class="col-md-8">


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
value="<?php echo e(old('title',$product->title)); ?>"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Slug</label>
<input type="text"
name="slug"
value="<?php echo e(old('slug',$product->slug)); ?>"
class="form-control">
</div>

</div>

</div>
</div>



<div class="card">
<div class="card-header">
<h3 class="card-title">Description</h3>
</div>

<div class="card-body">

<textarea name="description" class="form-control summernote">
<?php echo e(old('description',$product->description)); ?>

</textarea>

</div>
</div>



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

<?php if($product->product_images->count()>0): ?>

<div class="row mt-3">

<?php $__currentLoopData = $product->product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="col-md-2 text-center">
<img src="<?php echo e(asset('storage/products/'.$image->image)); ?>" class="img-fluid mb-2">
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php endif; ?>

</div>
</div>



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
value="<?php echo e(old('price',$product->price)); ?>"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Compare Price</label>
<input type="text"
name="compare_price"
value="<?php echo e(old('compare_price',$product->compare_price)); ?>"
class="form-control">
</div>

</div>

</div>
</div>



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
value="<?php echo e(old('sku',$product->sku)); ?>"
class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Barcode</label>
<input type="text"
name="barcode"
value="<?php echo e(old('barcode',$product->barcode)); ?>"
class="form-control">
</div>

</div>

<div class="form-check mb-3">
<input type="checkbox"
name="track_qty"
value="1"
class="form-check-input"
<?php echo e($product->track_qty ? 'checked':''); ?>>
<label class="form-check-label">Track Quantity</label>
</div>

<div class="mb-3">
<label>Quantity</label>
<input type="number"
name="qty"
value="<?php echo e(old('qty',$product->qty)); ?>"
class="form-control">
</div>

</div>
</div>

</div>



<div class="col-md-4">


<div class="card">

<div class="card-header">
<h3 class="card-title">Category</h3>
</div>

<div class="card-body">

<div class="mb-3">
<label>Category</label>

<select name="category_id" class="form-control">

<option value="">Select Category</option>

<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<option value="<?php echo e($category->id); ?>"
<?php echo e($product->category_id==$category->id ? 'selected':''); ?>>

<?php echo e($category->name); ?>


</option>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</select>

</div>


<div class="mb-3">
<label>Sub Category</label>

<select name="sub_category_id" class="form-control">

<option value="">Select Sub Category</option>

<?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<option value="<?php echo e($sub->id); ?>"
<?php echo e($product->sub_category_id==$sub->id ? 'selected':''); ?>>

<?php echo e($sub->name); ?>


</option>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</select>

</div>

</div>
</div>



<div class="card">

<div class="card-header">
<h3 class="card-title">Brand</h3>
</div>

<div class="card-body">

<select name="brand_id" class="form-control">

<option value="">Select Brand</option>

<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<option value="<?php echo e($brand->id); ?>"
<?php echo e($product->brand_id==$brand->id ? 'selected':''); ?>>

<?php echo e($brand->name); ?>


</option>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</select>

</div>
</div>



<div class="card">
<div class="card-header">
<h3 class="card-title">Status</h3>
</div>

<div class="card-body">

<select name="status" class="form-control">

<option value="1" <?php echo e($product->status==1?'selected':''); ?>>
Active
</option>

<option value="0" <?php echo e($product->status==0?'selected':''); ?>>
Blocked
</option>

</select>

</div>
</div>



<div class="card">

<div class="card-header">
<h3 class="card-title">Featured</h3>
</div>

<div class="card-body">

<select name="is_featured" class="form-control">

<option value="0" <?php echo e($product->is_featured==0?'selected':''); ?>>
No
</option>

<option value="1" <?php echo e($product->is_featured==1?'selected':''); ?>>
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

<a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-outline-dark">
Cancel
</a>

</div>

</form>

</div>

</section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('customjs'); ?>

<script>

Dropzone.autoDiscover=false;

var myDropzone=new Dropzone("#image",{

url:"<?php echo e(route('admin.product-images.store')); ?>",

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views\admin\products\edit.blade.php ENDPATH**/ ?>