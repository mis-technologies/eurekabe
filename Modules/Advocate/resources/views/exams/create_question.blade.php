@extends('advocate::layouts.app')
@include('advocate::partials.znotify')

@section('content')
    <main class="flex-grow p-6">
        <div class="">
            <div class="my-2">
                <div class="card p-6">
                    <div class="flex justify-between items-center mb-4">
                        <p class="card-title">Question</p>
                    </div>
                    <div class="flex flex-col gap-3">
                        <div>
                            <label for="project-description" class="mb-2 block">Question <span
                                    class="text-red-500">*</span></label>
                            <textarea required id="question" name="question" class="form-input" rows="8"></textarea>
                        </div>
                        <div>
                            <label for="project-name" class="mb-2 block">Marks</label>
                            <input required type="number" id="marks" name="marks" class="form-input"
                                placeholder="Enter Marks">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="col-span-1 flex flex-col gap-6" id="options-container"></div>
                <button style="background: black" id="add-option" type="button"
                    class="mt-3 bg-black-100 text-white px-4 py-2 rounded flex items-center gap-2">
                    <i class="fa fa-plus"></i>
                    Add Option
                </button>
            </div>

            <div class="lg:col-span-4 mt-5">
                <div class="flex justify-start gap-3">
                   
                    <button id="save-question" type="button"
                        class="bg-green-500 text-white px-4 py-2 rounded">Save Question</button>
                        <button type="button" class="bg-red-500 text-white px-4 py-2 rounded">Cancel</button>
                </div>
            </div>

        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector("#save-question").addEventListener("click", function() {
                let formData = new FormData();
                formData.append("question", document.querySelector("#question").value);
                formData.append("marks", document.querySelector("#marks").value);

                let options = [];
                document.querySelectorAll(".option-input").forEach((input, index) => {
                    options.push({
                        option: input.value,
                        is_correct: document.querySelector(
                            `.correct-option[data-index='${index}']`).checked ? 1 : 0
                    });
                });
                formData.append("options", JSON.stringify(options));
                fetch("{{ route('advocate.exams.question.store', [$exam->id]) }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']")
                                .getAttribute("content")
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        notify("success", "Question saved successfully!");
                    })
                    .catch(error => console.error("Error:", error));
            });

            document.querySelector("#add-option").addEventListener("click", function() {
                let optionIndex = document.querySelectorAll(".option-input").length;
                let newOption = document.createElement("div");
                newOption.classList.add("card", "p-6", "flex", "flex-col", "gap-3");
                newOption.innerHTML = `
                <div class="flex justify-between">
                    <label class="mb-2 block">Option ${optionIndex + 1}</label>
                    <a href="javascript:void(0);" class="remove-option text-red-500"> <i class="mgc_delete_line text-xl"></i> </a>
                </div>
                <input type="text" class="form-input option-input" placeholder="Enter option text">
                <div class="mt-4">
                    <label class="mb-2 block">Is Correct <span class="text-red-500">*</span></label>
                    <div class="flex">
                        <input type="checkbox" name="correct_option" class="form-checkbox correct-option" data-index="${optionIndex}">
                        <label class="text-sm text-gray-500 ms-2 dark:text-gray-400">Yes</label>
                    </div>
                </div>
            `;
                document.querySelector("#options-container").appendChild(newOption);
            });

            document.addEventListener("click", function(event) {
                if (event.target.closest(".remove-option")) {
                    event.target.closest(".card").remove();
                }

                if (event.target.classList.contains("correct-option")) {
                    document.querySelectorAll(".correct-option").forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    event.target.checked = true;
                }
            });
        });
    </script>
@endpush
