@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="/">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('shop') }}">Shop</a></li>
                <li class="breadcrumb-item">Cart</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-9 pt-4">
    <div class="container">
        <div id="cartMessage" class="alert alert-success d-none"></div>
        <div class="row">

            <!-- CART -->
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table" id="cart">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>

                        <tbody>

                        @php $subtotal = 0; @endphp

                        @if(session('cart') && count(session('cart')) > 0)

                            @foreach(session('cart') as $id => $item)

                            @php
                                $itemTotal = $item['price'] * $item['quantity'];
                                $subtotal += $itemTotal;
                            @endphp

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('front-assets/images/'.$item['image']) }}" width="60">
                                        <h6 class="ms-2">{{ $item['title'] }}</h6>
                                    </div>
                                </td>

                                <td>${{ $item['price'] }}</td>

                                <td>
                                    <div class="input-group quantity mx-auto" style="width: 100px;">

                                        <button type="button" class="btn btn-sm btn-dark decreaseQty" data-id="{{ $id }}">
                                            <i class="fa fa-minus"></i>
                                        </button>

                                        <input type="text"
                                               class="form-control form-control-sm border-0 text-center"
                                               value="{{ $item['quantity'] }}"
                                               readonly>

                                        <button type="button" class="btn btn-sm btn-dark increaseQty" data-id="{{ $id }}">
                                            <i class="fa fa-plus"></i>
                                        </button>

                                    </div>
                                </td>

                                <td>${{ $itemTotal }}</td>

                                <td>
                                    <button class="btn btn-sm btn-danger removeItem" data-id="{{ $id }}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>

                            @endforeach

                        @else

                            <tr>
                                <td colspan="5" class="text-center">Your cart is empty</td>
                            </tr>

                        @endif

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SUMMARY -->
            <div class="col-md-4">            
                <div class="card cart-summery">
                    <div class="sub-title">
                        <h2 class="bg-white">Cart Summery</h2>
                    </div> 

                    <div class="card-body">

                        <div class="d-flex justify-content-between pb-2">
                            <div>Subtotal</div>
                            <div>${{ $subtotal }}</div>
                        </div>

                        <!-- ✅ SHIPPING FIXED -->
                        <div class="d-flex justify-content-between pb-2">
                            <div>Shipping</div>
                            <div>$<span id="shippingCharge">0</span></div>
                        </div>

                        <!-- ✅ TOTAL FIXED -->
                        <div class="d-flex justify-content-between summery-end">
                            <div>Total</div>
                            <div>$<span id="grandTotal">{{ $subtotal }}</span></div>
                        </div>

                        <div class="pt-5">
                           <a href="{{ route('front.checkout') }}" class="btn-dark btn btn-block w-100">
                                Proceed to Checkout
                           </a>
                        </div>

                    </div>
                </div>     

                <div class="input-group apply-coupan mt-4">
    <input type="text" id="coupon_code" placeholder="Coupon Code" class="form-control">
    <button class="btn btn-dark" type="button" id="applyCouponBtn">Apply Coupon</button>
</div>

<div id="cartCouponMsg" class="mt-2"></div>

            </div>


        </div>
    </div>
</section>
@endsection


@push('scripts')
<script>

    // APPLY COUPON (FIXED)
$(document).on('click', '#applyCouponBtn', function(e){

    e.preventDefault();

    let code = $('#coupon_code').val().trim();

    if(code === ''){
        $('#cartCouponMsg')
            .removeClass('text-success')
            .addClass('text-danger')
            .text('Please enter coupon code');
        return;
    }

    $.ajax({
        url: "{{ route('apply.coupon') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            code: code
        },
        success: function(res){

            if(res.status){

                $('#cartCouponMsg')
                    .removeClass('text-danger')
                    .addClass('text-success')
                    .text(res.message);

            } else {

                $('#cartCouponMsg')
                    .removeClass('text-success')
                    .addClass('text-danger')
                    .text(res.message);
            }

        },
        error: function(err){
            console.log(err);
        }
    });

});

// ✅ DEFAULT SHIPPING (OPTIONAL SAFE)
let baseTotal = {{ $subtotal }};
let defaultShipping = 0;

$('#shippingCharge').text(defaultShipping);
$('#grandTotal').text(baseTotal + defaultShipping);

// REMOVE
$(document).on('click', '.removeItem', function(){

    let id = $(this).data('id');

    $.ajax({
        url: "/cart/remove/" + id,
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(response){

            $('#cartMessage')
                .removeClass('d-none')
                .text(response.message);

            setTimeout(function(){
                location.reload();
            }, 1000);
        }
    });

});

// INCREASE
$(document).on('click', '.increaseQty', function(){

    let id = $(this).data('id');

    $.ajax({
        url: "/cart/update/" + id,
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            type: "increase"
        },
        success: function(response){

            $('#cartMessage')
                .removeClass('d-none')
                .text(response.message);

            setTimeout(function(){
                location.reload();
            }, 1000);
        }
    });

});

// DECREASE
$(document).on('click', '.decreaseQty', function(){

    let id = $(this).data('id');

    $.ajax({
        url: "/cart/update/" + id,
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            type: "decrease"
        },
        success: function(response){

            $('#cartMessage')
                .removeClass('d-none')
                .text(response.message);

            setTimeout(function(){
                location.reload();
            }, 1000);
        }
    });

});
</script>
@endpush