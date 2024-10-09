<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
            line-height: 1.5;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
        .highlight {
            background-color: #e9f7ef;
            padding: 10px;
            border-left: 4px solid #4caf50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Form Submission</h1>
        <div class="highlight">
            <p><strong>First Name:</strong> {{ $first_name }}</p>
            <p><strong>Last Name:</strong> {{ $last_name }}</p>
            <p><strong>Email:</strong> {{ $email_address }}</p>
            <p><strong>Phone Number:</strong> {{ $phone_number }}</p>
        </div>
        <p><strong>Message:</strong></p>
        <p>{{ $contact_message }}</p>

        {{-- <div class="footer">
            <p>Thank you for reaching out!</p>
        </div> --}}
    </div>
</body>
</html>
