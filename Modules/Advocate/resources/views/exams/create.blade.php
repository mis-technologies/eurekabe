@extends('advocate::layouts.app')
@include('advocate::partials.znotify')

@section('content')
    <main class="flex-grow p-6">


        <!-- Page Title Start -->
        <div class="flex justify-between items-center mb-6">

        </div>
        <!-- Page Title End -->
        <form action="{{ route('advocate.exams.store') }}" class="" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="grid lg:grid-cols-4 gap-6">
                <div class="col-span-1 flex flex-col gap-6">
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="card-title">Add Cover Image</h4>
                            <div
                                class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
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
                            <p class="card-title">General Exam Data</p>
                            <div
                                class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                                <i class="mgc_transfer_line"></i>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3">
                            <div class="">
                                <label for="project-name" class="mb-2 block">Exam Title</label>
                                <input required type="text" id="title" name="title" class="form-input"
                                    placeholder="Enter Title" aria-describedby="input-helper-text">
                            </div>

                            <div class="">
                                <label for="project-description" class="mb-2 block">Exam Instructions <span
                                        class="text-red-500">*</span></label>
                                <textarea required id="instruction" name="instruction" class="form-input" rows="8"></textarea>
                            </div>

                            <div class="">
                                <label for="project-name" class="mb-2 block">Duration (mins)</label>
                                <input required type="number" id="title" name="duration" class="form-input"
                                    placeholder="e.g 20" aria-describedby="input-helper-text">
                            </div>

                            <div class="">
                                <label for="project-name" class="mb-2 block">Pass Percentage</label>
                                <input required type="number" id="title" name="pass_percentage" class="form-input"
                                    placeholder="e.g 70" aria-describedby="input-helper-text">
                            </div>

                            <div class="">
                                <label for="product-status" class="mb-2 block">Status <span
                                        class="text-red-500">*</span></label>
                                <div class="flex gap-x-6">
                                    <div class="flex">
                                        <input type="radio" name="status" class="form-radio" id="private"
                                            checked="" value="1">
                                        <label for="private"
                                            class="text-sm text-gray-500 ms-2 dark:text-gray-400">Active</label>
                                    </div>

                                    <div class="flex">
                                        <input type="radio" name="status" class="form-radio" id="team" value="2">
                                        <label for="team"
                                            class="text-sm text-gray-500 ms-2 dark:text-gray-400">Inctive</label>
                                    </div>

                                  
                                </div>
                            </div>


                            <div>
                                <label for="select-label" class="mb-2 block">Subject</label>
                                <select required id="select-label" name="subject_id" class="form-select">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                           
                            <div>
                                <label for="select-label" class="mb-2 block">Exam Type</label>
                                <select required id="select-label" name="question_type" class="form-select">
                                    <option value="1">Multiple Choice  Exam</option>
                                    <option value="2">Essay Exam</option>
                                </select>
                            </div>




                        </div>
                    </div>

                    <div class="lg:col-span-4 mt-5">
                        <div class="flex justify-start gap-3">
                            <button type="submit"
                                class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
        </form>

    </main>
@endsection
