<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Consultation Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007BFF;
        }
        p {
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            color: #888;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Doctor Consultation Order Confirmation</h1>
        <p>Dear {{ $name }},</p>
        <p>Thank you for scheduling a consultation with us. Here are the details of your order:</p>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Doctor Type:</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $doctor_type }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Doctor Name:</td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $doctor_name }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Amount Paid:</td>
                <td style="padding: 10px; border: 1px solid #ddd;">${{ number_format($amount_paid, 2) }}</td>
            </tr>
        </table>
        <p>If you have any questions, please do not hesitate to contact us.</p>
        <p>Best regards,<br>The Consultation Team</p>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} HealDeal. All rights reserved.</p>
    </div>
</body>
</html>
