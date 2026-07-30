@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    {{-- Header with title and action --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-50">Competitions</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Manage competitions, pricing, and participant settings</p>
        </div>
        <a href="{{ route('admin.competitions.create') }}" class="btn bg-primary text-white hover:bg-blue-700 shadow-md hover:shadow-lg transition-all">
            <i class="mgc_add_line mr-2"></i> New Competition
        </a>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 flex items-center gap-3">
            <i class="mgc_check_circle_line text-xl"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 flex items-center gap-3">
            <i class="mgc_alert_circle_line text-xl"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="card p-4 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/10 border border-blue-200 dark:border-blue-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-blue-600 dark:text-blue-300 uppercase tracking-wide">Total</p>
                    <p class="text-3xl font-bold text-blue-900 dark:text-blue-100 mt-1">{{ $competitions->total() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center">
                    <i class="mgc_trophy_line text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="card p-4 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/10 border border-green-200 dark:border-green-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-green-600 dark:text-green-300 uppercase tracking-wide">Free</p>
                    <p class="text-3xl font-bold text-green-900 dark:text-green-100 mt-1">{{ $competitions->where('price', 0)->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-500/20 flex items-center justify-center">
                    <i class="mgc_gift_2_line text-2xl text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="card p-4 bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/20 dark:to-amber-800/10 border border-amber-200 dark:border-amber-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-amber-600 dark:text-amber-300 uppercase tracking-wide">Paid</p>
                    <p class="text-3xl font-bold text-amber-900 dark:text-amber-100 mt-1">{{ $competitions->where('price', '>', 0)->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-amber-500/20 flex items-center justify-center">
                    <i class="mgc_wallet_2_line text-2xl text-amber-600"></i>
                </div>
            </div>
        </div>

        <div class="card p-4 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/10 border border-purple-200 dark:border-purple-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-purple-600 dark:text-purple-300 uppercase tracking-wide">Active</p>
                    <p class="text-3xl font-bold text-purple-900 dark:text-purple-100 mt-1">{{ $competitions->where('status', 'ongoing')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-500/20 flex items-center justify-center">
                    <i class="mgc_play_circle_line text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Competitions Table --}}
    <div class="card">
        <div class="card-header bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="flex justify-between items-center">
                <h3 class="card-title text-lg">All Competitions</h3>
                <span class="text-sm px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full font-medium">
                    {{ $competitions->total() }} competitions
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">#</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Schools</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Window</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Participants</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($competitions as $competition)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                                {{ $competitions->firstItem() + $loop->index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $competition->name }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $competition->type }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($competition->schools->count() > 0)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                        {{ $competition->schools->count() }} {{ Str::plural('school', $competition->schools->count()) }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                        Public
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $badge = match(strtolower($competition->status ?? '')) {
                                        'ongoing'   => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                        'upcoming'  => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                        'completed' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                        'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                        default     => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300',
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold {{ $badge }}">
                                    <span class="w-2 h-2 rounded-full
                                        {{ strtolower($competition->status) === 'ongoing' ? 'bg-green-500' : '' }}
                                        {{ strtolower($competition->status) === 'upcoming' ? 'bg-blue-500' : '' }}
                                        {{ strtolower($competition->status) === 'completed' ? 'bg-gray-400' : '' }}
                                        {{ strtolower($competition->status) === 'cancelled' ? 'bg-red-500' : '' }}
                                    "></span>
                                    {{ ucfirst($competition->status ?? '—') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($competition->price > 0)
                                    <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300">
                                        <i class="mgc_wallet_2_line"></i>
                                        ₦{{ number_format($competition->price, 0) }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                        <i class="mgc_gift_2_line"></i>
                                        Free
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2 text-xs">
                                    <div class="flex items-center gap-1 px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded">
                                        <i class="mgc_time_line text-gray-600 dark:text-gray-400"></i>
                                        <span class="font-medium text-gray-900 dark:text-gray-100">
                                            {{ sprintf("%02d", $competition->window_start_hour) }}:00 - {{ sprintf("%02d", $competition->window_end_hour) }}:00
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                                        <span class="text-sm font-bold text-primary">
                                            {{ $competition->participants_count ?? $competition->participants?->count() ?? 0 }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.competitions.show', $competition->id) }}"
                                        class="inline-flex items-center gap-1 px-3 py-2 text-xs font-medium text-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors"
                                        title="View Details">
                                        <i class="mgc_eye_line"></i>
                                        View
                                    </a>
                                    <a href="{{ route('admin.competitions.edit', $competition->id) }}"
                                        class="inline-flex items-center gap-1 px-3 py-2 text-xs font-medium text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors"
                                        title="Edit">
                                        <i class="mgc_edit_line"></i>
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.competitions.delete', $competition->id) }}"
                                        onclick="return confirm('Delete this competition? This cannot be undone.')"
                                        class="inline-flex items-center gap-1 px-3 py-2 text-xs font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                                        title="Delete">
                                        <i class="mgc_delete_line"></i>
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                        <i class="mgc_trophy_line text-3xl text-gray-400"></i>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 font-medium">No competitions yet</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-500">Get started by creating your first competition</p>
                                    <a href="{{ route('admin.competitions.create') }}" class="mt-2 btn bg-primary text-white text-xs">
                                        <i class="mgc_add_line mr-1"></i> Create Competition
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($competitions->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $competitions->links() }}
            </div>
        @endif
    </div>

</main>
@endsection
