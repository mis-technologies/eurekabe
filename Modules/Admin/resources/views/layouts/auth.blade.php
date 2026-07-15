<!DOCTYPE html>
<html lang="en" data-mode="light">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Login') | Eureka Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/%40frostui/tailwindcss/frostui.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
