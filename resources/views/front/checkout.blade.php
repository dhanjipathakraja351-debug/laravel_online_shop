@extends('front.layouts.app')

@section('content')

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('front.home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('shop') }}">Shop</a>
            </li>
            <li class="breadcrumb-item active">
                Checkout
            </li>
        </ol>
    </div>
</section>

<section class="section-9 pt-4">
<div class="container">
<div class="row">

<!-- SHIPPING -->
<div class="col-md-8">
<div class="card p-4">

<h4>Shipping Address</h4>

<div id="checkoutMsg" class="alert d-none"></div>

<input type="text" id="first_name" class="form-control mb-2" placeholder="First Name">
<input type="text" id="last_name" class="form-control mb-2" placeholder="Last Name">
<input type="text" id="email" class="form-control mb-2" placeholder="Email">

<select id="country" class="form-control mb-2">
<option value="">Select Country</option>
<option value="India">India</option>
<option value="USA">USA</option>
<option value="Other">Other</option>
</select>

<textarea id="address" class="form-control mb-2" placeholder="Address"></textarea>

<input type="text" id="city" class="form-control mb-2" placeholder="City">
<input type="text" id="state" class="form-control mb-2" placeholder="State">
<input type="text" id="zip" class="form-control mb-2" placeholder="Zip">
<input type="text" id="mobile" name="mobile" class="form-control mb-2" placeholder="Mobile">

</div>
</div>

<!-- SUMMARY -->
<div class="col-md-4">

<div class="card p-3 mb-3">
<h5>Apply Coupon</h5>

<div class="input-group">
    <input type="text" id="coupon_code" class="form-control" placeholder="Enter Coupon Code">
    <button class="btn btn-success" id="applyCouponBtn">Apply</button>
</div>

<button class="btn btn-danger mt-2 d-none" id="removeCouponBtn">
    Remove Coupon
</button>

<div id="couponMsg" class="mt-2 text-success"></div>
</div>

<div class="card p-3 mb-3">
<h5>Order Summary</h5>

@php $total = 0; @endphp

@foreach(session('cart', []) as $item)
@php 
    $itemTotal = $item['price'] * $item['quantity'];
    $total += $itemTotal;
@endphp

<div class="d-flex justify-content-between">
<span>{{ $item['title'] }} x {{ $item['quantity'] }}</span>
<span>${{ $itemTotal }}</span>
</div>
@endforeach

<hr>

<!-- SHIPPING -->
<div class="d-flex justify-content-between">
<strong>Shipping</strong>
<strong>$<span id="shippingCharge">0</span></strong>
</div>

<!-- DISCOUNT -->
<div class="d-flex justify-content-between">
<strong>Discount</strong>
<strong>$<span id="discountAmount">0</span></strong>
</div>

<!-- TOTAL -->
<div class="d-flex justify-content-between">
<strong>Total</strong>
<strong>$<span id="grandTotal">{{ $total }}</span></strong>
</div>

</div>

<!-- PAYMENT -->
<div class="card p-3">

<h5>Payment Method</h5>

<div class="mb-2">
<input type="radio" name="payment_method" value="cod" checked> Cash on Delivery
</div>

<div class="mb-2">
<input type="radio" name="payment_method" value="card"> Card Payment
</div>

<div id="cardBox" class="d-none">
<input type="text" id="card_number" class="form-control mb-2" placeholder="Card Number">
<input type="text" id="expiry" class="form-control mb-2" placeholder="MM/YYYY">
<input type="text" id="cvv" class="form-control mb-2" placeholder="CVV">
</div>

<button class="btn btn-dark w-100" id="placeOrderBtn">
Place Order
</button>

</div>

</div>

</div>
</div>
</section>

@endsection


@push('scripts')
<script>

$(document).ready(function(){

    let baseTotal = {{ $total }};
    let shipping = 0;
    let discount = 0;

    function updateTotal(){
        let finalTotal = baseTotal + parseFloat(shipping) - parseFloat(discount);
        $('#grandTotal').text(finalTotal);
    }

    // SHIPPING
    $('#country').change(function(){

        let country = $(this).val();

        if(country === 'India' || country === 'USA'){
            shipping = 10;
        } else if(country !== ''){
            shipping = 50;
        } else {
            shipping = 0;
        }

        $('#shippingCharge').text(shipping);
        updateTotal();
    });

    // PAYMENT TOGGLE
    $('input[name="payment_method"]').change(function(){
        $('#cardBox').toggleClass('d-none', $(this).val() !== 'card');
    });

    // APPLY COUPON
$('#applyCouponBtn').click(function(){

    let code = $('#coupon_code').val().trim();

    // ✅ FIX: empty check
    if(code === ''){
        $('#couponMsg')
            .removeClass('text-success')
            .addClass('text-danger')
            .text('Please enter coupon code');
        return;
    }

    $.post("{{ route('apply.coupon') }}", {
        _token: "{{ csrf_token() }}",
        code: code
    }, function(res){

        if(res.status){

            discount = parseFloat(res.discount);
            $('#discountAmount').text(discount);

            // ✅ FIX: reset color properly
            $('#couponMsg')
                .removeClass('text-danger')
                .addClass('text-success')
                .text(res.message);

            $('#removeCouponBtn').removeClass('d-none');

            updateTotal();

        } else {

            // ✅ FIX: reset color properly
            $('#couponMsg')
                .removeClass('text-success')
                .addClass('text-danger')
                .text(res.message);
        }

    }).fail(function(err){   // ✅ FIX: add fail handler
        console.log(err);
    });

});

    // REMOVE COUPON
    $('#removeCouponBtn').click(function(){

        discount = 0;
        $('#discountAmount').text(0);
        $('#coupon_code').val('');
        $('#couponMsg').text('');
        $(this).addClass('d-none');
        updateTotal();

    });

    // PLACE ORDER
    $('#placeOrderBtn').click(function(e){

        e.preventDefault();

        $.post("{{ route('place.order') }}", {
            _token: "{{ csrf_token() }}",
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val(),
            email: $('#email').val(),
            country: $('#country').val(),
            address: $('#address').val(),
            city: $('#city').val(),
            state: $('#state').val(),
            zip: $('#zip').val(),
            mobile: $('#mobile').val().trim(),

            // ✅ FIX: use existing variable (no redeclare)
            shipping: shipping,

            payment_method: $('input[name="payment_method"]:checked').val()

        }, function(res){

            if(res.status){
                $('#checkoutMsg')
                    .removeClass('d-none alert-danger')
                    .addClass('alert-success')
                    .text(res.message);

                setTimeout(()=> window.location.href = "/", 1500);
            } else {
                $('#checkoutMsg')
                    .removeClass('d-none alert-success')
                    .addClass('alert-danger')
                    .text(res.message);
            }

        }).fail(function(err){
            console.log(err);
        });

    });

});

</script>
@endpush