<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<meta charset="UTF-8">
<title>Laravel Online Shop</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="<?php echo e(asset('front-assets/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('front-assets/css/slick.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('front-assets/css/slick-theme.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('front-assets/css/style.css')); ?>">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">
</head>

<body>

<!-- TOP HEADER -->
<div class="bg-light top-header">
<div class="container">
<div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">

<div class="col-lg-4 logo">
<a href="/" class="text-decoration-none">
<span class="h1 text-uppercase text-primary bg-dark px-2">Online</span>
<span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">SHOP</span>
</a>
</div>

<div class="col-lg-6 col-6 text-left d-flex justify-content-end align-items-center">

<a href="#" class="nav-link text-dark">My Account</a>

<form>
<div class="input-group">
<input type="text" placeholder="Search Products" class="form-control">
<span class="input-group-text">
<i class="fa fa-search"></i>
</span>
</div>
</form>

</div>
</div>
</div>
</div>


<!-- NAVBAR -->
<header class="bg-dark">

<div class="container">

<nav class="navbar navbar-expand" id="navbar">

<a href="/" class="mobile-logo text-decoration-none">
<span class="h2 text-uppercase text-primary bg-dark">Online</span>
<span class="h2 text-uppercase text-white px-2">SHOP</span>
</a>

<button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
<i class="navbar-toggler-icon fas fa-bars"></i>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav me-auto">

<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
Electronics
</a>

<ul class="dropdown-menu dropdown-menu-dark">
<li><a class="dropdown-item" href="#">Mobile</a></li>
<li><a class="dropdown-item" href="#">Tablets</a></li>
<li><a class="dropdown-item" href="#">Laptops</a></li>
<li><a class="dropdown-item" href="#">Speakers</a></li>
</ul>
</li>

<li class="nav-item dropdown">
<button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown">
Men Fashion
</button>

<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
Men Fashion
</a>

<ul class="dropdown-menu dropdown-menu-dark">
<li><a class="dropdown-item" href="#">Shirts</a></li>
<li><a class="dropdown-item" href="#">Shoes</a></li>
</ul>
</li>
</div>

<div class="right-nav py-0">
<a href="#" class="ml-3 d-flex pt-2">
<i class="fas fa-shopping-cart text-primary"></i>
</a>
</div>

</nav>

</div>
</header>



<main>

<!-- HERO -->
<section class="section-1">

<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">

<div class="carousel-inner">

<div class="carousel-item active">

<img src="<?php echo e(asset('front-assets/images/carousel-1.jpg')); ?>" class="d-block w-100">

<div class="carousel-caption">
<h1 class="display-4 text-white">Kids Fashion</h1>
<p>Best products at lowest price</p>
<a class="btn btn-outline-light mt-3">Shop Now</a>
</div>

</div>

<div class="carousel-item">

<img src="<?php echo e(asset('front-assets/images/carousel-2.jpg')); ?>" class="d-block w-100">

<div class="carousel-caption">
<h1 class="display-4 text-white">Women Fashion</h1>
<p>New arrival collection</p>
<a class="btn btn-outline-light mt-3">Shop Now</a>
</div>

</div>

</div>

</div>

</section>



<!-- FEATURE BOXES -->
<section class="section-2">
<div class="container">
<div class="row">

<div class="col-lg-3">
<div class="box shadow-lg">
<div class="fa icon fa-check text-primary"></div>
<h2>Quality Product</h2>
</div>
</div>

<div class="col-lg-3">
<div class="box shadow-lg">
<div class="fa icon fa-shipping-fast text-primary"></div>
<h2>Free Shipping</h2>
</div>
</div>

<div class="col-lg-3">
<div class="box shadow-lg">
<div class="fa icon fa-exchange-alt text-primary"></div>
<h2>14-Day Return</h2>
</div>
</div>

<div class="col-lg-3">
<div class="box shadow-lg">
<div class="fa icon fa-phone-volume text-primary"></div>
<h2>24/7 Support</h2>
</div>
</div>

</div>
</div>
</section>



<!-- CATEGORIES -->
<section class="section-3">
<div class="container">

<div class="section-title">
<h2>Categories</h2>
</div>

<div class="row">

<?php for($i = 0; $i < 8; $i++): ?>

<div class="col-lg-3">

<div class="cat-card">

<div class="left">
<img src="<?php echo e(asset('front-assets/images/cat-1.jpg')); ?>" class="img-fluid">
</div>

<div class="right">
<div class="cat-data">
<h2>Mens</h2>
<p>100 Products</p>
</div>
</div>

</div>

</div>

<?php endfor; ?>

</div>

</div>
</section>



<!-- FEATURED PRODUCTS -->
<section class="section-4 pt-5">

<div class="container">

<div class="section-title">
<h2>Featured Products</h2>
</div>

<div class="row">

<?php for($i = 0; $i < 8; $i++): ?>

<div class="col-md-3">

<div class="card product-card">

<div class="product-image">
<img class="card-img-top" src="<?php echo e(asset('front-assets/images/product-1.jpg')); ?>">
</div>

<div class="card-body text-center">

<h6>Dummy Product</h6>

<div class="price">
<strong>$100</strong>
<del>$120</del>
</div>

</div>

</div>

</div>

<?php endfor; ?>

</div>

</div>

</section>



<!-- LATEST PRODUCTS -->
<section class="section-4 pt-5">

<div class="container">

<div class="section-title">
<h2>Latest Products</h2>
</div>

<div class="row">

<?php for($i = 0; $i < 8; $i++): ?>

<div class="col-md-3">

<div class="card product-card">

<div class="product-image">
<img class="card-img-top" src="<?php echo e(asset('front-assets/images/product-1.jpg')); ?>">
</div>

<div class="card-body text-center">

<h6>Dummy Product</h6>

<div class="price">
<strong>$100</strong>
<del>$120</del>
</div>

</div>

</div>

</div>

<?php endfor; ?>

</div>

</div>

</section>

</main>



<!-- FOOTER -->
<footer class="bg-dark mt-5">

<div class="container pb-5 pt-3">

<div class="row">

<div class="col-md-4">
<h3 class="text-white">Get In Touch</h3>

<p class="text-white">
123 Street, New York<br>
example@email.com<br>
0000000000
</p>
</div>


<div class="col-md-4">
<h3 class="text-white">Important Links</h3>

<ul>
<li><a href="#">About</a></li>
<li><a href="#">Contact</a></li>
<li><a href="#">Privacy</a></li>
</ul>
</div>


<div class="col-md-4">
<h3 class="text-white">My Account</h3>

<ul>
<li><a href="#">Login</a></li>
<li><a href="#">Register</a></li>
<li><a href="#">Orders</a></li>
</ul>
</div>

</div>

</div>

<div class="text-center text-white pb-3">
© 2022 Amazing Shop
</div>

</footer>



<script src="<?php echo e(asset('front-assets/js/jquery-3.6.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('front-assets/js/bootstrap.bundle.5.1.3.min.js')); ?>"></script>
<script src="<?php echo e(asset('front-assets/js/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('front-assets/js/custom.js')); ?>"></script>

</body>
</html><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views\front\home.blade.php ENDPATH**/ ?>