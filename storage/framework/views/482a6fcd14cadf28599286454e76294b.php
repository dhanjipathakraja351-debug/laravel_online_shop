

<?php $__env->startSection('content'); ?>

<section class="content-header">
<div class="container-fluid my-2">

<div class="row mb-2">

<div class="col-sm-6">
<h1>Brands</h1>
</div>

<div class="col-sm-6 text-end">
<a href="<?php echo e(route('admin.brands.create')); ?>" class="btn btn-primary">
<i class="fas fa-plus"></i> New Brand
</a>
</div>

</div>

</div>
</section>


<section class="content">
<div class="container-fluid">

<div class="card">

<div class="card-body table-responsive p-0">

<table class="table table-hover text-nowrap align-middle">

<thead>
<tr>
<th width="80">ID</th>
<th>Name</th>
<th width="120">Status</th>
<th width="120">Edit</th>
<th width="120">Delete</th>
</tr>
</thead>

<tbody>

<?php $__empty_1 = true; $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

<tr>

<td><?php echo e($brand->id); ?></td>

<td><?php echo e($brand->name); ?></td>

<td>

<?php if($brand->status == 1): ?>

<span class="badge bg-success">Active</span>

<?php else: ?>

<span class="badge bg-danger">Blocked</span>

<?php endif; ?>

</td>

<td>

<a href="<?php echo e(route('admin.brands.edit',$brand->id)); ?>" class="btn btn-sm btn-primary">
<i class="fas fa-edit"></i>
</a>

</td>

<td>

<form action="<?php echo e(route('admin.brands.destroy',$brand->id)); ?>" method="POST">

<?php echo csrf_field(); ?>
<?php echo method_field('DELETE'); ?>

<button class="btn btn-sm btn-danger" onclick="return confirm('Delete this brand?')">
<i class="fas fa-trash"></i>
</button>

</form>

</td>

</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<tr>
<td colspan="5" class="text-center text-muted">
No records found
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>


<div class="card-footer clearfix">

<?php echo e($brands->withQueryString()->links()); ?>


</div>

</div>

</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views/admin/brands/list.blade.php ENDPATH**/ ?>