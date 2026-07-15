@extends('admin::layouts.auth')

@section('title', 'Admin Login')

@section('content')
<div class="card shadow-lg">
    <div class="p-8">

        <!-- Brand -->
        <div class="text-center mb-8">
            <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-2 mb-4">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="Eureka" class="h-8 dark:hidden">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="Eureka" class="h-8 hidden dark:block">
            </a>
            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mt-4">Admin Sign In</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Enter your credentials to access the admin panel</p>
        </div>

        <!-- Errors -->
        @if($errors->any())
            <div class="mb-5 p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300 text-sm">
                @foreach($errors->all() as $error)
                    <p class="flex items-center gap-2"><i class="mgc_close_circle_line"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(session('error'))
            <div class="mb-5 p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('admin.login.send') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Email Address
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="form-input w-full @error('email') border-red-500 @enderror"
                    placeholder="admin@example.com" required autofocus>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Password
                </label>
                <input type="password" id="password" name="password"
                    class="form-input w-full @error('password') border-red-500 @enderror"
                    placeholder="••••••••" required>
            </div>

            <button type="submit"
                class="btn bg-primary text-white w-full justify-center py-2.5 font-medium">
                Sign In
            </button>
        </form>

    </div>
</div>

<p class="text-center text-xs text-gray-400 dark:text-gray-500 mt-4">
    &copy; {{ date('Y') }} Eureka EdTech. Admin access only.
</p>
@endsection
