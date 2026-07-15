@extends('admin::layouts.app')

@section('title', 'Notifications')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Send Notification</h4>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-6">

        <!-- Send Form -->
        <div class="lg:col-span-2">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Compose Notification</h6>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.notifications.send') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-input w-full"
                                placeholder="Notification title" required>
                            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" rows="6" class="form-input w-full"
                                placeholder="Write your notification message here..." required>{{ old('message') }}</textarea>
                            @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Target Audience <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="target" value="all" class="form-radio"
                                        {{ old('target', 'all') === 'all' ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">
                                        <span class="font-medium">All Users</span>
                                        <span class="text-gray-400 ml-1">({{ $stats['total'] ?? 0 }} users)</span>
                                    </span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="target" value="students" class="form-radio"
                                        {{ old('target') === 'students' ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">
                                        <span class="font-medium">Students Only</span>
                                        <span class="text-gray-400 ml-1">({{ $stats['students'] ?? 0 }} students)</span>
                                    </span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="target" value="advocates" class="form-radio"
                                        {{ old('target') === 'advocates' ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">
                                        <span class="font-medium">Advocates Only</span>
                                        <span class="text-gray-400 ml-1">({{ $stats['advocates'] ?? 0 }} advocates)</span>
                                    </span>
                                </label>
                            </div>
                            @error('target')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit" class="btn bg-primary text-white">
                            <i class="mgc_notification_line mr-1"></i> Send Notification
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Stats Card -->
        <div class="lg:col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Audience Stats</h6>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 flex justify-center items-center rounded text-primary bg-primary/25">
                            <i class="mgc_group_line text-lg"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $stats['total'] ?? 0 }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total Users</p>
                        </div>
                    </div>
                    <hr class="border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 flex justify-center items-center rounded text-info bg-info/25">
                            <i class="mgc_user_line text-lg"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $stats['students'] ?? 0 }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Students</p>
                        </div>
                    </div>
                    <hr class="border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 flex justify-center items-center rounded text-warning bg-warning/25">
                            <i class="mgc_user_heart_line text-lg"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $stats['advocates'] ?? 0 }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Advocates</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</main>
@endsection
