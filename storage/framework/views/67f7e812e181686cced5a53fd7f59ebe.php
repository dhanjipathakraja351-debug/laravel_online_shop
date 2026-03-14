

<?php $__env->startSection('content'); ?>

<section class="content-header">
<div class="container-fluid my-2">

<div class="row mb-2">

<div class="col-sm-6">
<h1>Sub Categories</h1>
</div>

<div class="col-sm-6 text-end">
<a href="<?php echo e(route('admin.sub-categories.create')); ?>" class="btn btn-primary">
<i class="fas fa-plus"></i> New Sub Category
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
<th width="60">ID</th>
<th>Category</th>
<th>Name</th>
<th>Slug</th>
<th width="100">Status</th>
<th width="120">Edit</th>
<th width="120">Delete</th>
</tr>
</thead>

<tbody>

<?php $__empty_1 = true; $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

<tr>

<td><?php echo e($subcategory->id); ?></td>

<td><?php echo e($subcategory->category->name ?? 'N/A'); ?></td>

<td><?php echo e($subcategory->name); ?></td>

<td><?php echo e($subcategory->slug); ?></td>

<td>
<?php if($subcategory->status == 1): ?>
<span class="badge bg-success">Active</span>
<?php else: ?>
<span class="badge bg-danger">Blocked</span>
<?php endif; ?>
</td>

<td>
<a href="<?php echo e(route('admin.sub-categories.edit', $subcategory->id)); ?>" class="btn btn-sm btn-primary">
<i class="fas fa-edit"></i> Edit
</a>
</td>

<td>
<form action="<?php echo e(route('admin.sub-categories.destroy', $subcategory->id)); ?>"
method="POST"
onsubmit="return confirm('Are you sure you want to delete this sub category?');">

<?php echo csrf_field(); ?>
<?php echo method_field('DELETE'); ?>

<button type="submit" class="btn btn-sm btn-danger">
<i class="fas fa-trash"></i> Delete
</button>

</form>
</td>

</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<tr>
<td colspan="7" class="text-center text-muted">
No records found
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>

<div class="card-footer clearfix">
<?php echo e($subcategories->withQueryString()->links()); ?>

</div>

</div>

</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views/admin/sub_categories/list.blade.php ENDPATH**/ ?>