@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Edit Exam</h4>
        <a href="{{ route('admin.exams.index') }}" class="btn bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200">
            <i class="mgc_arrow_left_line mr-1"></i> Back to Exams
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
        <div class="card-header">
            <h6 class="card-title">Edit: {{ $exam->title }}</h6>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.exams.update', $exam->id) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="form-label" for="title">Title <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $exam->title) }}"
                            class="form-input w-full" placeholder="Exam title" required>
                        @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="school_id">School</label>
                        <select id="school_id" name="school_id" class="form-select w-full">
                            <option value="">-- Select School --</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}"
                                    {{ old('school_id', $exam->school_id) == $school->id ? 'selected' : '' }}>
                                    {{ $school->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('school_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="subject_id">Subject</label>
                        <select id="subject_id" name="subject_id" class="form-select w-full">
                            <option value="">-- Select Subject --</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id', $exam->subject_id) == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="duration">Duration (minutes)</label>
                        <input type="number" id="duration" name="duration" value="{{ old('duration', $exam->duration) }}"
                            class="form-input w-full" min="1">
                        @error('duration')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="pass_percentage">Pass Percentage (%)</label>
                        <input type="number" id="pass_percentage" name="pass_percentage"
                            value="{{ old('pass_percentage', $exam->pass_percentage) }}"
                            class="form-input w-full" min="0" max="100">
                        @error('pass_percentage')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="start_date">Start Date</label>
                        <input type="datetime-local" id="start_date" name="start_date"
                            value="{{ old('start_date', $exam->start_date ? \Carbon\Carbon::parse($exam->start_date)->format('Y-m-d\TH:i') : '') }}"
                            class="form-input w-full">
                        @error('start_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="end_date">End Date</label>
                        <input type="datetime-local" id="end_date" name="end_date"
                            value="{{ old('end_date', $exam->end_date ? \Carbon\Carbon::parse($exam->end_date)->format('Y-m-d\TH:i') : '') }}"
                            class="form-input w-full">
                        @error('end_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="status">Status</label>
                        <select id="status" name="status" class="form-select w-full">
                            <option value="draft" {{ old('status', $exam->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $exam->status) === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $exam->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="visibility">Visibility</label>
                        <select id="visibility" name="visibility" class="form-select w-full">
                            <option value="public" {{ old('visibility', $exam->visibility) === 'public' ? 'selected' : '' }}>Public</option>
                            <option value="school" {{ old('visibility', $exam->visibility) === 'school' ? 'selected' : '' }}>School</option>
                            <option value="private" {{ old('visibility', $exam->visibility) === 'private' ? 'selected' : '' }}>Private</option>
                        </select>
                        @error('visibility')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="form-label" for="instruction">Instructions</label>
                        <textarea id="instruction" name="instruction" rows="4"
                            class="form-input w-full">{{ old('instruction', $exam->instruction) }}</textarea>
                        @error('instruction')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="allow_ai_hints" name="allow_ai_hints" value="1"
                            class="form-checkbox" {{ old('allow_ai_hints', $exam->allow_ai_hints) ? 'checked' : '' }}>
                        <label class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer" for="allow_ai_hints">
                            Allow AI Hints
                        </label>
                        @error('allow_ai_hints')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="btn bg-primary text-white">
                        <i class="mgc_edit_line mr-1"></i> Update Exam
                    </button>
                    <a href="{{ route('admin.exams.show', $exam->id) }}" class="btn bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

</main>
@endsection
