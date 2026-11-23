<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $success ? 'Entry confirmed' : 'Payment issue' }} — Eureka</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f5f5f5;
            color: #222;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .card {
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            padding: 32px;
            max-width: 420px;
            text-align: center;
            margin: 16px;
        }
        h1 { font-size: 18px; margin-bottom: 8px; }
        p { color: #666; line-height: 1.5; }
        .icon { font-size: 40px; margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="card">
        @if($success)
            <div class="icon">✅</div>
            <h1>Entry confirmed!</h1>
            <p>You're all set — open the Eureka app to take the competition exam and view results.</p>
        @else
            <div class="icon">⚠️</div>
            <h1>We couldn't confirm your payment</h1>
            <p>{{ $message ?? 'If you were charged, please contact support and we\'ll sort it out.' }}</p>
        @endif
    </div>
</body>
</html>
