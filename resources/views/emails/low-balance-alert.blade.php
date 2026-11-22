<!DOCTYPE html>
<html>
<head>
    <title>{{ __("You're running low on credits") }}</title>
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
        .balance-box {
            background-color: #f5f5f5;
            border-radius: 8px;
            padding: 16px;
            margin: 20px 0;
            text-align: center;
        }
        .balance-amount {
            font-size: 28px;
            font-weight: bold;
            color: #1a1a1a;
        }
        .balance-plan {
            color: #666;
            font-size: 13px;
            margin-top: 4px;
        }
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
        <p>{{ __("You've used up your available AI credits on Eureka, so some features (study summaries, practice questions, resource suggestions, AI tutor) won't work until your balance is topped up.") }}</p>
        <div class="balance-box">
            <div class="balance-amount">{{ $balance }} credits</div>
            <div class="balance-plan">{{ $planName }} plan</div>
        </div>
        <p>{{ __('You can check your usage history and top up any time using the link below:') }}</p>
        <p style="text-align: center;">
            <a class="cta" href="{{ $signedUrl }}">{{ __('View usage & top up') }}</a>
        </p>
        <p>{{ __('This link is valid for 14 days. Your free monthly credits will also reset automatically on your next renewal date.') }}</p>
        <p>{{ __('Kind regards') }}</p>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Eureka App. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
