<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<meta charset="UTF-8">
<title>Laravel Online Shop</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('front-assets/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('front-assets/css/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

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

<form action="{{ route('shop') }}" method="GET">
<div class="input-group">
<input type="text" 
       name="keyword"
       placeholder="Search Products" 
       class="form-control"
       value="{{ request()->keyword }}">
<button class="input-group-text">
<i class="fa fa-search"></i>
</button>
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

@if(getCategories()->isNotEmpty())

@foreach(getCategories() as $category)

<li class="nav-item dropdown">

<a class="nav-link dropdown-toggle text-white" 
   href="{{ route('shop', [$category->slug]) }}" 
   data-bs-toggle="dropdown">
    {{ $category->name }}
</a>

@if($category->subCategories->isNotEmpty())
<ul class="dropdown-menu dropdown-menu-dark">

@foreach($category->subCategories as $subCategory)

<li>
    <a class="dropdown-item" 
       href="{{ route('shop', [$category->slug, $subCategory->slug]) }}">
        {{ $subCategory->name }}
    </a>
</li>

@endforeach

</ul>
@endif

</li>

@endforeach

@endif

</ul>

</div>

<a href="{{ route('front.cart') }}" class="ml-3 d-flex pt-2">
    <i class="fas fa-shopping-cart text-primary"></i>
</a>

</nav>

</div>
</header>


<main>

@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    </div>
@endif

@yield('content')

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

<ul class="list-unstyled">
@foreach($pages as $page)
<li>
    <a href="{{ route('front.page', $page->slug) }}" class="text-white text-decoration-none">
        {{ $page->name }}
    </a>
</li>
@endforeach
</ul>

</div>


<div class="col-md-4">
<h3 class="text-white">My Account</h3>

<ul class="list-unstyled">
<li><a href="{{ route('login') }}" class="text-white text-decoration-none">Login</a></li>
<li><a href="{{ route('register') }}" class="text-white text-decoration-none">Register</a></li>
<li><a href="{{ route('profile') }}" class="text-white text-decoration-none">Orders</a></li>
</ul>

</div>

</div>

</div>

<div class="text-center text-white pb-3">
© {{ date('Y') }} Amazing Shop
</div>

</footer>


<script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
<script src="{{ asset('front-assets/js/custom.js') }}"></script>


<script>
$(document).on('click', '.addToCartBtn', function(e){
    e.preventDefault();

    let productId = $(this).data('id');

    $.ajax({
        url: "{{ route('front.addToCart') }}",
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: productId
        },
        success: function(response){
            alert(response.message);
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
    });
});
</script>

@stack('scripts')

</body>
</html>