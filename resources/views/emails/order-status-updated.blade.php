<!DOCTYPE html>
<html>
<head>
    <title>Your Order Status Update</title>
</head>
<body>
    <h1>Hello, {{ $customer_name }}!</h1>

    <p>We wanted to let you know that your order <strong>#{{ $order_number }}</strong> has been <strong>{{ $status }}</strong>.</p>

    <p>Thank you for shopping with us!</p>

    <p>Best regards,<br>{{ getSetting('site_name') ?? '' }}</p>
</body>
</html>
