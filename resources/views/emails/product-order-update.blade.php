<!DOCTYPE html>
<html>
<head>
    <title>Your Order Update</title>
</head>
<body>
    <h1>Hello, {{ $customer_name }}!</h1>

    <p>We wanted to inform you about the updates to your order <strong>#{{ $order_number }}</strong>.</p>
    
    <p><strong>Order Status:</strong> {{ $status }}</p>
    <p><strong>Payment Status:</strong> {{ $payment_status }}</p>

    @if ($order_update)
    <p><strong>Order Update:</strong> {{ $order_update }}</p>
    @endif

    <p>Thank you for your continued support!</p>

    <p>Best regards,<br>{{ getSetting('site_name') ?? '' }}</p>
</body>
</html>
