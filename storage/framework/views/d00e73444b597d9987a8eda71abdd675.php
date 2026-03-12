

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <div class="container-fluid my-2">
        <h1>Edit Sub Category</h1>
    </div>
</section>

<section class="content">
<div class="container-fluid">

<form method="POST"
      action="<?php echo e(route('admin.sub-categories.update', $subcategory)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="card">
        <div class="card-body">

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"
                            <?php echo e($subcategory->category_id == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Name</label>
                <input type="text"
                       name="name"
                       value="<?php echo e($subcategory->name); ?>"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Slug</label>
                <input type="text"
                       name="slug"
                       value="<?php echo e($subcategory->slug); ?>"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" <?php echo e($subcategory->status == 1 ? 'selected' : ''); ?>>
                        Active
                    </option>
                    <option value="0" <?php echo e($subcategory->status == 0 ? 'selected' : ''); ?>>
                        Inactive
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">
                Update Sub Category
            </button>

        </div>
    </div>

</form>

</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views\admin\sub_category\edit.blade.php ENDPATH**/ ?>