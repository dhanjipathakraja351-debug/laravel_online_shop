

<?php $__env->startSection('content'); ?>

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

<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-lg-3">

<div class="cat-card">
<div class="left">

<img src="
<?php if($category->name == 'Electronics'): ?>
    <?php echo e(asset('front-assets/images/mobile.jpg')); ?>

<?php elseif($category->name == 'Fashion'): ?>
    <?php echo e(asset('front-assets/images/shirt.jpg')); ?>

<?php elseif($category->name == 'Home Appliances'): ?>
    <?php echo e(asset('front-assets/images/laptop.jpg')); ?>

<?php else: ?>
    <?php echo e(asset('front-assets/images/default.jpg')); ?>

<?php endif; ?>
" class="img-fluid">

</div>

<div class="right">
<div class="cat-data">
<h2><?php echo e($category->name); ?></h2>
<p><?php echo e($category->subCategories->count()); ?> Products</p>
</div>
</div>

</div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

<?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-3">

<div class="card product-card">

<div class="product-image">
<img class="card-img-top"
     src="<?php echo e(asset('front-assets/images/' . $product->image)); ?>"
     onerror="this.src='<?php echo e(asset('front-assets/images/default.jpg')); ?>">
</div>

<div class="card-body text-center">

<h6><?php echo e($product->title); ?></h6>

<div class="price">
<strong>$<?php echo e($product->price); ?></strong>
<?php if($product->compare_price): ?>
<del>$<?php echo e($product->compare_price); ?></del>
<?php endif; ?>
</div>

<div class="mt-2">

<?php if(!$product->track_qty || $product->qty > 0): ?>
<button class="btn btn-sm btn-dark addToCartBtn" data-id="<?php echo e($product->id); ?>">
    Add to Cart
</button>
<?php else: ?>
<button class="btn btn-sm btn-danger" onclick="alert('This product is out of stock')">
    Out of Stock
</button>
<?php endif; ?>

<form action="<?php echo e(route('wishlist.add', $product->id)); ?>" method="POST" style="display:inline;">
    <?php echo csrf_field(); ?>
    <button class="btn btn-sm btn-danger">❤️</button>
</form>

</div>

</div>
</div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

<?php $__currentLoopData = $latestProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-3">

<div class="card product-card">

<div class="product-image">
<img class="card-img-top"
     src="<?php echo e(asset('front-assets/images/' . $product->image)); ?>"
     onerror="this.src='<?php echo e(asset('front-assets/images/default.jpg')); ?>">
</div>

<div class="card-body text-center">

<h6><?php echo e($product->title); ?></h6>

<div class="price">
<strong>$<?php echo e($product->price); ?></strong>
<?php if($product->compare_price): ?>
<del>$<?php echo e($product->compare_price); ?></del>
<?php endif; ?>
</div>

<div class="mt-2">


<?php if(!$product->track_qty || $product->qty > 0): ?>
<button class="btn btn-sm btn-dark addToCartBtn" data-id="<?php echo e($product->id); ?>">
    Add to Cart
</button>
<?php else: ?>
<button class="btn btn-sm btn-danger" onclick="alert('This product is out of stock')">
    Out of Stock
</button>
<?php endif; ?>

<form action="<?php echo e(route('wishlist.add', $product->id)); ?>" method="POST" style="display:inline;">
    <?php echo csrf_field(); ?>
    <button class="btn btn-sm btn-danger">❤️</button>
</form>

</div>

</div>
</div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</div>
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views/front/home.blade.php ENDPATH**/ ?>