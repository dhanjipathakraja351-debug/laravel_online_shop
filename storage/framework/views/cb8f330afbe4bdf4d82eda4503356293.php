<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Laravel Online Shop - Admin</title>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Summernote -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

<!-- Dropzone -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"/>

<style>

body{
margin:0;
font-family:Arial, Helvetica, sans-serif;
background:#f4f6f9;
}

/* Sidebar */

.sidebar{
width:250px;
height:100vh;
position:fixed;
background:#343a40;
color:white;
padding-top:20px;
}

.sidebar h4{
text-align:center;
margin-bottom:20px;
}

.sidebar ul{
list-style:none;
padding-left:0;
}

.sidebar ul li{
border-bottom:1px solid rgba(255,255,255,0.05);
}

.sidebar ul li a{
display:block;
color:#c2c7d0;
padding:12px 20px;
text-decoration:none;
}

.sidebar ul li a:hover{
background:#495057;
color:white;
}

.sidebar ul li i{
margin-right:10px;
}

/* Content */

.main-content{
margin-left:250px;
padding:25px;
}

</style>

</head>

<body>

<!-- Sidebar -->

<div class="sidebar">

<h4>LARAVEL SHOP</h4>

<hr>

<ul>

<li>
<a href="<?php echo e(url('/admin/dashboard')); ?>">
<i class="fa fa-gauge"></i> Dashboard
</a>
</li>

<li>
<a href="<?php echo e(url('/admin/categories')); ?>">
<i class="fa fa-list"></i> Categories
</a>
</li>

<li>
<a href="<?php echo e(route('admin.sub-categories.index')); ?>">
<i class="fa fa-tags"></i> Sub Categories
</a>
</li>

<li>
<a href="<?php echo e(url('/admin/brands')); ?>">
<i class="fa fa-copyright"></i> Brands
</a>
</li>

<li>
<a href="<?php echo e(url('/admin/products')); ?>">
<i class="fa fa-box"></i> Products
</a>
</li>

<li>
<a href="<?php echo e(url('/admin/orders')); ?>">
<i class="fa fa-cart-shopping"></i> Orders
</a>
</li>

<li>
<a href="<?php echo e(url('/admin/users')); ?>">
<i class="fa fa-users"></i> Users
</a>
</li>

<li class="mt-3">
<form method="POST" action="<?php echo e(route('admin.logout')); ?>">
<?php echo csrf_field(); ?>
<button type="submit" class="text-danger border-0 bg-transparent">
<i class="fa fa-right-from-bracket"></i> Logout
</button>
</form>
</li>

</ul>

</div>

<!-- Page Content -->

<div class="main-content">

<?php echo $__env->yieldContent('content'); ?>

</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Summernote -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<!-- Dropzone -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

<script>

$(document).ready(function(){

$('.summernote').summernote({
height:200
});

});

</script>

<?php echo $__env->yieldContent('customjs'); ?>

</body>
</html><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views\admin\layouts\app.blade.php ENDPATH**/ ?>