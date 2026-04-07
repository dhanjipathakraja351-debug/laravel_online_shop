<h2>Order Confirmation</h2>

<p>Hello {{ $order->first_name }},</p>

<p>Your order has been placed successfully.</p>

<p><strong>Order ID:</strong> ORD{{ $order->id }}</p>
<p><strong>Total:</strong> ${{ $order->grand_total }}</p>

<p>Status: {{ ucfirst($order->status) }}</p>

<p>Thank you for shopping with us!</p>