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
                        <h6 class="card-title">All Students</h6>
                    </div>


                </div>
            </div>


            <div class="col-span-3">
                <div class="card">
                    <div class="card-header flex justify-between">
                        <h6 class="card-title">Students</h6>
                        {{-- <a href="{{ route('advocate.exams.question.create', $exam->id) }}" class="btn bg-primary text-white">Add Question</a> --}}
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

                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    No</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Name</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Email</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Phone</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Role</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    School</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Interest</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Status</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach ($students as $s)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200 dark:text-gray-200">
                                                        {{ $loop->index +1 }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        {{ $s?->firstname }}, {{$s?->lastname}}
                                                        <br>
                                                        {{$s?->username}}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-1000 dark:text-gray-200">
                                                        {{ $s?->email }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $s?->phone}}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $s?->role}}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        {{ $s?->school?->name}}</td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                            {{ implode(', ', (array) $s->interest) }}
                                                        </td>
                                                        
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        @if($s?->status == 1)

                                                        <span>Active</span>

                                                        @else
                                                        <span>Inactive</span>
                                                        @endif</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">

                                                       

                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="py-4 px-4">
                                   {!! $questions->render() !!}
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="lg:col-span-1">
                <div class="card">
                    <div class="card-header flex justify-between">
                        <h4 class="card-title">Exam Details</h4>
                        <div class="uppercase flex gap-4">
                            <a href="#"
                                class="inline-flex items-center font-semibold py-1 px-2 rounded text-xs bg-primary/20 text-primary">{{ $exam->tag }}</a>
                        </div>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('advocate.exams.update', $exam->id) }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <label for="project-name" class="mb-2 block">Exam Title</label>
                            <input type="text" name="title" value="{{ $exam->title }}" class="form-input">

                            <label class="mb-2 block" for="">Instructions</label>
                            <textarea name="instruction" cols="50" rows="5" class="form-input">
                                 {!! $exam->instruction !!}
                            </textarea>


                            <label for="project-name" class="mb-2 block">Duration</label>
                            <input type="text" name="duration" value="{{ $exam->duration }}" class="form-input">

                            <label for="project-name" class="mb-2 block">Pass Percentage</label>
                            <input type="text" name="pass_percentage" value="{{ $exam->pass_percentage }}" class="form-input">

                            <div class="mt-6">
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

                            <button type="submit"
                                class="btn bg-primary text-white">Update
                                Exam</button>

                        </form>
                    </div>
                </div>
            </div> --}}


        </div>

    </main>
@endsection
