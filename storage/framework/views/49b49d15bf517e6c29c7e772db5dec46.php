

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-secondary">
                    Back
                </a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <form method="POST"
              action="<?php echo e(route('admin.categories.store')); ?>"
              id="categoryForm"
              enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="card">
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control"
                                       placeholder="Category Name">
                                <p class="text-danger"></p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Slug</label>
                                <input type="text"
                                       name="slug"
                                       id="slug"
                                       class="form-control"
                                       readonly>
                                <p class="text-danger"></p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Image</label>
                                <input type="file"
                                       name="image"
                                       id="image"
                                       class="form-control">
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
                            <div class="col-md-6">
                            <div class="mb-3">
                                <label>Show on Home</label>
                                <select name="showHome" id="showHome" class="form-control">
                                    <option value="1">yes</option>
                                    <option value="0">no</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?php echo e(route('admin.categories.index')); ?>"
                   class="btn btn-outline-dark ml-3">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('customjs'); ?>
<script>
$(document).ready(function(){

    $("#categoryForm").submit(function(e){
        e.preventDefault();

        $(".text-danger").text('');
        $(".form-control").removeClass('is-invalid');

        let formData = new FormData(this);

        $.ajax({
            url: "<?php echo e(route('admin.categories.store')); ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response){

                if(response.status === true){
                    window.location.href = "<?php echo e(route('admin.categories.index')); ?>";
                } else {

                    let errors = response.errors;

                    if(errors.name){
                        $("#name").addClass('is-invalid')
                                  .siblings('p')
                                  .text(errors.name[0]);
                    }

                    if(errors.slug){
                        $("#slug").addClass('is-invalid')
                                  .siblings('p')
                                  .text(errors.slug[0]);
                    }
                }
            }
        });
    });

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

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views\admin\categories\create.blade.php ENDPATH**/ ?>