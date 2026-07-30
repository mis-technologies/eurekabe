@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Competitions</h4>
        <a href="{{ route('admin.competitions.create') }}" class="btn bg-primary text-white">
            <i class="mgc_add_line mr-1"></i> New Competition
        </a>
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
            <h6 class="card-title">All Competitions</h6>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $competitions->total() }} total</span>
        </div>
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Schools</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Start Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">End Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Participants</th>
                                    <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($competitions as $competition)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $competitions->firstItem() + $loop->index }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $competition->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 max-w-xs">
                                            {{ $competition->schools->pluck('name')->implode(', ') ?: '—' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @php
                                                $statusBadge = match(strtolower($competition->status ?? '')) {
                                                    'ongoing'   => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                    'upcoming'  => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                    'completed' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                                                    'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                    default     => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge }}">
                                                {{ ucfirst($competition->status ?? '—') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($competition->price > 0)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                                    ₦{{ number_format($competition->price, 2) }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                                    Free
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $competition->start_date ? \Carbon\Carbon::parse($competition->start_date)->format('d M Y') : '—' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $competition->end_date ? \Carbon\Carbon::parse($competition->end_date)->format('d M Y') : '—' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            {{ $competition->participants_count ?? $competition->participants?->count() ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <div class="flex items-center justify-end gap-3">
                                                <a href="{{ route('admin.competitions.show', $competition->id) }}"
                                                    class="text-primary hover:text-sky-700 text-xs font-medium">View</a>
                                                <a href="{{ route('admin.competitions.edit', $competition->id) }}"
                                                    class="text-amber-600 hover:text-amber-800 text-xs font-medium">Edit</a>
                                                <a href="{{ route('admin.competitions.delete', $competition->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this competition?')"
                                                    class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                            No competitions found. <a href="{{ route('admin.competitions.create') }}" class="text-primary hover:underline">Create one</a>.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($competitions->hasPages())
                        <div class="py-4 px-4">
                            {{ $competitions->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
