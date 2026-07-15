@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Exam Details</h4>
        <div class="flex gap-2">
            <a href="{{ route('admin.exams.edit', $exam->id) }}" class="btn bg-primary text-white">
                <i class="mgc_edit_line mr-1"></i> Edit Exam
            </a>
            <a href="{{ route('admin.exams.index') }}" class="btn bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                <i class="mgc_arrow_left_line mr-1"></i> Back to Exams
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-6">

        <!-- Exam Info Card -->
        <div class="lg:col-span-2">
            <div class="card">
                <div class="card-header flex justify-between items-center">
                    <h6 class="card-title">{{ $exam->title }}</h6>
                    @if($exam->status === 'published')
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">Published</span>
                    @elseif($exam->status === 'archived')
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300">Archived</span>
                    @else
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">Draft</span>
                    @endif
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase mb-1">School</dt>
                            <dd class="text-sm text-gray-800 dark:text-gray-200">{{ $exam->school?->name ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase mb-1">Subject</dt>
                            <dd class="text-sm text-gray-800 dark:text-gray-200">{{ $exam->subject?->name ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase mb-1">Duration</dt>
                            <dd class="text-sm text-gray-800 dark:text-gray-200">{{ $exam->duration }} minutes</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase mb-1">Pass Percentage</dt>
                            <dd class="text-sm text-gray-800 dark:text-gray-200">{{ $exam->pass_percentage }}%</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase mb-1">Start Date</dt>
                            <dd class="text-sm text-gray-800 dark:text-gray-200">
                                {{ $exam->start_date ? \Carbon\Carbon::parse($exam->start_date)->format('M d, Y H:i') : '—' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase mb-1">End Date</dt>
                            <dd class="text-sm text-gray-800 dark:text-gray-200">
                                {{ $exam->end_date ? \Carbon\Carbon::parse($exam->end_date)->format('M d, Y H:i') : '—' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase mb-1">Visibility</dt>
                            <dd class="text-sm text-gray-800 dark:text-gray-200 capitalize">{{ $exam->visibility ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase mb-1">AI Hints</dt>
                            <dd class="text-sm text-gray-800 dark:text-gray-200">{{ $exam->allow_ai_hints ? 'Enabled' : 'Disabled' }}</dd>
                        </div>
                        @if($exam->instruction)
                            <div class="sm:col-span-2">
                                <dt class="text-xs font-medium text-gray-500 uppercase mb-1">Instructions</dt>
                                <dd class="text-sm text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $exam->instruction }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>

        <!-- Sidebar: Questions & Actions -->
        <div class="lg:col-span-1 flex flex-col gap-6">

            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="w-12 h-12 flex justify-center items-center rounded text-primary bg-primary/25">
                                <i class="mgc_book_line text-xl"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h5 class="mb-1 text-sm text-gray-500">Total Questions</h5>
                            <p class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                                {{ $exam->questions_count ?? $exam->questions->count() }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.exams.questions', $exam->id) }}" class="btn bg-primary text-white w-full text-center">
                            <i class="mgc_add_line mr-1"></i> Manage Questions
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Actions</h6>
                </div>
                <div class="p-6 flex flex-col gap-3">
                    <a href="{{ route('admin.exams.edit', $exam->id) }}" class="btn bg-primary text-white w-full text-center">
                        <i class="mgc_edit_line mr-1"></i> Edit Exam
                    </a>
                    <a href="{{ route('admin.exams.questions', $exam->id) }}" class="btn bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200 w-full text-center">
                        <i class="mgc_book_line mr-1"></i> Manage Questions
                    </a>
                    <a href="{{ route('admin.exams.delete', $exam->id) }}"
                        onclick="return confirm('Delete this exam? This cannot be undone.')"
                        class="btn bg-danger text-white w-full text-center">
                        <i class="mgc_delete_bin_line mr-1"></i> Delete Exam
                    </a>
                </div>
            </div>

        </div>
    </div>

</main>
@endsection
