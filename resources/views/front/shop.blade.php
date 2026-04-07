@extends('front.layouts.app')
@section('content')

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="/">Home</a></li>
                <li class="breadcrumb-item active">Shop</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-6 pt-5">
    <div class="container">
        <div class="row">            

            <!-- SIDEBAR -->
            <div class="col-md-3 sidebar">

                <form action="{{ route('shop') }}" method="GET">

                <div class="sub-title">
                    <h2>Categories</h2>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionExample">

                            @foreach ($categories as $key => $category)

                            <div class="accordion-item">

                                <h2 class="accordion-header d-flex justify-content-between align-items-center">

                                    <a href="{{ route('shop', $category->slug) }}" 
                                       class="text-dark text-decoration-none p-2">
                                        {{ $category->name }}
                                    </a>

                                    <button class="accordion-button collapsed w-auto p-2"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $key }}">
                                    </button>

                                </h2>

                                <div id="collapse{{ $key }}"
                                     class="accordion-collapse collapse"
                                     data-bs-parent="#accordionExample">

                                    <div class="accordion-body">

                                        @foreach ($category->subCategories as $subCategory)

                                            <a href="{{ route('shop', [$category->slug, $subCategory->slug]) }}"
                                               class="d-block mb-1 text-dark">
                                                {{ $subCategory->name }}
                                            </a>

                                        @endforeach

                                    </div>
                                </div>

                            </div>

                            @endforeach

                        </div>
                    </div>
                </div>

                <!-- BRAND -->
                <div class="sub-title mt-5">
                    <h2>Brand</h2>
                </div>
                
                <div class="card">
                    <div class="card-body">

                        @foreach($brands as $brand)

                        <div class="form-check mb-2">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="brand[]" 
                                   value="{{ $brand->id }}"
                                   {{ in_array($brand->id, request()->brand ?? []) ? 'checked' : '' }}>

                            <label class="form-check-label">
                                {{ $brand->name }}
                            </label>
                        </div>

                        @endforeach

                    </div>
                </div>

                <!-- PRICE -->
                <div class="sub-title mt-5">
                    <h2>Price</h2>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="price[]" value="0-100">
                            <label class="form-check-label">$0 - $100</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="price[]" value="100-200">
                            <label class="form-check-label">$100 - $200</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="price[]" value="200-500">
                            <label class="form-check-label">$200 - $500</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="price[]" value="500+">
                            <label class="form-check-label">$500+</label>
                        </div>

                    </div>
                </div>

                <button class="btn btn-dark w-100 mt-3">Apply Filters</button>

                </form>

            </div>

            <!-- PRODUCTS -->
            <div class="col-md-9 d-flex flex-column" style="min-height: 70vh;">

                <div class="row pb-3 flex-grow-1">

                    @if($products->isNotEmpty())

                        @foreach($products as $product)

                        <div class="col-md-4">
                            <div class="card product-card">

                                <div class="product-image position-relative">
                                    
                                    <a href="{{ route('front.product', $product->slug) }}" class="product-img">

                                        <img class="card-img-top" 
                                             src="{{ $product->image 
                                                    ? asset('front-assets/images/' . $product->image) 
                                                    : asset('front-assets/images/default.jpg') }}" 
                                             alt="{{ $product->title }}">

                                    </a>

                                   <div class="product-action">

    <!-- ADD TO CART -->
    @if(!$product->track_qty || $product->qty > 0)
        <button class="btn btn-dark addToCartBtn" data-id="{{ $product->id }}">
            <i class="fa fa-shopping-cart"></i>
        </button>
    @else
        <button class="btn btn-danger" onclick="alert('This product is out of stock')">
            Out
        </button>
    @endif

    <!-- WISHLIST -->
    <form action="{{ route('wishlist.add', $product->id) }}" method="POST" style="display:inline;">
        @csrf
        <button class="btn btn-danger">
            ❤️
        </button>
    </form>

</div>
                                </div>                        

                                <div class="card-body text-center mt-3">
                                    
                                    <a class="h6 link" href="{{ route('front.product', $product->slug) }}">
                                        {{ $product->title }}
                                    </a>

                                    <div class="price mt-2">
                                        <strong>${{ $product->price }}</strong>

                                        @if($product->compare_price)
                                        <del>${{ $product->compare_price }}</del>
                                        @endif
                                    </div>
                                </div>                        

                            </div>                                               
                        </div>

                        @endforeach

                    @else
                        <div class="col-12 text-center">
                            <h4>No products found</h4>
                        </div>
                    @endif

                </div>

                <!-- PAGINATION -->
                <div class="d-flex justify-content-end mt-4">
                    {{ $products->withQueryString()->links() }}
                </div>

            </div>

        </div>
    </div>
</section>

@endsection