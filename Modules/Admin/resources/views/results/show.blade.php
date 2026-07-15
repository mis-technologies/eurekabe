@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.results.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <i class="mgc_arrow_left_line text-xl"></i>
            </a>
            <div>
                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                    {{ $result->user?->firstname }} {{ $result->user?->lastname }}
                </h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $result->exam?->title }}</p>
            </div>
        </div>
    </div>

    <!-- Summary Card -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="card">
            <div class="p-6 flex items-center gap-4">
                <div class="w-12 h-12 flex justify-center items-center rounded text-primary bg-primary/25">
                    <i class="mgc_check_circle_line text-xl"></i>
                </div>
                <div>
                    <h5 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $result->correct_answers ?? $result->score ?? 0 }}</h5>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Correct Answers</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="p-6 flex items-center gap-4">
                <div class="w-12 h-12 flex justify-center items-center rounded text-info bg-info/25">
                    <i class="mgc_question_line text-xl"></i>
                </div>
                <div>
                    <h5 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $result->total_questions ?? $result->exam?->questions?->count() ?? 0 }}</h5>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Total Questions</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="p-6 flex items-center gap-4">
                <div class="w-12 h-12 flex justify-center items-center rounded text-warning bg-warning/25">
                    <i class="mgc_star_line text-xl"></i>
                </div>
                <div>
                    <h5 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $result->score ?? 0 }}%</h5>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Score</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="p-6 flex items-center gap-4">
                @if($result->passed ?? ($result->status === 'passed'))
                    <div class="w-12 h-12 flex justify-center items-center rounded text-success bg-success/25">
                        <i class="mgc_trophy_line text-xl"></i>
                    </div>
                    <div>
                        <h5 class="text-2xl font-bold text-green-600 dark:text-green-400">Pass</h5>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Result</p>
                    </div>
                @else
                    <div class="w-12 h-12 flex justify-center items-center rounded text-danger bg-danger/25">
                        <i class="mgc_close_circle_line text-xl"></i>
                    </div>
                    <div>
                        <h5 class="text-2xl font-bold text-red-600 dark:text-red-400">Fail</h5>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Result</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Time Taken -->
    @if($result->time_taken ?? $result->duration_taken)
    <div class="mb-6">
        <div class="card">
            <div class="p-4 flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                <i class="mgc_alarm_2_line text-lg text-primary"></i>
                <span>Time taken: <strong>{{ $result->time_taken ?? $result->duration_taken }} minutes</strong></span>
                <span class="mx-2 text-gray-300 dark:text-gray-600">|</span>
                <i class="mgc_calendar_line text-lg text-primary"></i>
                <span>Submitted: <strong>{{ $result->created_at?->format('d M Y, H:i') }}</strong></span>
            </div>
        </div>
    </div>
    @endif

    <!-- Answers Table -->
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Answer Review</h6>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Question</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student's Answer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Correct Answer</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Mark</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($result->answers ?? $result->studentAnswers ?? [] as $answer)
                        @php
                            $isCorrect = $answer->is_correct ?? ($answer->selected_option === $answer->correct_option);
                        @endphp
                        <tr class="{{ $isCorrect ? '' : 'bg-red-50/50 dark:bg-red-900/10' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200 max-w-sm">
                                {{ $answer->question?->question ?? $answer->question_text ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                {{ $answer->selected_option ?? $answer->student_answer ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                {{ $answer->correct_option ?? $answer->question?->answer ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-lg">
                                @if($isCorrect)
                                    <i class="mgc_check_line text-green-500"></i>
                                @else
                                    <i class="mgc_close_line text-red-500"></i>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                No answer details available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</main>
@endsection
