<!DOCTYPE html>
<html lang="en" dir="ltr" data-mode="light" data-layout-width="default" data-layout-position="fixed"
    data-topbar-color="light" data-menu-color="light" data-sidenav-view="default">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard') | Eureka Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Eureka Admin Panel">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Core CSS -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Theme Config -->
    <script>
        // Force sidebar to default (full-width) view, clearing any cached compact view
        var _cfg = sessionStorage.getItem('__CONFIG__');
        if (_cfg) { try { var _c = JSON.parse(_cfg); if (_c.sidenav && _c.sidenav.view !== 'default') { _c.sidenav.view = 'default'; sessionStorage.setItem('__CONFIG__', JSON.stringify(_c)); } } catch(e) {} }
    </script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <style>
        /* Tighter sidebar menu items */
        .menu > .menu-item > .menu-link {
            padding-top: 0.45rem;
            padding-bottom: 0.45rem;
        }
        /* Bolder section labels */
        .menu > .menu-title {
            font-size: 0.65rem;
            letter-spacing: 0.08em;
            font-weight: 700;
            padding-top: 1.1rem;
            padding-bottom: 0.3rem;
        }
        /* Card hover */
        .card { transition: box-shadow 0.15s ease; }
        /* Fix submenu visibility */
        .sub-menu, .sub-menu * {
            visibility: visible !important;
            opacity: 1 !important;
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="flex wrapper">

        @include('admin::partials.sidebar')

        <div class="page-content">
            @include('admin::partials.header')

            @include('admin::partials.znotify')

            @yield('content')

            @include('admin::partials.footer')
        </div>

    </div>

    <!-- Back to Top -->
    <button data-toggle="back-to-top"
        class="fixed h-10 w-10 items-center justify-center rounded-full z-10 bottom-20 end-14 p-2.5 bg-primary cursor-pointer shadow-lg text-white flex">
        <i class="mgc_arrow_up_line text-lg"></i>
    </button>

    <!-- Overlay -->
    <div class="transition-all fixed inset-0 z-40 bg-gray-900 bg-opacity-50 dark:bg-opacity-80 hidden"
        data-fc-overlay-backdrop=""></div>

    <!-- Core JS -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/%40frostui/tailwindcss/frostui.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Notification helper -->
    <script>
    "use strict";
    function notify(status, message) {
        if (typeof message === 'string') {
            iziToast[status]({ message: message, position: 'topRight' });
        } else {
            $.each(message, function (i, val) {
                iziToast[status]({ message: val, position: 'topRight' });
            });
        }
    }
    </script>

    @stack('scripts')
</body>

</html>
