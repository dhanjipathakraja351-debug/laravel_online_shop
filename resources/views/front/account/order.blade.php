@extends('front.layouts.app')

@section('content')

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item">My Account</li>
                <li class="breadcrumb-item">Orders</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-9 pt-4">
<div class="container">
<div class="row">

    <!-- SIDEBAR -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-body p-0">

                <a href="{{ route('profile') }}" class="btn w-100 text-start border-bottom">
                    My Profile
                </a>

                <a href="{{ route('orders') }}" class="btn w-100 text-start bg-warning text-white border-bottom">
                    My Orders
                </a>

                <a href="#" class="btn w-100 text-start border-bottom">
                    Wishlist
                </a>

                <a href="#" class="btn w-100 text-start border-bottom">
                    Change Password
                </a>

                <a href="{{ route('logout') }}" class="btn w-100 text-start text-danger">
                    Logout
                </a>

            </div>
        </div>
    </div>

    <!-- ORDERS TABLE -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">

                <h4>My Orders</h4>

              <table class="table mt-3">
    <thead>
        <tr>
            <th>Orders #</th>
            <th>Date Purchased</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>

   <tbody>

@forelse($orders as $order)
<tr style="cursor:pointer;" onclick="window.location='{{ route('order.detail', $order->id) }}'">

    <!-- ✅ ORDER ID FIX -->
    <td>
        <a href="{{ route('order.detail', $order->id) }}" class="text-dark">
            ORD{{ $order->id }}
        </a>
    </td>

    <!-- DATE -->
    <td>
        {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}
    </td>

    <!-- STATUS -->
    <td>
      @if($order->status == 'pending')
    <span class="badge bg-warning text-dark">Pending</span>

@elseif($order->status == 'shipped')
    <span class="badge bg-info text-dark">Shipped</span>

@elseif($order->status == 'delivered')
    <span class="badge bg-success">Delivered</span>

@elseif($order->status == 'cancelled')
    <span class="badge bg-dark">Cancelled</span>

@endif
    </td>

    <!-- TOTAL -->
    <td>${{ $order->grand_total }}</td>

</tr>
@empty
<tr>
    <td colspan="4" class="text-center">No orders found</td>
</tr>
@endforelse

</tbody>
</table>

            </div>
        </div>
    </div>

</div>
</div>
</section>

@endsection