

<?php $__env->startSection('content'); ?>

<section class="content-header">					
<div class="container-fluid my-2">
<div class="row mb-2">

<div class="col-sm-6">
<h1>Products</h1>
</div>

<div class="col-sm-6 text-right">
<a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
New Product
</a>
</div>

</div>
</div>
</section>


<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<div class="card-tools">

<div class="input-group" style="width: 250px;">
<input type="text" name="table_search" class="form-control float-right" placeholder="Search">

<div class="input-group-append">
<button type="submit" class="btn btn-default">
<i class="fas fa-search"></i>
</button>
</div>

</div>

</div>
</div>


<div class="card-body table-responsive p-0">

<table class="table table-hover text-nowrap">

<thead>

<tr>
<th width="60">ID</th>
<th width="80">Image</th>
<th>Product</th>
<th>Price</th>
<th>Qty</th>
<th>SKU</th>
<th width="100">Status</th>
<th width="120">Action</th>
</tr>

</thead>


<tbody>

<?php if($products->isNotEmpty()): ?>

<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php
$productImage = $product->product_images->first();
?>

<tr>

<td><?php echo e($product->id); ?></td>

<td>
<?php if(!empty($productImage->image)): ?>
<img src="<?php echo e(asset('storage/products/'.$productImage->image)); ?>" class="img-thumbnail" width="50">
<?php endif; ?>
</td>

<td>
<a href="<?php echo e(route('admin.products.edit',$product->id)); ?>">
<?php echo e($product->title); ?>

</a>
</td>

<td><?php echo e($product->price); ?></td>

<td><?php echo e($product->qty); ?></td>

<td><?php echo e($product->sku); ?></td>


<td>

<?php if($product->status == 1): ?>
<span class="badge bg-success">Active</span>
<?php else: ?>
<span class="badge bg-danger">Blocked</span>
<?php endif; ?>

</td>


<td>

<a href="<?php echo e(route('admin.products.edit',$product->id)); ?>" class="btn btn-primary btn-sm">
<i class="fas fa-pen"></i>
</a>

<form action="<?php echo e(route('admin.products.destroy',$product->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this product?')">
<?php echo csrf_field(); ?>
<?php echo method_field('DELETE'); ?>

<button type="submit" class="btn btn-danger btn-sm">
<i class="fas fa-trash"></i>
</button>

</form>

</td>

</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php else: ?>


<tr>
<td colspan="8" class="text-center">Records Not Found</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>


<div class="card-footer clearfix">
<?php echo e($products->links()); ?>

</div>

</div>

</div>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views\admin\products\list.blade.php ENDPATH**/ ?>