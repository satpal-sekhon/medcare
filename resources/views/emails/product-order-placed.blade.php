<!DOCTYPE html>
<html>
<head>
    <title>Order Summary</title>
</head>
<body>
    <h1>Thank you for your order, {{ $data['customer_name'] }}!</h1>
    <p>Your order number is: {{ $data['order_number'] }}</p>
    <p>Status: {{ $data['status'] }}</p>
    <p>Payment Status: {{ $data['payment_status'] }}</p>
    <p>A confirmation email has been sent to: {{ $data['email'] }}</p>
    <h2>Order Details:</h2>
    <ul>
        @foreach ($data['order_items'] as $item)
            <li>{{ $item['name'] }} - Quantity: {{ $item['quantity'] }} - Price: {{ $item['price'] }}</li>
        @endforeach
    </ul>
</body>
</html>
