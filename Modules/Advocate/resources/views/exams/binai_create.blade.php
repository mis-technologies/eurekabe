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

            const prompt = {
                "topic": topic,
                "total_questions": totalQuestions,
                "batch_size": 5
            };

            const response = await fetch('/api/generate-questions-batch', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(prompt)
            });

            const data = await response.json();
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
    </script>
@endpush

@section('content')
    <main class="flex-grow p-6">
        <div class="grid lg:grid-cols-3 gap-6">
            <div class="col-span-2">
                <div class="bg-white shadow-md rounded p-4">
                    <h2 class="text-xl font-semibold mb-3">Generated Exam</h2>
                    <div id="examOutput" class="bg-gray-100 p-3 rounded"></div>
                </div>
            </div>
            <div class="lg:col-span-1">
                <div class="card">
                    <div class="card-header flex justify-between">
                        <h4 class="card-title">Exam Details</h4>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            <div class="card p-6">
                                <p class="card-title">AI Prompt</p>
                                <div class="flex flex-col gap-3">
                                    <label for="topic" class="mb-2 block">Exam Topic</label>
                                    <input type="text" id="topic" class="form-input" placeholder="Enter Topic" required/>
                                    
                                    <label for="total_questions" class="mb-2 block">Total Questions</label>
                                    <input type="number" id="total_questions" class="form-input" placeholder="Enter Total Questions" min="1" max="50" required/>
                                </div>
                            </div>
                            <div class="lg:col-span-4 mt-5">
                                <button onclick="generateExam()" class="bg-green-500 px-4 py-2 text-white rounded">Generate Exam</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
