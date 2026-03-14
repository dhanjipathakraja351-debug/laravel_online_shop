

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Brand</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo e(route('admin.brands.create')); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <form id="createbrandForm">
            <?php echo csrf_field(); ?>

            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control"
                                       placeholder="Enter Brand Name">
                                <small class="text-danger"></small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text"
                                       name="slug"
                                       id="slug"
                                       readonly
                                       class="form-control"
                                       placeholder="Slug">
                                <small class="text-danger"></small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
    <div class="form-group">
        <label>Status</label>
        <select name="status" id="status" class="form-control">
            <option value="1">Active</option>
            <option value="0">Block</option>
        </select>
        <small class="text-danger"></small>
    </div>
</div>

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
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

    // Submit form
    $("#createbrandForm").submit(function(e){
        e.preventDefault();

        $(".text-danger").text('');
        $(".form-control").removeClass('is-invalid');

        $.ajax({
            url: "<?php echo e(route('admin.brands.store')); ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response){

                if(response.status){
                    window.location.href = "<?php echo e(route('admin.brands.create')); ?>";
                } else {

                    if(response.errors.name){
                        $("#name").addClass('is-invalid');
                        $("#name").next(".text-danger").text(response.errors.name[0]);
                    }

                    if(response.errors.slug){
                        $("#slug").addClass('is-invalid');
                        $("#slug").next(".text-danger").text(response.errors.slug[0]);
                    }

                }
            },
            error: function(xhr){
                console.log(xhr.responseText);
                alert("Something went wrong");
            }
        });

    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views/admin/brands/create.blade.php ENDPATH**/ ?>