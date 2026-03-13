@extends('advocate::layouts.app')
@include('advocate::partials.znotify')

@section('content')
<main class="flex-grow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Edit Competition</h1>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-3">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Competition Overview</h6>
                </div>

                <div class="p-6">
                    <div class="grid lg:grid-cols-4 gap-6">
                        <!-- Stat 1 -->
                        <div class="flex items-center gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-grid h-10 w-10">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">
                                    {{ $competition->exams->sum('pivot.total_questions') }}</h4>
                                <span class="text-sm">Total Submissions</span>
                            </div>
                        </div>

                        <!-- Stat 2 -->
                        <div class="flex items-center gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-check-square h-10 w-10">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">
                                    {{ $competition->participants->count() }}</h4>
                                <span class="text-sm">Total Participants</span>
                            </div>
                        </div>

                        <!-- Stat 3 -->
                        <div class="flex items-center gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-users h-10 w-10">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">
                                    {{ 0 }}</h4>
                                <span class="text-sm">Total Feedbacks</span>
                            </div>
                        </div>

                        <!-- Stat 4 -->
                        <div class="flex items-center gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-clock h-10 w-10">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">
                                    {{ $competition->exams->sum('pivot.duration') }}</h4>
                                <span class="text-sm">Total Hours Spent</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <form action="{{ route('advocate.competitions.update', $competition->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="grid lg:grid-cols-4 gap-6">
                <div class="col-span-1 flex flex-col gap-6">
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="card-title">Update Cover Image</h4>
                            <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                                <i class="mgc_add_line"></i>
                            </div>
                        </div>
                        <div class="dz-message needsclick w-full">
                        @if($competition->image)
                                <img src="{{ $competition->image }}" alt="Competition Image" class="w-full h-32 object-cover rounded-md mb-4">
                            @else
                                <i class="mgc_pic_2_line text-8xl"></i>                        
                        @endif
                            <input type="file" class="form-input" name="image">
                            <p class="text-sm text-gray-500 mt-2">Leave blank to keep the current image.</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3 space-y-6">
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-4">
                            <p class="card-title">General Competition Data</p>
                            <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                                <i class="mgc_transfer_line"></i>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3">
                            <div>
                                <label for="name" class="mb-2 block">Competition Name</label>
                                <input required type="text" id="name" name="name" class="form-input" value="{{ $competition->name }}" placeholder="Enter Competition Name">
                            </div>

                            <div>
                                <label for="description" class="mb-2 block">Description</label>
                                <textarea required id="description" name="description" class="form-input" rows="4" placeholder="Enter Description">{{ $competition->description }}</textarea>
                            </div>

                            <div>
                                <label for="instruction" class="mb-2 block">Instructions</label>
                                <textarea required id="instruction" name="instruction" class="form-input" rows="4" placeholder="Enter Instructions">{{ $competition->instruction }}</textarea>
                            </div>

                            <div>
                                <label for="start_date" class="mb-2 block">Start Date</label>
                                <input required type="date" id="start_date" name="start_date" class="form-input" value="{{ $competition->start_date->format('Y-m-d') }}">
                            </div>

                            <div>
                                <label for="end_date" class="mb-2 block">End Date</label>
                                <input required type="date" id="end_date" name="end_date" class="form-input" value="{{ $competition->end_date->format('Y-m-d') }}">
                            </div>

                            {{-- <div>
                                <label for="visibility" class="mb-2 block">Visibility</label>
                                <select required id="visibility" name="visibility" class="form-select">
                                    <option value="public" {{ $competition->visibility == 'public' ? 'selected' : '' }}>Public</option>
                                    <option value="private" {{ $competition->visibility == 'private' ? 'selected' : '' }}>Private</option>
                                </select>
                            </div> --}}

                            {{-- <div>
                                <label for="type" class="mb-2 block">Type</label>
                                <select required id="type" name="type" class="form-select">
                                    <option value="1" {{ $competition->type == 1 ? 'selected' : '' }}>Online</option>
                                    <option value="2" {{ $competition->type == 2 ? 'selected' : '' }}>Offline</option>
                                </select>
                            </div> --}}

                            <!-- Schools -->
                            <div>
                                <label for="school-select" class="mb-2 block">Schools</label>
                                <select id="school-select" class="form-select">
                                    <option value="">-- Select School --</option>
                                    @foreach ($schools as $school)
                                        @if (!in_array($school->id, $competitionSchools))
                                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div id="school-selected" class="flex flex-wrap gap-2 mt-3">
                                    @foreach ($schools as $school)
                                        @if (in_array($school->id, $competitionSchools))
                                            <div class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full flex items-center gap-2 school-pill" data-id="{{ $school->id }}">
                                                {{ $school->name }}
                                                <button type="button" class="text-red-500 remove-school">✕</button>
                                                <input type="hidden" name="school_id[]" value="{{ $school->id }}">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Exams -->
                            <div>
                                <label for="exam-select" class="mb-2 block">Exams</label>
                                <select id="exam-select" class="form-select">
                                    <option value="">-- Select Exam --</option>
                                    @foreach ($exams as $exam)
                                        @if (!in_array($exam->id, $competitionExams))
                                            <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div id="exam-controls" class="space-y-4 mt-3">
                                    @foreach ($exams as $exam)
                                        @if (in_array($exam->id, $competitionExams))
                                            <div class="border p-4 rounded-md" data-exam-id="{{ $exam->id }}">
                                                <div class="flex items-center justify-between">
                                                    <span class="font-semibold">{{ $exam->title }}</span>
                                                    <button type="button" class="text-red-500 remove-exam" data-exam-id="{{ $exam->id }}">Remove</button>
                                                </div>
                                                <input type="hidden" name="exam_id[]" value="{{ $exam->id }}">
                                                <div class="mt-4 grid grid-cols-2 gap-4 exam-details">

                                                   
                                                    <div>
                                                        <label for="duration_{{ $exam->id }}" class="block text-sm font-medium">Duration (minutes)</label>
                                                        <input type="number" id="duration_{{ $exam->id }}" name="exam_duration[{{ $exam->id }}]" class="form-input" value="{{ $competition->exams->find($exam->id)?->pivot->duration ?? '' }}" placeholder="Enter duration">
                                                    </div>
                                                    <div>
                                                        <label for="questions_{{ $exam->id }}" class="block text-sm font-medium">Total Questions</label>
                                                        <input type="number" id="questions_{{ $exam->id }}" name="exam_questions[{{ $exam->id }}]" class="form-input" value="{{ $competition->exams->find($exam->id)?->pivot->total_questions ?? '' }}" placeholder="Enter total questions">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4 mt-5">
                        <div class="flex justify-start gap-3">
                            <button style="background: black" type="submit" class="inline-flex items-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-600 focus:outline-none">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const examSelect = document.getElementById('exam-select');
        const examControls = document.getElementById('exam-controls');

        const schoolSelect = document.getElementById('school-select');
        const schoolSelected = document.getElementById('school-selected');

        examSelect.addEventListener('change', function () {
            const examId = this.value;
            const examTitle = this.options[this.selectedIndex].text;

            if (examId) {
                const wrapper = document.createElement('div');
                wrapper.className = 'border p-4 rounded-md';
                wrapper.setAttribute('data-exam-id', examId);

                wrapper.innerHTML = `
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">${examTitle}</span>
                        <button type="button" class="text-red-500 remove-exam" data-exam-id="${examId}">Remove</button>
                    </div>
                    <input type="hidden" name="exam_id[]" value="${examId}">
                    <div class="mt-4 grid grid-cols-2 gap-4 exam-details">
                        <div>
                            <label class="block text-sm font-medium">Duration (minutes)</label>
                            <input type="number" name="exam_duration[${examId}]" class="form-input" placeholder="Enter duration">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Total Questions</label>
                            <input type="number" name="exam_questions[${examId}]" class="form-input" placeholder="Enter total questions">
                        </div>
                    </div>
                `;

                examControls.appendChild(wrapper);
                this.querySelector(`option[value="${examId}"]`).remove();
                this.value = '';
            }
        });

        examControls.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-exam')) {
                const examId = e.target.dataset.examId;
                const examElement = document.querySelector(`[data-exam-id="${examId}"]`);
                const title = examElement.querySelector('span').innerText;

                const option = document.createElement('option');
                option.value = examId;
                option.text = title;
                examSelect.appendChild(option);

                examElement.remove();
            }
        });

        schoolSelect.addEventListener('change', function () {
            const schoolId = this.value;
            const schoolName = this.options[this.selectedIndex].text;

            if (schoolId) {
                const pill = document.createElement('div');
                pill.className = 'bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full flex items-center gap-2 school-pill';
                pill.dataset.id = schoolId;

                pill.innerHTML = `
                    ${schoolName}
                    <button type="button" class="text-red-500 remove-school">✕</button>
                    <input type="hidden" name="school_id[]" value="${schoolId}">
                `;

                schoolSelected.appendChild(pill);
                this.querySelector(`option[value="${schoolId}"]`).remove();
                this.value = '';
            }
        });

        schoolSelected.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-school')) {
                const pill = e.target.closest('.school-pill');
                const schoolId = pill.dataset.id;
                const name = pill.childNodes[0].textContent.trim();

                const option = document.createElement('option');
                option.value = schoolId;
                option.text = name;
                schoolSelect.appendChild(option);

                pill.remove();
            }
        });
    });
</script>
@endsection
