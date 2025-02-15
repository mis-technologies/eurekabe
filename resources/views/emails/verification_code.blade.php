<!DOCTYPE html>
<html>
<head>
    <title>{{ __('Your verification code') }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #1a1a1a;
        }
        p {
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ __('Hello!') }}</h1>
        <p>{{ __('It’s great to meet you.') }}</p>
        <p>{{ __('Your verification code: :code', ['code' => $code]) }}</p>
        <p>{{ __('Thank you for using Eureka App.') }}</p>
        <p>{{ __('Kind regards') }}</p>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Eureka App. All rights reserved.</p>
        </div>
    </div>
</body>
</html>