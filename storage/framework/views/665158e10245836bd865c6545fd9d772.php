

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Brand</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo e(route('admin.brands.index')); ?>" class="btn btn-secondary">
                    Back
                </a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Brand Information</h3>
            </div>

            <form action="<?php echo e(route('admin.brands.update', $brand)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="card-body">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="<?php echo e(old('name', $brand->name)); ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text"
                               name="slug"
                               class="form-control"
                               value="<?php echo e(old('slug', $brand->slug)); ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" <?php echo e($brand->status == 1 ? 'selected' : ''); ?>>
                                Active
                            </option>
                            <option value="0" <?php echo e($brand->status == 0 ? 'selected' : ''); ?>>
                                Blocked
                            </option>
                        </select>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Update Brand
                    </button>
                </div>

            </form>
        </div>

    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views\admin\brands\edit.blade.php ENDPATH**/ ?>