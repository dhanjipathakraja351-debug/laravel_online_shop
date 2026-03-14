

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Categories</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> New Category
                </a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th width="100">Status</th>
                            <th width="120">Edit</th>
                            <th width="120">Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($category->id); ?></td>
                                <td><?php echo e($category->name); ?></td>
                                <td><?php echo e($category->slug); ?></td>
                                <td>
<?php if($category->status == 1): ?>
<span class="badge bg-success">Active</span>
<?php else: ?>
<span class="badge bg-danger">Blocked</span>
<?php endif; ?>
</td>
                                <td>
                                    <a href="<?php echo e(route('admin.categories.edit', $category->id)); ?>"
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                                <td>
                                    <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                                <td colspan="6" class="text-center text-muted">
                                    No records found
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <?php echo e($categories->withQueryString()->links()); ?>

            </div>

        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views/admin/categories/list.blade.php ENDPATH**/ ?>