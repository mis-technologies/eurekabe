@extends('advocate::layouts.app')
@include('advocate::partials.znotify')

@section('content')
    <main class="flex-grow p-6">


        <!-- Page Title Start -->
        <div class="flex justify-between items-center mb-6">

        </div>
        <!-- Page Title End -->
        <div class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Exam Overview</h6>
                    </div>

                    <div class="p-6">
                        <div class="grid lg:grid-cols-4 gap-6">
                            <!-- stat 1 -->
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
                                        {{ $exam->questions_count }}</h4>
                                    <span class="text-sm">Total Questions</span>
                                </div>
                            </div>

                            <!-- stat 2 -->
                            <div class="flex items-center gap-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-check-square h-10 w-10">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                                <div class="">
                                    <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">
                                        {{ $exam->attempt_count }}</h4>
                                    <span class="text-sm">Total Exam Attempts</span>
                                </div>
                            </div>

                            <!-- stat 3 -->
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
                                        {{ $exam->feedback_count }}</h4>
                                    <span class="text-sm">Total Feedbacks</span>
                                </div>
                            </div>
                            <!-- stat 3 -->
                            <div class="flex items-center gap-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-clock h-10 w-10">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <div class="">
                                    <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">
                                        {{ $exam->total_hours }}</h4>
                                    <span class="text-sm">Total Hours Spent</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-span-2">
                <div class="card">
                    <div class="card-header flex justify-between">
                        <h6 class="card-title">Exam Questions</h6>
                        <a href="{{ route('advocate.exams.question.create', $exam->id) }}"
                            class="btn bg-primary text-white">Add Question</a>
                    </div>
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div
                                class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                                <div class="py-3 px-4">
                                    <div class="relative max-w-xs">
                                        <label for="table-with-pagination-search" class="sr-only">Search</label>
                                        <input type="text" name="table-with-pagination-search"
                                            id="table-with-pagination-search" class="form-input ps-11"
                                            placeholder="Search for items">
                                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                                            <svg class="h-3.5 w-3.5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col" class="py-3 px-4 pe-0">
                                                    <div class="flex items-center h-5">
                                                        <input id="table-pagination-checkbox-all" type="checkbox"
                                                            class="form-checkbox rounded">
                                                        <label for="table-pagination-checkbox-all"
                                                            class="sr-only">Checkbox</label>
                                                    </div>
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Question</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Mark</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Type</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach ($questions as $question)
                                                <tr>
                                                    <td class="py-3 ps-4">
                                                        <div class="flex items-center h-5">
                                                            <input id="table-pagination-checkbox-1" type="checkbox"
                                                                class="form-checkbox rounded">
                                                            <label for="table-pagination-checkbox-1"
                                                                class="sr-only">{{ $question->question }}</label>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        {{ $question->question }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $question->marks }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $question->questionType->name }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                        <a class="text-primary hover:text-sky-700"
                                                            href="{{ route('advocate.exams.question.show', [$exam->id, $question->id]) }}">Update</a>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <div class="py-4 px-4">
                                    {!! $questions->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-1">
                <div class="card">
                    <div class="card-header flex justify-between">
                        <h4 class="card-title">Exam Details</h4>
                        <div class="uppercase flex gap-4">
                            <a href="#"
                                class="inline-flex items-center font-semibold py-1 px-2 rounded text-xs bg-primary/20 text-primary">{{ $exam->tag }}</a>
                        </div>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('advocate.exams.update', $exam->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf

                            <div class="my-4">
                                <label for="project-name" class="mb-2 block">Exam Title</label>
                                <input type="text" required name="title" value="{{ $exam->title }}"
                                    class="form-input">
                            </div>

                            <div class="my-4">
                                <label class="mb-2 block" for="">Instructions</label>
                                <textarea required name="instruction" cols="50" rows="5" class="form-input">
                                     {!! $exam->instruction !!}
                                </textarea>
                            </div>


                            <div class="my-4 ">
                                <label for="project-name" class="mb-2 block">Duration</label>
                                <input type="number" required name="duration" value="{{ $exam->duration }}"
                                    class="form-input">
                            </div>

                            {{-- subject --}}
                            <div class="my-4">
                                <label for="select-label" class="mb-2 block">Subject</label>
                                <select required id="select-label" name="subject_id" class="form-select">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}"
                                            {{ $subject->id == $exam->subject_id ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="my-4 ">
                                <label for="project-name" class="block">Pass Percentage</label>
                                <input type="number" required name="pass_percentage"
                                    value="{{ $exam->pass_percentage }}" class="form-input">
                            </div>


                            <div class="my-4">
                                <label for="product-status" class="mb-2 block">Status <span
                                        class="text-red-500">*</span></label>
                                <div class="flex gap-x-6">
                                    <div class="flex">
                                        <input type="radio" name="status" class="form-radio" id="active"
                                            value="1" {{ $exam->status == 1 ? 'checked' : '' }}>
                                        <label for="active"
                                            class="text-sm text-gray-500 ms-2 dark:text-gray-400">Active</label>
                                    </div>

                                    <div class="flex">
                                        <input type="radio" name="status" class="form-radio" id="inactive"
                                            value="2" {{ $exam->status == 2 ? 'checked' : '' }}>
                                        <label for="inactive"
                                            class="text-sm text-gray-500 ms-2 dark:text-gray-400">Inactive</label>
                                    </div>
                                </div>

                            </div>


                            <div class="my-4">
                                <h6 class="text-gray-800 font-medium mb-3">Cover Image</h6>
                                <div class="grid md:grid-cols-1 gap-1">
                                    <div class="p-2 border border-gray-200 dark:border-gray-700 rounded mb-2">
                                        <div class=" items-center">
                                            <div
                                                class="h-9 w-9 rounded flex justify-center items-center text-primary bg-primary/20 me-3">
                                                <i class="mgc_file_new_line text-xl"></i>
                                            </div>
                                            <div class="">
                                                <img src="{{ $exam->image }}" class="text-sm font-medium"></a>
                                            </div>
                                            <div>
                                                <input type="file" name="image" id="">
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <button type="submit" class="btn bg-primary text-white">Update
                                Exam</button>

                        </form>
                    </div>
                </div>
            </div>


        </div>

    </main>
@endsection
