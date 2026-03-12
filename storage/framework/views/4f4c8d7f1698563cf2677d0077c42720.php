

<?php $__env->startSection('content'); ?>

<section class="content-header">
<div class="container-fluid my-2">
<div class="row mb-2">

<div class="col-sm-6">
<h1>Edit Category</h1>
</div>

<div class="col-sm-6 text-end">
<a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-primary">
Back
</a>
</div>

</div>
</div>
</section>

<section class="content">
<div class="container-fluid">

<form method="POST" action="<?php echo e(route('admin.categories.update', $category)); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>

<div class="card">
<div class="card-body">

<div class="row">

<div class="col-md-6">
<div class="mb-3">
<label>Name</label>

<input type="text"
name="name"
id="name"
class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
value="<?php echo e(old('name', $category->name)); ?>"
placeholder="Category Name">

<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<div class="invalid-feedback"><?php echo e($message); ?></div>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
</div>


<div class="col-md-6">
<div class="mb-3">
<label>Slug</label>

<input type="text"
name="slug"
id="slug"
class="form-control <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
value="<?php echo e(old('slug', $category->slug)); ?>"
readonly>

<?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<div class="invalid-feedback"><?php echo e($message); ?></div>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
</div>


<div class="col-md-6">
<div class="mb-3">
<label>Image</label>

<input type="file"
name="image"
id="image"
class="form-control">

<?php if($category->image): ?>
<div class="mt-3">
<img width="200" src="<?php echo e(asset('storage/temp/'.$category->image)); ?>">
</div>
<?php endif; ?>

</div>
</div>


<div class="col-md-6">
<div class="mb-3">

<label>Status</label>

<select name="status" class="form-control">

<option value="1"
<?php echo e(old('status',$category->status)==1 ? 'selected' : ''); ?>>
Active
</option>

<option value="0"
<?php echo e(old('status',$category->status)==0 ? 'selected' : ''); ?>>
Block
</option>

</select>

</div>
</div>

</div>

</div>
</div>


<div class="pt-3">

<button type="submit" class="btn btn-success">
Update Category
</button>

<a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-outline-dark ms-3">
Cancel
</a>

</div>

</form>

</div>
</section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('customjs'); ?>

<script>

// Slug auto generation
$("#name").keyup(function(){

$.ajax({

url: "<?php echo e(route('admin.getSlug')); ?>",

type: "GET",

data: { title: $(this).val() },

success: function(response){

if(response.status){
$("#slug").val(response.slug);
}

}

});

});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views\admin\categories\edit.blade.php ENDPATH**/ ?>