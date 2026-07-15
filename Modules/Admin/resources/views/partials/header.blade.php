<!-- Topbar -->
<header class="app-header flex items-center px-4 gap-3">

    <!-- Sidebar Toggle -->
    <button id="button-toggle-menu" class="nav-link p-2">
        <span class="sr-only">Toggle Menu</span>
        <span class="flex items-center justify-center h-6 w-6">
            <i class="mgc_menu_line text-xl"></i>
        </span>
    </button>

    <!-- Page breadcrumb / title -->
    <div class="me-auto hidden sm:block">
        <span class="text-sm text-gray-500 dark:text-gray-400">
            @yield('title', 'Dashboard')
        </span>
    </div>

    <!-- Fullscreen -->
    <div class="md:flex hidden">
        <button data-toggle="fullscreen" type="button" class="nav-link p-2">
            <span class="sr-only">Fullscreen</span>
            <span class="flex items-center justify-center h-6 w-6">
                <i class="mgc_fullscreen_line text-2xl"></i>
            </span>
        </button>
    </div>

    <!-- Light/Dark Toggle -->
    <button id="light-dark-mode" type="button" class="nav-link p-2">
        <span class="sr-only">Light/Dark Mode</span>
        <span class="flex items-center justify-center h-6 w-6">
            <i class="mgc_moon_line text-2xl"></i>
        </span>
    </button>

    <!-- Profile Dropdown -->
    <div class="relative">
        <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button"
            class="nav-link fc-dropdown flex items-center gap-2 px-2 py-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <img src="{{ auth()->user()->image }}"
                alt="{{ auth()->user()->firstname }}"
                class="rounded-full h-8 w-8 object-cover border-2 border-gray-200 dark:border-gray-600 flex-shrink-0">
            <div class="hidden sm:block text-left">
                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                    {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400 leading-tight">Administrator</p>
            </div>
            <i class="mgc_down_line text-xs text-gray-400 hidden sm:block ms-1"></i>
        </button>

        <div class="fc-dropdown fc-dropdown-open:opacity-100 hidden opacity-0 w-52 z-50 transition-[margin,opacity] duration-300 mt-1 bg-white shadow-lg border rounded-xl p-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800">
            <div class="px-3 py-2 mb-1">
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200 truncate">
                    {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</p>
            </div>
            <div class="h-px bg-gray-100 dark:bg-gray-700 mb-1"></div>
            <a class="flex items-center gap-2 py-2 px-3 rounded-lg text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"
                href="{{ route('admin.logout') }}">
                <i class="mgc_exit_line text-base"></i>
                Sign Out
            </a>
        </div>
    </div>

</header>
<!-- End Topbar -->
