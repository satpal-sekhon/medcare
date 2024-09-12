<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Avenir, Helvetica, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        h3 {
            font-size: 20px;
            font-weight: normal;
            color: #555;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            color: #666;
            line-height: 1.5em;
            margin-bottom: 20px;
        }
        .otp {
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
            display: block;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .footer {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello {{ $name ?? $email }},</h1>
        <h3>We've received a request to verify your email address.</h3>
        <p>Please use the following one-time password (OTP) to complete the verification process:</p>
        <span class="otp">{{ $otp }}</span>
        <p>If you did not request this verification, please ignore this email.</p>

        <p class="footer">
            © {{ date('Y') }} HealDeal. All rights reserved.<br>
            <a href="#">Privacy Policy</a> | <a href="#">Contact Us</a>
        </p>
    </div>
</body>
</html>
