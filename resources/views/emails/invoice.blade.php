<h2>Invoice - ORD{{ $order->id }}</h2>

<p>Hello {{ $order->first_name }},</p>

<p>Thank you for your order. Here are your order details:</p>

<hr>

<h4>Customer Details</h4>
<p>{{ $order->first_name }} {{ $order->last_name }}</p>
<p>{{ $order->email }}</p>
<p>{{ $order->address }}, {{ $order->city }}</p>

<hr>

<h4>Order Items</h4>

<table width="100%" border="1" cellspacing="0" cellpadding="8">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->product->title ?? 'Product' }}</td>
            <td>${{ $item->price }}</td>
            <td>{{ $item->qty }}</td>
            <td>${{ $item->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<hr>

<h4>Summary</h4>

<p><strong>Subtotal:</strong> ${{ $order->subtotal }}</p>
<p><strong>Shipping:</strong> ${{ $order->shipping }}</p>

@if($order->discount > 0)
<p><strong>Discount:</strong> -${{ $order->discount }}</p>
@endif

@if($order->coupon_code)
<p><strong>Coupon:</strong> {{ $order->coupon_code }}</p>
@endif

<h3><strong>Total: ${{ $order->grand_total }}</strong></h3>

<hr>

<p>Thank you for shopping with us!</p>