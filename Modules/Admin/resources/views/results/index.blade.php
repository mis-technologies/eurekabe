@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Exam Results</h4>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h6 class="card-title">All Results</h6>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $results->total() }} total</span>
        </div>

        <!-- Filters -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <form method="GET" action="{{ route('admin.results.index') }}" class="flex flex-wrap items-end gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Exam</label>
                    <select name="exam_id" class="form-select text-sm" onchange="this.form.submit()">
                        <option value="">All Exams</option>
                        @foreach($exams as $exam)
                            <option value="{{ $exam->id }}" {{ request('exam_id') == $exam->id ? 'selected' : '' }}>
                                {{ $exam->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Status</label>
                    <select name="status" class="form-select text-sm" onchange="this.form.submit()">
                        <option value="" {{ request('status') === '' ? 'selected' : '' }}>All Statuses</option>
                        <option value="submitted" {{ request('status') === 'submitted' ? 'selected' : '' }}>Submitted</option>
                        <option value="passed" {{ request('status') === 'passed' ? 'selected' : '' }}>Passed</option>
                        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                @if(request('exam_id') || request('status'))
                    <a href="{{ route('admin.results.index') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 pb-1">
                        Clear filters
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="border-t border-gray-200 dark:border-gray-700 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Exam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Passed</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($results as $result)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $results->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        <div class="font-medium">{{ $result->user?->firstname }} {{ $result->user?->lastname }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $result->user?->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 max-w-xs">
                                        {{ $result->exam?->title ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $result->score ?? 0 }} / {{ $result->total_questions ?? $result->exam?->questions?->count() ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($result->passed ?? ($result->status === 'passed'))
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">Yes</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">No</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $statusBadge = match(strtolower($result->status ?? '')) {
                                                'passed'    => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                'failed'    => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                'submitted' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                default     => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge }}">
                                            {{ ucfirst($result->status ?? '—') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        @if($result->time_taken ?? $result->duration_taken)
                                            {{ $result->time_taken ?? $result->duration_taken }} min
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $result->created_at?->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a href="{{ route('admin.results.show', $result->id) }}"
                                            class="text-primary hover:text-sky-700 text-xs font-medium">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No results found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($results->hasPages())
                    <div class="py-4 px-4">
                        {{ $results->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</main>
@endsection
