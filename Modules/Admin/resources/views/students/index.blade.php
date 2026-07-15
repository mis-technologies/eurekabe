@extends('admin::layouts.app')

@section('title', 'Students')

@section('content')
<main class="flex-grow p-6">

    <div class="flex items-center justify-between mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Students</h4>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ count($students) }} total</span>
    </div>

    <div class="card">
        <div class="card-header flex items-center justify-between">
            <h6 class="card-title">All Students</h6>
        </div>

        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name / Username</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">School</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($students as $s)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $s->image }}"
                                                alt="{{ $s->firstname }}"
                                                class="w-8 h-8 rounded-full object-cover border border-gray-200 dark:border-gray-600 flex-shrink-0">
                                            <div>
                                                <p class="font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $s->firstname }} {{ $s->lastname }}
                                                </p>
                                                @if($s->username)
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">@{{ $s->username }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                        {{ $s->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                        {{ $s->phone ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                        {{ $s->school?->name ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($s->status == 1)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">Active</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('admin.users.show', $s->id) }}"
                                                class="text-primary hover:text-sky-700 text-xs font-medium">View</a>
                                            <form action="{{ route('admin.update.user.status', $s->id) }}" method="POST" class="inline"
                                                onsubmit="return confirm('Toggle this student\'s status?')">
                                                @csrf
                                                <button type="submit"
                                                    class="text-xs font-medium {{ $s->status == 1 ? 'text-amber-600 hover:text-amber-800' : 'text-green-600 hover:text-green-800' }}">
                                                    {{ $s->status == 1 ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                                        <i class="mgc_mortarboard_line text-4xl mb-2 block opacity-30"></i>
                                        No students found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
