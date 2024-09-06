<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h1>Password Reset Request</h1>
    <p>We received a request to reset your password. Please click the link below to reset it:</p>
    <a href="{{ url('password/reset', $token) }}">Reset Password</a>
    <p>If you didn't request a password reset, you can ignore this email.</p>
</body>
</html>
