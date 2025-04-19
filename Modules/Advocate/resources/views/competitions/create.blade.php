@extends('advocate::layouts.app')
@include('advocate::partials.znotify')

@section('content')
    <main class="flex-grow p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold">Create Competition</h1>
        </div>

        <form action="{{ route('advocate.competitions.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="grid lg:grid-cols-4 gap-6">
                <div class="col-span-1 flex flex-col gap-6">
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="card-title">Add Cover Image</h4>
                            <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                                <i class="mgc_add_line"></i>
                            </div>
                        </div>
                        <div class="dz-message needsclick w-full">
                            <i class="mgc_pic_2_line text-8xl"></i>
                            <input required type="file" class="form-input" name="image">
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
                                <input required type="text" id="name" name="name" class="form-input" placeholder="Enter Competition Name">
                            </div>

                            <div>
                                <label for="description" class="mb-2 block">Description</label>
                                <textarea required id="description" name="description" class="form-input" rows="4" placeholder="Enter Description"></textarea>
                            </div>

                            <div>
                                <label for="instruction" class="mb-2 block">Instructions</label>
                                <textarea required id="instruction" name="instruction" class="form-input" rows="4" placeholder="Enter Instructions"></textarea>
                            </div>

                            <div>
                                <label for="start_date" class="mb-2 block">Start Date</label>
                                <input required type="date" id="start_date" name="start_date" class="form-input">
                            </div>

                            <div>
                                <label for="end_date" class="mb-2 block">End Date</label>
                                <input required type="date" id="end_date" name="end_date" class="form-input">
                            </div>
{{-- 
                            <div>
                                <label for="visibility" class="mb-2 block">Visibility</label>
                                <select required id="visibility" name="visibility" class="form-select">
                                    <option value="public">Public</option>
                                    <option value="private">Private</option>
                                </select>
                            </div> --}}

                            {{-- <div>
                                <label for="type" class="mb-2 block">Type</label>
                                <select required id="type" name="type" class="form-select">
                                    <option value="1">Online</option>
                                    <option value="2">Offline</option>
                                </select>
                            </div> --}}

                            <!-- Schools -->
                            <div>
                                <label for="school-select" class="mb-2 block">Schools</label>
                                <select id="school-select" class="form-select">
                                    <option value="">-- Select School --</option>
                                    @foreach ($schools as $school)
                                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                                    @endforeach
                                </select>
                                <div id="school-selected" class="flex flex-wrap gap-2 mt-3"></div>
                            </div>

                            <!-- Exams -->
                            <div>
                                <label for="exam-select" class="mb-2 block">Exams</label>
                                <select id="exam-select" class="form-select">
                                    <option value="">-- Select Exam --</option>
                                    @foreach ($exams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                                    @endforeach
                                </select>
                                <div id="exam-controls" class="space-y-4 mt-3"></div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4 mt-5">
                        <div class="flex justify-start gap-3">
                            <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-600 focus:outline-none">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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