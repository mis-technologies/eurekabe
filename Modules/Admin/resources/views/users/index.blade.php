@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">All Users</h4>
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

    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h6 class="card-title">Users</h6>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $users->total() }} total</span>
        </div>

        <!-- Filter Bar -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex flex-wrap items-center gap-4">
                <!-- Role Filters -->
                <div class="flex items-center gap-2">
                    @php $currentRole = request('role', ''); @endphp
                    <a href="{{ request()->fullUrlWithQuery(['role' => '']) }}"
                        class="inline-flex items-center px-3 py-1.5 rounded text-xs font-medium {{ $currentRole === '' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        All
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['role' => 'student']) }}"
                        class="inline-flex items-center px-3 py-1.5 rounded text-xs font-medium {{ $currentRole === 'student' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        Student
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['role' => 'advocate']) }}"
                        class="inline-flex items-center px-3 py-1.5 rounded text-xs font-medium {{ $currentRole === 'advocate' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        Advocate
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['role' => 'admin']) }}"
                        class="inline-flex items-center px-3 py-1.5 rounded text-xs font-medium {{ $currentRole === 'admin' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        Admin
                    </a>
                </div>

                <!-- Search -->
                <form method="GET" action="{{ route('admin.users.index') }}" class="flex-1 max-w-xs">
                    @if(request('role'))
                        <input type="hidden" name="role" value="{{ request('role') }}">
                    @endif
                    <div class="relative">
                        <label for="user-search" class="sr-only">Search</label>
                        <input type="text" name="search" id="user-search" value="{{ request('search') }}"
                            class="form-input ps-11 w-full" placeholder="Search name or email...">
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                            <svg class="h-3.5 w-3.5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="border-t border-gray-200 dark:border-gray-700 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name / Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">School</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Credits</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                                <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        <div class="font-medium">{{ $user->firstname }} {{ $user->lastname }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $roleBadge = match(strtolower($user->role ?? '')) {
                                                'admin'    => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                'advocate' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
                                                default    => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $roleBadge }}">
                                            {{ ucfirst($user->role ?? 'student') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $user->school?->name ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($user->status == 1)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">Active</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ number_format($user->creditAccount?->balance ?? 0) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $user->created_at?->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('admin.users.show', $user->id) }}"
                                                class="text-primary hover:text-sky-700 text-xs font-medium">View</a>
                                            <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="inline"
                                                onsubmit="return confirm('Are you sure you want to toggle this user\'s status?')">
                                                @csrf
                                                <button type="submit"
                                                    class="text-xs font-medium {{ $user->status == 1 ? 'text-amber-600 hover:text-amber-800' : 'text-green-600 hover:text-green-800' }}">
                                                    {{ $user->status == 1 ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($users->hasPages())
                    <div class="py-4 px-4">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</main>
@endsection
