<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f6f9fc;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            line-height: 1.5;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #999;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You for Your Order!</h1>
        <p>Dear {{ $customer_name }},</p>
        <p>We have received your order and are currently processing it. Here are the details:</p>

        <ul>
            <li><strong>Name:</strong> {{ $customer_name }}</li>
            <li><strong>Phone Number:</strong> {{ $phone_number }}</li>
            <li><strong>Email:</strong> {{ $email }}</li>
        </ul>

        <p>If you have any special instructions, they are noted as follows:</p>
        <p>{{ $instructions }}</p>

        <p>Thank you for choosing us! If you have any questions, feel free to reach out.</p>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
