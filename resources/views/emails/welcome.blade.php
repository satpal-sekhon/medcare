<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        p {
            line-height: 1.5;
        }
        .cta-button {
            display: inline-block;
            background-color: #007bff;
            color: white!important;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f9f9f9;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to {{ getSetting('site_name') }}, {{ $userName }}!</h1>
        </div>
        <div class="content">
            <p>Thank you for joining us! We are thrilled to have you on board.</p>
            <p>Here are some things you can do to get started:</p>
            <ul>
                <li><strong>Order Medicines:</strong> Browse our extensive range of medicines available for delivery.</li>
                <li><strong>Consult Doctors:</strong> Schedule an online consultation with our certified doctors.</li>
                <li><strong>Health Tips:</strong> Stay informed with our health and wellness tips available on our blog.</li>
            </ul>
            <p>We're here to support you every step of the way!</p>
            <a href="{{ url('/') }}" class="cta-button">Get Started</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ getSetting('site_name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
