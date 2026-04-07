@extends('front.layouts.app')

@section('content')

<!-- HERO -->
<section class="section-1">
<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
<div class="carousel-inner">

<div class="carousel-item active">
<img src="{{ asset('front-assets/images/carousel-1.jpg') }}" class="d-block w-100">
<div class="carousel-caption">
<h1 class="display-4 text-white">Kids Fashion</h1>
<p>Best products at lowest price</p>
<a class="btn btn-outline-light mt-3">Shop Now</a>
</div>
</div>

<div class="carousel-item">
<img src="{{ asset('front-assets/images/carousel-2.jpg') }}" class="d-block w-100">
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

@foreach($categories as $category)
<div class="col-lg-3">

<div class="cat-card">
<div class="left">

<img src="
@if($category->name == 'Electronics')
    {{ asset('front-assets/images/mobile.jpg') }}
@elseif($category->name == 'Fashion')
    {{ asset('front-assets/images/shirt.jpg') }}
@elseif($category->name == 'Home Appliances')
    {{ asset('front-assets/images/laptop.jpg') }}
@else
    {{ asset('front-assets/images/default.jpg') }}
@endif
" class="img-fluid">

</div>

<div class="right">
<div class="cat-data">
<h2>{{ $category->name }}</h2>
<p>{{ $category->subCategories->count() }} Products</p>
</div>
</div>

</div>

</div>
@endforeach

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

@foreach($featuredProducts as $product)
<div class="col-md-3">

<div class="card product-card">

<div class="product-image">
<img class="card-img-top"
     src="{{ asset('front-assets/images/' . $product->image) }}"
     onerror="this.src='{{ asset('front-assets/images/default.jpg') }}">
</div>

<div class="card-body text-center">

<h6>{{ $product->title }}</h6>

<div class="price">
<strong>${{ $product->price }}</strong>
@if($product->compare_price)
<del>${{ $product->compare_price }}</del>
@endif
</div>

<div class="mt-2">

@if(!$product->track_qty || $product->qty > 0)
<button class="btn btn-sm btn-dark addToCartBtn" data-id="{{ $product->id }}">
    Add to Cart
</button>
@else
<button class="btn btn-sm btn-danger" onclick="alert('This product is out of stock')">
    Out of Stock
</button>
@endif

<form action="{{ route('wishlist.add', $product->id) }}" method="POST" style="display:inline;">
    @csrf
    <button class="btn btn-sm btn-danger">❤️</button>
</form>

</div>

</div>
</div>

</div>
@endforeach

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

@foreach($latestProducts as $product)
<div class="col-md-3">

<div class="card product-card">

<div class="product-image">
<img class="card-img-top"
     src="{{ asset('front-assets/images/' . $product->image) }}"
     onerror="this.src='{{ asset('front-assets/images/default.jpg') }}">
</div>

<div class="card-body text-center">

<h6>{{ $product->title }}</h6>

<div class="price">
<strong>${{ $product->price }}</strong>
@if($product->compare_price)
<del>${{ $product->compare_price }}</del>
@endif
</div>

<div class="mt-2">

{{-- ✅ FIX ADDED HERE --}}
@if(!$product->track_qty || $product->qty > 0)
<button class="btn btn-sm btn-dark addToCartBtn" data-id="{{ $product->id }}">
    Add to Cart
</button>
@else
<button class="btn btn-sm btn-danger" onclick="alert('This product is out of stock')">
    Out of Stock
</button>
@endif

<form action="{{ route('wishlist.add', $product->id) }}" method="POST" style="display:inline;">
    @csrf
    <button class="btn btn-sm btn-danger">❤️</button>
</form>

</div>

</div>
</div>

</div>
@endforeach

</div>
</div>
</section>

@endsection

