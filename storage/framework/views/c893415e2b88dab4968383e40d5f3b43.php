

<?php $__env->startSection('content'); ?>

<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Sub Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <form id="subcategoryForm">
            <?php echo csrf_field(); ?>

            <div class="card">
                <div class="card-body">								
                    <div class="row">

                        
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>Category</label>
                                <select name="category_id" class="form-control">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>">
                                            <?php echo e($category->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                <small class="text-danger"></small>
                            </div>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Slug</label>
                                <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                                <small class="text-danger"></small>
                            </div>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Block</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>

        </form>

    </div>
</section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('customjs'); ?>
<script>

$(document).ready(function(){

    // Auto slug
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


    // Form submit
    $("#subcategoryForm").submit(function(e){
        e.preventDefault();

        $(".text-danger").text('');
        $(".form-control").removeClass('is-invalid');

        $.ajax({
            url: "<?php echo e(route('admin.sub-categories.store')); ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response){

                if(response.status === true){
                    window.location.href = "<?php echo e(route('admin.sub-categories.index')); ?>";
                } else {

                    let errors = response.errors;

                    if(errors.name){
                        $("#name").addClass('is-invalid')
                                  .next('.text-danger')
                                  .text(errors.name[0]);
                    }

                    if(errors.slug){
                        $("#slug").addClass('is-invalid')
                                  .next('.text-danger')
                                  .text(errors.slug[0]);
                    }
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert("Something went wrong. Check console.");
            }
        });
    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views\admin\sub_categories\create.blade.php ENDPATH**/ ?>