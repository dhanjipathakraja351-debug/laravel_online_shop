@extends('admin.layouts.app')

@section('content')

<div class="container">

    <h2>Order Details (#{{ $order->id }})</h2>

    {{-- CUSTOMER INFO --}}
    <div class="card mb-3">
        <div class="card-header">Customer Information</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>City:</strong> {{ $order->city }}</p>
            <p><strong>State:</strong> {{ $order->state }}</p>
            <p><strong>Country:</strong> {{ $order->country }}</p>
            <p><strong>Zip:</strong> {{ $order->zip }}</p>
        </div>
    </div>

    {{-- ORDER STATUS --}}
    <div class="card mb-3">
        <div class="card-header">Order Status</div>
        <div class="card-body">

           @if($order->status == 'pending')
    <span class="badge bg-danger">Pending</span>
@elseif($order->status == 'shipped')
    <span class="badge bg-warning">Shipped</span>
@elseif($order->status == 'delivered')
    <span class="badge bg-success">Delivered</span>
@elseif($order->status == 'cancelled')
    <span class="badge bg-dark">Cancelled</span>
@endif

            <br><br>
            {{-- SHIPPED DATE --}}
@if($order->status == 'shipped')
    <div class="mt-3">
        <label><strong>Shipped Date:</strong></label>

        <input type="date" 
               class="form-control mt-1" 
               value="{{ $order->shipped_date ? \Carbon\Carbon::parse($order->shipped_date)->format('Y-m-d') : '' }}">

        @if($order->shipped_date)
            <small class="text-success">
                Saved: {{ \Carbon\Carbon::parse($order->shipped_date)->format('d M, Y') }}
            </small>
        @endif
    </div>
@endif

            <a href="{{ route('admin.orders.status', [$order->id, 'pending']) }}" class="btn btn-danger btn-sm">Pending</a>

<a href="{{ route('admin.orders.status', [$order->id, 'shipped']) }}" class="btn btn-warning btn-sm">Shipped</a>

<a href="{{ route('admin.orders.status', [$order->id, 'delivered']) }}" class="btn btn-success btn-sm">Delivered</a>

<a href="{{ route('admin.orders.status', [$order->id, 'cancelled']) }}" class="btn btn-dark btn-sm">Cancel</a>
        </div>
    </div>

    {{-- PRODUCTS --}}
    <div class="card mb-3">
        <div class="card-header">Products</div>
        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($order->orderItems as $item)
                    <tr>

                        {{-- ✅ FINAL FIX: always fetch from DB --}}
                        <td>
                            @php
                                $product = \App\Models\Product::find($item->product_id);
                            @endphp

                            {{ $product->title ?? 'N/A' }}
                        </td>

                        <td>${{ $item->price }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>${{ $item->price * $item->qty }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No products found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    {{-- ORDER SUMMARY --}}
    <div class="card">
        <div class="card-header">Order Summary</div>
        <div class="card-body">

            <p><strong>Subtotal:</strong> ${{ $order->subtotal }}</p>
            <p><strong>Shipped:</strong> ${{ $order->shipped ?? 0 }}</p>

            @if($order->coupon_code)
                <p><strong>Coupon ({{ $order->coupon_code }}):</strong> -${{ $order->discount }}</p>
            @else
                <p><strong>Discount:</strong> ${{ $order->discount ?? 0 }}</p>
            @endif

            <p><strong>Grand Total:</strong> ${{ $order->grand_total }}</p>

        </div>
    </div>

</div>

@endsection