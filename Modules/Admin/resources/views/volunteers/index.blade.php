@extends('admin::layouts.app')

@section('title', 'Volunteer Applications')

@section('content')
<main class="flex-grow p-6">

    <div class="flex items-center justify-between mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Volunteer Applications</h4>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $volunteers->count() }} total</span>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">All Applications</h6>
        </div>
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Skills</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($volunteers as $volunteer)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $volunteer->firstname }} {{ $volunteer->lastname }}
                                        @if($volunteer->university)
                                            <p class="text-xs text-gray-500 dark:text-gray-400 font-normal">{{ $volunteer->university }}</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                        {{ $volunteer->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                                        {{ $volunteer->phone ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 max-w-xs">
                                        @if($volunteer->skills)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($volunteer->skills as $skill)
                                                    <span class="inline-block bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 text-xs px-2 py-0.5 rounded">
                                                        {{ ucwords(str_replace('_', ' ', $skill)) }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($volunteer->status === 'approved')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">Approved</span>
                                        @elseif($volunteer->status === 'rejected')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">Rejected</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $volunteer->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.volunteers.show', $volunteer->id) }}"
                                                class="text-primary hover:text-sky-700 text-xs font-medium">View</a>

                                            @if($volunteer->status !== 'approved')
                                                <form action="{{ route('admin.volunteers.update-status', $volunteer->id) }}" method="POST" class="inline"
                                                    onsubmit="return confirm('Approve this application?')">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="text-green-600 hover:text-green-800 text-xs font-medium">Approve</button>
                                                </form>
                                            @endif

                                            @if($volunteer->status !== 'rejected')
                                                <form action="{{ route('admin.volunteers.update-status', $volunteer->id) }}" method="POST" class="inline"
                                                    onsubmit="return confirm('Reject this application?')">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">Reject</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                                        <i class="mgc_user_heart_line text-4xl mb-2 block opacity-30"></i>
                                        No volunteer applications found.
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
