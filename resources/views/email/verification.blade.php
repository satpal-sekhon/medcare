<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: black; font-size: 19px; font-weight: bold; margin-top: 0;
        text-align: center;">Hi {{ $name ?? $email }}
    </h1>
    <h3 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: black; font-size: 17px;
        font-weight: bold; margin-top: 0; text-align: center;">Here's your verification code:
    </h3>
    <p style="font-size: 15px; color: black; text-align: center;"><strong>One Time Password:</strong> <span style="color: black;">{{ $otp }}</span></p>
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; line-height: 1.5em; margin-top: 0; color: black; font-size: 12px; text-align: center;">
        @php $date = date('Y'); @endphp
        © {{ $date }} MEDCARE. All rights reserved.
    </p>
</body>
</html>