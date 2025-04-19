{{-- filepath: /Users/airon/dev/www/eurekabe/Modules/Advocate/resources/views/competition/create.blade.php --}}
@extends('advocate::layouts.app')
@include('advocate::partials.znotify')

@section('content')
    <main class="flex-grow p-6">
        <!-- Page Title Start -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold">Create Competition</h1>
        </div>
        <!-- Page Title End -->

        <form action="{{ route('advocate.competitions.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="grid lg:grid-cols-4 gap-6">
                <!-- Left Column -->
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

                <!-- Right Column -->
                <div class="lg:col-span-3 space-y-6">
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-4">
                            <p class="card-title">General Competition Data</p>
                            <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                                <i class="mgc_transfer_line"></i>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3">
                            <!-- Competition Name -->
                            <div>
                                <label for="name" class="mb-2 block">Competition Name</label>
                                <input required type="text" id="name" name="name" class="form-input" placeholder="Enter Competition Name">
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="mb-2 block">Description</label>
                                <textarea required id="description" name="description" class="form-input" rows="4" placeholder="Enter Description"></textarea>
                            </div>

                            <!-- Instruction -->
                            <div>
                                <label for="instruction" class="mb-2 block">Instructions</label>
                                <textarea required id="instruction" name="instruction" class="form-input" rows="4" placeholder="Enter Instructions"></textarea>
                            </div>

                            <!-- Start Date -->
                            <div>
                                <label for="start_date" class="mb-2 block">Start Date</label>
                                <input required type="date" id="start_date" name="start_date" class="form-input">
                            </div>

                            <!-- End Date -->
                            <div>
                                <label for="end_date" class="mb-2 block">End Date</label>
                                <input required type="date" id="end_date" name="end_date" class="form-input">
                            </div>

                            <!-- Visibility -->
                            <div>
                                <label for="visibility" class="mb-2 block">Visibility</label>
                                <select required id="visibility" name="visibility" class="form-select">
                                    <option value="public">Public</option>
                                    <option value="private">Private</option>
                                </select>
                            </div>

                            <!-- Type -->
                            <div>
                                <label for="type" class="mb-2 block">Type</label>
                                <select required id="type" name="type" class="form-select">
                                    <option value="1">Online</option>
                                    <option value="2">Offline</option>
                                </select>
                            </div>

                            <!-- Schools -->
                            <div>
                                <label for="schools" class="mb-2 block">Schools</label>
                                <select required id="schools" name="school_id[]" class="form-select" multiple>
                                    @foreach ($schools as $school)
                                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Exams -->
                            <div>
                                <label for="exams" class="mb-2 block">Exams</label>
                                <select required id="exams" name="exam_id[]" class="form-select" multiple>
                                    @foreach ($exams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="lg:col-span-4 mt-5">
                        <div class="flex justify-start gap-3">
                            <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection