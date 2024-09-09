<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Package Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .content {
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Confirmation</h1>
        <p>Hello {{ $data['name'] }},</p>

        <p>Thank you for booking the lab package with us. Here are the details of your order:</p>

        <div class="content">
            <p><strong>Lab Package:</strong> {{ $data['package_name'] }}</p>
            <p><strong>Package Title:</strong> {{ $data['package_title'] }}</p>
            <p><strong>Amount:</strong> ${{ $data['package_amount'] }}</p>
            <p><strong>Included Tests:</strong> {{ implode(', ', json_decode($data['included_tests'])) }}</p>

            @if($data['instructions'])
                <p><strong>Instructions:</strong> {{ $data['instructions'] }}</p>
            @endif
        </div>

        <p>If you have any questions, feel free to contact us.</p>

        <p>Thank you for choosing our service!</p>

        <div class="footer">
            <p>Best Regards,</p>
            <p>HealDeal</p>
            <p><a href="{{ url('/') }}" class="button">Visit Our Website</a></p>
        </div>
    </div>
</body>
</html>
