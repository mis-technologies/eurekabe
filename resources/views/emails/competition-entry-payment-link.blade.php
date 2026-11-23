<!DOCTYPE html>
<html>
<head>
    <title>{{ __('Complete your competition entry') }}</title>
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
        h1 { color: #1a1a1a; }
        p { line-height: 1.6; }
        .cta {
            display: inline-block;
            background-color: #3b5bdb;
            color: #fff !important;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: bold;
            margin: 10px 0;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ __('Hi :name,', ['name' => $name]) }}</h1>
        <p>{{ __('You requested to enter ":name". Use the link below to complete your entry:', ['name' => $competitionName]) }}</p>
        <p style="text-align: center;">
            <a class="cta" href="{{ $authorizationUrl }}">{{ __('Complete entry') }}</a>
        </p>
        <p>{{ __('Once this is done, you can take the competition exam and view results right from the Eureka app.') }}</p>
        <p>{{ __('Kind regards') }}</p>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Eureka App. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
