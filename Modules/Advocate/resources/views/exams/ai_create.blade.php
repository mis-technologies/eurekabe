@extends('advocate::layouts.app')
@include('advocate::partials.znotify')

@push('scripts')
    <script>
        async function generateExam() {
            const topic = document.getElementById('topic').value;
            const totalQuestions = parseInt(document.getElementById('total_questions').value);

            if (!topic) {
                alert('Topic is required');
                return;
            }

            if (totalQuestions > 50) {
                alert('Total questions cannot exceed 50');
                return;
            }

            document.getElementById('loadingIndicator').style.display = 'block';

            const prompt = {
                "topic": topic,
                "total_questions": totalQuestions,
                "batch_size": 5,

            };

            const response = await fetch('/api/generate-questions-batch', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(prompt)
            });

            const data = await response.json();
            document.getElementById('loadingIndicator').style.display = 'none';
            document.getElementById('saveExamModalButton').style.display = 'block';

            displayExam(data);
        }

        function displayExam(data) {
            const container = document.getElementById('examOutput');
            container.innerHTML = '';
            if (data.success && data.data.length > 0) {
                data.data.forEach((question, index) => {
                    const questionDiv = document.createElement('div');
                    questionDiv.classList.add('p-4', 'mb-4', 'bg-gray-100', 'rounded');

                    questionDiv.innerHTML = `
                        <label class="font-semibold">Question ${index + 1}:</label>
                        <input type="text" class="w-full p-2 border rounded mb-2" value="${question.question}"/>
                        <label class="font-semibold">Options:</label>
                        <div>
                            ${question.options.map((option, i) => `
                                        <div class="flex items-center gap-2 mb-2">
                                            <input type="text" class="w-full p-2 border rounded" value="${option.option}"/>
                                            <input type="checkbox" ${option.is_correct ? 'checked' : ''} />
                                        </div>
                                    `).join('')}
                        </div>
                    `;
                    container.appendChild(questionDiv);
                });
            } else {
                container.innerHTML = '<p class="text-red-500">No questions generated.</p>';
            }
        }

        function openSaveModal() {
            document.getElementById('saveExamModal').style.display = 'block';
        }

        function closeSaveModal() {
            document.getElementById('saveExamModal').style.display = 'none';
        }

        async function saveExam(event) {
            event.preventDefault(); // Prevent page reload

            const form = document.getElementById('saveExamForm');

            const examData = {
                topic: document.getElementById('topic').value,
                title: form.title.value,
                instruction: form.instruction.value,
                duration: parseInt(form.duration.value),
                pass_percentage: parseInt(form.pass_percentage.value),
                status: parseInt(form.status.value),
                subject_id: parseInt(form.subject_id.value),
                school_id: parseInt(form.school_id.value),
                questions: Array.from(document.getElementById('examOutput').children).map(q => ({
                    question: q.querySelector('input[type="text"]').value,
                    marks: 1,
                    options: Array.from(q.querySelectorAll('div > div')).map(opt => ({
                        option: opt.querySelector('input[type="text"]').value,
                        is_correct: opt.querySelector('input[type="checkbox"]').checked
                    }))
                }))
            };

            try {
                const response = await fetch('/api/save-generated-ai-exam', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(examData)
                });

                console.log(response)
                if (response.ok) {
                    alert('Exam saved successfully!');
                    document.querySelector('[data-fc-dismiss]').click(); // Close modal
                    window.location.reload();
                } else {
                    alert('Failed to save exam. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        }
    </script>
@endpush

@section('content')
    <main class="flex-grow p-6">
        <div class="grid lg:grid-cols-3 gap-6">
            <div class="col-span-2" >
                <div class="bg-white shadow-md rounded p-4" >
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-xl font-semibold">Generated Exam</h2>
                        <button id="saveExamModalButton" class="btn bg-primary hidden  text-white" data-fc-target="saveExamModal"
                            data-fc-type="modal" type="button">
                            Save Exam
                        </button>
                    </div>
                    <div id="loadingIndicator" class="text-blue-500" style="display: none;">Generating exam, please wait...</div>
                    <div id="examOutput" class="bg-gray-100 p-3 rounded"></div>
                </div>
            </div>
            <div class="lg:col-span-1">
                <div class="card">
                    <div class="p-6">
                        <div class="space-y-6">
                            <label for="topic" class="mb-2 block">Exam Topic</label>
                            <input type="text" id="topic" class="form-input" placeholder="Enter Topic" required />

                            <label for="total_questions" class="mb-2 block">Total Questions</label>
                            <input type="number" id="total_questions" class="form-input"
                                placeholder="Enter Total Questions" min="1" max="50" required />

                        </div>
                        <div class="lg:col-span-4 mt-5">
                            <button onclick="generateExam()" class="bg-green-500 px-4 py-2 text-white rounded">Generate
                                Exam</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="saveExamModal" class="w-full h-full mt-5 fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden">
        <div
            class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto flex flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
            <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                    Save Generated Exam
                </h3>

            </div>
            <form id="saveExamForm" onsubmit="return saveExam(event)">
                <div class="px-4 py-8 overflow-y-auto">
                    <div class="flex flex-col gap-3">
                        <div>
                            <label for="title" class="mb-2 block">Exam Title</label>
                            <input required type="text" id="title" name="title" class="form-input"
                                placeholder="Enter Title">
                        </div>

                        <div>
                            <label for="instruction" class="mb-2 block">Exam Instructions <span
                                    class="text-red-500">*</span></label>
                            <textarea required id="instruction" name="instruction" class="form-input" rows="4"></textarea>
                        </div>

                        <div>
                            <label for="duration" class="mb-2 block">Duration (mins)</label>
                            <input required type="number" id="duration" name="duration" class="form-input" min="1"
                                placeholder="e.g 20">
                        </div>

                        <div>
                            <label for="pass_percentage" class="mb-2 block">Pass Percentage</label>
                            <input required type="number" id="pass_percentage" name="pass_percentage" class="form-input"
                                min="0" max="100" placeholder="e.g 70">
                        </div>

                        <div>
                            <label for="status" class="mb-2 block">Status</label>
                            <select required id="status" name="status" class="form-select">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>

                        <div>
                            <label for="subject_id" class="mb-2 block">Subject</label>
                            <select required id="subject_id" name="subject_id" class="form-select">
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <input type="hidden" id="school_id" name="school_id" value="{{ $school_id }}" class="form-input">                         
                        </div>

                    </div>

                </div>
                <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                    <button type="button" class="btn border dark:text-gray-200" data-fc-dismiss>Close</button>
                    <button type="submit" class="bg-green-500 px-4 py-2 text-white rounded">Confirm</button>
                </div>
            </form>
        </div>
    </div>
@endsection
