@extends('admin.layouts.app')

@section('content')

<div class="container">
    <h2>Orders</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Order#</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Date Purchased</th>
            </tr>
        </thead>

        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}">
                        {{ $order->id }}
                    </a>
                </td>

                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->phone ?? 'N/A' }}</td>

                <td>
                  @if($order->status == 'pending')
    <span class="badge bg-danger">Pending</span>
@elseif($order->status == 'shipped')
    <span class="badge bg-warning">Shipped</span>
@elseif($order->status == 'delivered')
    <span class="badge bg-success">Delivered</span>
@elseif($order->status == 'cancelled')
    <span class="badge bg-dark">Cancelled</span>
@endif
                </td>

                <td>${{ number_format($order->grand_total, 2) }}</td>

                <td>{{ $order->created_at->format('d M, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection