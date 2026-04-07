@extends('front.layouts.app')

@section('content')

<!-- BREADCRUMB -->
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
            <li class="breadcrumb-item active">{{ $product->title }}</li>
        </ol>
    </div>
</section>

<!-- PRODUCT DETAIL -->
<section class="section-6 pt-5 pb-5">
    <div class="container">
        <div class="row">

            <!-- IMAGE -->
            <div class="col-md-6">
                <div class="product-image">
                    <img class="img-fluid w-100"
                         src="{{ asset('front-assets/images/' . $product->image) }}"
                         alt="{{ $product->title }}">
                </div>
            </div>

            <!-- DETAILS -->
            <div class="col-md-6">

                <h2>{{ $product->title }}</h2>

                <!-- ⭐ DYNAMIC RATING -->
                <div class="mb-2">
                    @php
                        $avgRating = round($product->reviews->avg('rating'));
                    @endphp

                    @for($i=1;$i<=5;$i++)
                        @if($i <= $avgRating)
                            ⭐
                        @else
                            ☆
                        @endif
                    @endfor

                    <small>({{ $product->reviews->count() }} Reviews)</small>
                </div>

                <!-- PRICE -->
                <div class="price mb-3">
                    @if($product->compare_price)
                        <span class="text-muted text-decoration-line-through">
                            ${{ $product->compare_price }}
                        </span>
                    @endif

                    <span class="h4 text-dark ms-2">
                        ${{ $product->price }}
                    </span>
                </div>

                <!-- DESCRIPTION -->
                <p>
                    {{ $product->description ?? 'No description available.' }}
                </p>

                <!-- STOCK -->
                <p>
                    Availability: 
                    @if(!$product->track_qty || $product->qty > 0)
                        <span class="text-success">In Stock</span>
                    @else
                        <span class="text-danger">Out of Stock</span>
                    @endif
                </p>

                <p><strong>SKU:</strong> {{ $product->sku }}</p>

                <!-- ADD TO CART -->
                @if(!$product->track_qty || $product->qty > 0)

                <button 
                    class="btn btn-dark addToCartBtn" 
                    data-id="{{ $product->id }}">
                    Add To Cart
                </button>

                @else

                <button class="btn btn-danger" onclick="alert('This product is out of stock')">
                    Out of Stock
                </button>

                @endif

            </div>

        </div>
    </div>
</section>


<!-- DESCRIPTION + REVIEWS -->
<section class="section-7 pb-5">
    <div class="container">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#desc">
                    Description
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews">
                    Reviews ({{ $product->reviews->count() }})
                </button>
            </li>
        </ul>

        <div class="tab-content p-3 border">

            <!-- DESCRIPTION -->
            <div class="tab-pane fade show active" id="desc">
                {!! $product->description !!}
            </div>

            <!-- REVIEWS -->
            <div class="tab-pane fade" id="reviews">

                <!-- SUCCESS -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- ERROR -->
                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <!-- REVIEW FORM -->
                <h5 class="mb-3">Write a Review</h5>

                <form action="{{ route('review.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>

                    <!-- RATING -->
                    <div class="mb-3">
                        <label>Rating</label><br>
                        @for($i=1;$i<=5;$i++)
                            <input type="radio" name="rating" value="{{ $i }}"> ⭐
                        @endfor
                    </div>

                    <!-- COMMENT -->
                    <div class="mb-3">
                        <textarea name="comment" class="form-control" rows="4"
                            placeholder="How was your overall experience?"></textarea>
                    </div>

                    <button class="btn btn-dark">Submit</button>
                    <!-- AVERAGE RATING -->
@php
    $avgRating = round($product->reviews->avg('rating'),1);
@endphp

@if($product->reviews->count() > 0)
    <div class="mt-3">
        <strong>Average Rating:</strong>

        @for($i=1;$i<=5;$i++)
            @if($i <= floor($avgRating))
                ⭐
            @elseif($i - $avgRating < 1)
                ⭐
            @else
                ☆
            @endif
        @endfor

        <span> ({{ $avgRating }} / 5)</span>
    </div>
@endif
                </form>

                <hr>

                <!-- SHOW REVIEWS -->
                @foreach($product->reviews as $review)
                <div class="mb-3 border p-3">

                    <strong>{{ $review->name }}</strong>

                    <div>
                        @for($i=1;$i<=5;$i++)
                            @if($i <= $review->rating)
                                ⭐
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>

                    <p>{{ $review->comment }}</p>
                </div>
                @endforeach

            </div>

        </div>

    </div>
</section>


<!-- RELATED PRODUCTS -->
<section class="section-8 pb-5">
    <div class="container">

        <h3 class="mb-4">Related Products</h3>

        <div class="row">

            @foreach($relatedProducts as $item)

            <div class="col-md-3">
                <div class="card product-card">

                    <img class="card-img-top"
                         src="{{ asset('front-assets/images/' . $item->image) }}">

                    <div class="card-body text-center">

                        <a href="{{ route('front.product',$item->slug) }}">
                            {{ $item->title }}
                        </a>

                        <div class="price mt-2">
                            <strong>${{ $item->price }}</strong>
                        </div>

                    </div>

                </div>
            </div>

            @endforeach

        </div>

    </div>
</section>

@endsection