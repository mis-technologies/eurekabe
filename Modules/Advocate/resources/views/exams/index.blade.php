@extends('advocate::layouts.app')

@section('content')
    <main class="flex-grow p-6">

        <!-- Page Title Start -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('advocate.exams.create') }}" class="btn bg-primary text-white" > Create Exam </a>
        </div>
        <!-- Page Title End -->
        <div class="flex flex-auto flex-col">

            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($exams as $exam)
                    <div class="card">
                        <div class="card-header">
                            <div class="flex justify-between items-center">
                                <h5 class="card-title">{{ $exam->subject->name }}</h5>
                                <div class="bg-success text-xs text-white rounded-md py-1 px-1.5 font-medium" role="alert">
                                    <span>Complated</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="py-3 px-6">
                                <h5 class="my-2"><a href="{{ route('advocate.exams.show', $exam->id) }}"
                                        class="text-slate-900 dark:text-slate-200">{{ $exam->title }}</a></h5>
                                <p class="text-gray-500 text-sm mb-9">{{ $exam->instruction }}</p>

                                <div class="flex -space-x-2">

                                    @if($exam->recentExamResults()->count() )
                                        @foreach ($exam->recentExamResults() as $student)
                                            <a href="javascript: void(0);">
                                                <img class="inline-block h-12 w-12 rounded-full border-2 border-white dark:border-gray-700"
                                                    src="{{ $student->image }}" alt="Image Description">
                                            </a>
                                        @endforeach
                                        <a href="javascript: void(0);">
                                            <div class="relative inline-flex">
                                                <button
                                                    class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-gray-200 border-2 border-white font-medium text-gray-700 shadow-sm align-middle dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 transition-all text-sm">
                                                    <span class="font-medium leading-none">{{ $exam->recentExamResults()->count() }}+</span>
                                                </button>
                                            </div>
                                        </a>
                                    @endif
                                    

                                </div>
                            </div>

                            <div class="border-t p-5 border-gray-300 dark:border-gray-700">
                                <div class="grid lg:grid-cols-2 ">

                                    <div class="flex items-center justify-between ">
                                        <a href="#" class="text-sm">
                                            <i class="mgc_calendar_line text-lg me-2"></i>
                                            <span class="align-text-bottom">{{ $exam->created_at->format('i M Y') }}</span>
                                        </a>

                                        <a href="#" class="text-sm">
                                            <i class="mgc_align_justify_line text-lg me-2"></i>
                                            <span class="align-text-bottom">{{ $exam->questions_count }}</span>
                                        </a>

                                        <a href="#" class="text-sm">
                                            <i class="mgc_comment_line text-lg me-2"></i>
                                            <span class="align-text-bottom">{{ $exam->feedback_count }}</span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

            <div class="text-center mt-6">
                {{-- <button type="button" class="btn bg-transparent border-gray-300 dark:border-gray-700">
                    <i class="mgc_loading_4_line me-2 animate-spin"></i>
                    <span>Load More</span>
                </button> --}}

                {!! $exams->render() !!}
            </div>

        </div>


    </main>
@endsection
