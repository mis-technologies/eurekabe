@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Questions</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $exam->title }}</p>
        </div>
        <a href="{{ route('admin.exams.show', $exam->id) }}" class="btn bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200">
            <i class="mgc_arrow_left_line mr-1"></i> Back to Exam
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

    <!-- Add Question Form -->
    <div class="card mb-6">
        <div class="card-header">
            <h6 class="card-title">Add Question</h6>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.exams.questions.store', $exam->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label" for="question_text">Question <span class="text-red-500">*</span></label>
                    <textarea id="question_text" name="question_text" rows="3"
                        class="form-input w-full" placeholder="Enter the question..." required>{{ old('question_text') }}</textarea>
                    @error('question_text')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="form-label" for="option_1">Option A</label>
                        <input type="text" id="option_1" name="option_1" value="{{ old('option_1') }}"
                            class="form-input w-full" placeholder="Option A">
                        @error('option_1')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label" for="option_2">Option B</label>
                        <input type="text" id="option_2" name="option_2" value="{{ old('option_2') }}"
                            class="form-input w-full" placeholder="Option B">
                        @error('option_2')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label" for="option_3">Option C</label>
                        <input type="text" id="option_3" name="option_3" value="{{ old('option_3') }}"
                            class="form-input w-full" placeholder="Option C">
                        @error('option_3')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label" for="option_4">Option D</label>
                        <input type="text" id="option_4" name="option_4" value="{{ old('option_4') }}"
                            class="form-input w-full" placeholder="Option D">
                        @error('option_4')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="form-label">Correct Option <span class="text-red-500">*</span></label>
                        <div class="flex flex-wrap gap-4 mt-2">
                            @foreach([1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D'] as $val => $label)
                                <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                                    <input type="radio" name="correct_option" value="{{ $val }}"
                                        class="form-radio" {{ old('correct_option') == $val ? 'checked' : '' }}>
                                    Option {{ $label }}
                                </label>
                            @endforeach
                        </div>
                        @error('correct_option')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label" for="marks">Marks</label>
                        <input type="number" id="marks" name="marks" value="{{ old('marks', 1) }}"
                            class="form-input w-full" min="1">
                        @error('marks')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <button type="submit" class="btn bg-primary text-white">
                    <i class="mgc_add_line mr-1"></i> Add Question
                </button>
            </form>
        </div>
    </div>

    <!-- Questions List -->
    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h6 class="card-title">Questions List</h6>
            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-primary/20 text-primary">
                {{ $questions->count() }} question(s)
            </span>
        </div>
        <div class="p-6">
            @forelse($questions as $question)
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 mb-4 last:mb-0">
                    <div class="flex justify-between items-start gap-4">
                        <div class="flex-grow">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200 mb-3">
                                <span class="text-gray-400 mr-2">Q{{ $loop->iteration }}.</span>{{ $question->question_text }}
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach(['option_1' => 'A', 'option_2' => 'B', 'option_3' => 'C', 'option_4' => 'D'] as $field => $letter)
                                    @if($question->$field)
                                        <div class="flex items-center gap-2 text-sm
                                            {{ $question->correct_option == substr($field, -1) ? 'text-green-700 dark:text-green-400 font-medium' : 'text-gray-600 dark:text-gray-400' }}">
                                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full text-xs font-bold
                                                {{ $question->correct_option == substr($field, -1) ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400' : 'bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400' }}">
                                                {{ $letter }}
                                            </span>
                                            {{ $question->$field }}
                                            @if($question->correct_option == substr($field, -1))
                                                <i class="mgc_check_line text-green-600 text-xs"></i>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-2 flex-shrink-0">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-primary/20 text-primary">
                                {{ $question->marks }} mark(s)
                            </span>
                            <a href="{{ route('admin.exams.questions.delete', [$exam->id, $question->id]) }}"
                                onclick="return confirm('Delete this question?')"
                                class="text-red-500 hover:text-red-700 text-xs font-medium">
                                <i class="mgc_delete_bin_line mr-0.5"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-sm text-gray-500 dark:text-gray-400">
                    No questions added yet. Use the form above to add your first question.
                </div>
            @endforelse
        </div>
    </div>

</main>
@endsection
