@extends('front.layouts.app')

@section('content')

<section class="section-5 pt-3 pb-3 bg-white">
    <div class="container">
        <h4>Order Details</h4>
    </div>
</section>

<section class="section-9 pt-4">
<div class="container">

<div class="row">

<!-- ORDER INFO -->
<div class="col-md-6">
<div class="card p-3 mb-3">

<h5>Order Info</h5>

<p><strong>Order ID:</strong> ORD{{ $order->id }}</p>
<p><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</p>

<p><strong>Status:</strong>
    @if($order->status == 'pending')
        <span class="badge bg-warning text-dark">Pending</span>

    @elseif($order->status == 'shipped')
        <span class="badge bg-info text-dark">Shipped</span>

    @elseif($order->status == 'delivered')
        <span class="badge bg-success">Delivered</span>

    @elseif($order->status == 'cancelled')
        <span class="badge bg-dark">Cancelled</span>
    @endif
</p>

<p><strong>Payment:</strong>
    @if($order->payment_status == 'paid')
        <span class="badge bg-success">Paid</span>
    @else
        <span class="badge bg-danger">Not Paid</span>
    @endif
</p>

</div>
</div>

<!-- SHIPPING -->
<div class="col-md-6">
<div class="card p-3 mb-3">
    <p><strong>Email:</strong> {{ $order->email }}</p>

<h5>Shipping Address</h5>

<p>{{ $order->first_name }} {{ $order->last_name }}</p>
<p>{{ $order->address }}</p>
<p>{{ $order->city }}, {{ $order->state }}</p>
<p>{{ $order->country }} - {{ $order->zip }}</p>
<p>📞 {{ $order->phone }}</p>

</div>
</div>

</div>

<!-- ORDER ITEMS -->
<div class="card p-3">

<h5>Order Items</h5>

<table class="table mt-3">
<thead>
<tr>
    <th>Product</th>
    <th>Image</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Total</th>
</tr>
</thead>

<tbody>

@foreach($orderItems as $item)
<tr>
    <!-- NAME -->
    <td>
    {{ $item->product->title ?? 'Product' }}
</td>

    <!-- IMAGE -->
    <td>
        @if($item->product && $item->product->image)
            <img src="{{ asset('front-assets/images/'.$item->product->image) }}" width="60">
        @else
            N/A
        @endif
    </td>

    <!-- PRICE -->
    <td>${{ $item->price }}</td>

    <!-- QTY -->
    <td>{{ $item->qty }}</td>

    <!-- TOTAL -->
    <td>${{ $item->total }}</td>

    
</tr>
@endforeach

</tbody>
</table>

<hr>

<div class="text-end">

    <p><strong>Total Items:</strong> {{ $totalQty }}</p>

    <p><strong>Subtotal:</strong> ${{ $order->subtotal }}</p>

    <p><strong>Shipping:</strong> ${{ $order->shipping }}</p>

    <!-- ✅ DISCOUNT -->
    @if($order->discount > 0)
        <p><strong>Discount:</strong> -${{ $order->discount }}</p>
    @endif

    <!-- ✅ COUPON -->
    @if($order->coupon_code)
        <p><strong>Coupon Used:</strong> {{ $order->coupon_code }}</p>
    @endif

    <h5><strong>Grand Total: ${{ $order->grand_total }}</strong></h5>

</div>

</div>

</div>
</section>

@endsection