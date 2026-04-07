

<?php $__env->startSection('content'); ?>

<div class="container">

<h2>Reviews</h2>

<?php if(session('success')): ?>
<div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<table class="table table-bordered">

<thead>
<tr>
    <th>#</th>
    <th>Product</th>
    <th>Name</th>
    <th>Rating</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($review->id); ?></td>
    <td><?php echo e($review->product->title ?? ''); ?></td>
    <td><?php echo e($review->name); ?></td>
    <td>
        <?php for($i=1;$i<=5;$i++): ?>
            <?php echo e($i <= $review->rating ? '⭐' : '☆'); ?>

        <?php endfor; ?>
    </td>

    <td>
        <?php if($review->status): ?>
            <span class="badge bg-success">Approved</span>
        <?php else: ?>
            <span class="badge bg-warning">Pending</span>
        <?php endif; ?>
    </td>

    <td>
        <?php if(!$review->status): ?>
        <a href="<?php echo e(route('admin.reviews.approve',$review->id)); ?>"
           class="btn btn-sm btn-success">Approve</a>
        <?php endif; ?>

        <a href="<?php echo e(route('admin.reviews.delete',$review->id)); ?>"
           class="btn btn-sm btn-danger"
           onclick="return confirm('Delete?')">
           Delete
        </a>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

</table>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views/admin/reviews/list.blade.php ENDPATH**/ ?>