@extends('filament::layouts.base')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-lg font-bold text-center">Login</h2>
            <form method="POST" action="{{ route('filament.auth.login') }}">
                @csrf

                <x-filament::input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Email Address"
                    required
                    autofocus
                    class="w-full mb-4"
                />

                <x-filament::input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Password"
                    required
                    class="w-full mb-4"
                />

                <button type="submit" class="w-full py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                    Login
                </button>
            </form>

            <div class="mt-4 text-center">
                <a href="{{ route('filament.auth.password.request') }}" class="text-sm text-gray-600 hover:underline">
                    Forgot your password?
                </a>
            </div>
        </div>
    </div>
@endsection