@extends('admin::layouts.app')

@section('content')
    <main class="flex-grow p-6">

        <!-- Page Title Start -->
        <div class="flex justify-between items-center mb-6">

        </div>
        <!-- Page Title End -->

        {{-- <div class="grid 2xl:grid-cols-3 gap-6 mb-6">

            <div class="2xl:col-span-3">
                <div class="grid xl:grid-cols-3 md:grid-cols-2 gap-6 mb-6">

                    <div class="card">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-base mb-1 text-gray-600 dark:text-gray-400">Recent School</h4>
                                    <p class="font-normal text-sm text-gray-400 truncate dark:text-gray-500">
                                        {{ $quick_infos['recent_school']['name'] }}
                                    </p>
                                </div>


                            </div>

                            <div class="flex items-end">
                                <div class="flex-grow">
                                    <p class="text-[13px] text-gray-400 dark:text-gray-500 font-semibold"><i
                                            class="mgc_alarm_2_line"></i>
                                        {{ $quick_infos['recent_school']['created_at'] ? $quick_infos['recent_school']['created_at']->diffForHumans() : '' }}
                                    </p>
                                </div>
                                <div class="flex">
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset($quick_infos['recent_school']['cover_image']) }}"
                                            class="rounded-full h-8 w-8 border-2 border-gray-300 dark:border-gray-700"
                                            alt="friend">
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-base mb-1 text-gray-600 dark:text-gray-400">Most Recent Student
                                    </h4>
                                    <p class="font-normal text-sm text-gray-400 truncate dark:text-gray-500">
                                        {{ $quick_infos['recent_student']['firstname'] }}</p>
                                </div>

                            </div>

                            <div class="flex items-end">
                                <div class="flex-grow">
                                    <p class="text-[13px] text-gray-400 dark:text-gray-500 font-semibold"><i
                                            class="mgc_alarm_2_line"></i>
                                        {{ $quick_infos['recent_student']['created_at'] ? $quick_infos['recent_student']['created_at']->diffForHumans() : '' }}
                                    </p>
                                </div>
                                <div class="flex">

                                    <a href="javascript:void(0);" class="-ms-2">
                                        <img src="{{ asset($quick_infos['recent_student']['image']) }}"
                                            class="rounded-full h-8 w-8 border-2 border-gray-300 dark:border-gray-700"
                                            alt="friend">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-base mb-1 text-gray-600 dark:text-gray-400">Recent Exam
                                    </h4>
                                    <p class="font-normal text-sm text-gray-400 truncate dark:text-gray-500">
                                        {{ $quick_infos['recent_exam']['title'] }}</p>
                                </div>

                            </div>

                            <div class="flex items-end">
                                <div class="flex-grow">
                                    <p class="text-[13px] text-gray-400 dark:text-gray-500 font-semibold"><i
                                            class="mgc_alarm_2_line"></i>
                                        {{ $quick_infos['recent_exam']['created_at'] ? $quick_infos['recent_exam']['created_at']->diffForHumans() : '' }}
                                    </p>
                                </div>
                                <div class="flex">

                                    <a href="javascript:void(0);" class="-ms-2">
                                        <img src="{{ asset($quick_infos['recent_exam']['cover_image']) }}"
                                            class="rounded-full h-8 w-8 border-2 border-gray-300 dark:border-gray-700"
                                            alt="friend">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>


        </div>  --}}

        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6 mb-6">
            <div class="col-span-1">
                <div class="card">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="w-12 h-12 flex justify-center items-center rounded text-primary bg-primary/25">
                                    <i class="mgc_document_2_line text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h5 class="mb-1">Total Students</h5>
                                {{-- <p>{{ $stats['total_students'] ?? 9 }}</p> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="card">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="w-12 h-12 flex justify-center items-center rounded text-success bg-success/25">
                                    <i class="mgc_group_line text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h5 class="mb-1">Total Exams</h5>
                                {{-- <p>{{ $stats['total_exams'] ?? 9 }}</p> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="card">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="w-12 h-12 flex justify-center items-center rounded text-info bg-info/25">
                                    <i class="mgc_star_line text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h5 class="mb-1">Total Exam Results</h5>
                                {{-- <p>{{ $stats['total_challenges'] ?? 9 }}</p> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="card">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="w-12 h-12 flex justify-center items-center rounded text-warning bg-warning/25">
                                    <i class="mgc_new_folder_line text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h5 class="mb-1">Total Questions</h5>
                                {{-- <p>{{ $stats['total_questions'] ?? 9 }}</p> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Grid End -->

        {{-- <div class="grid 2xl:grid-cols-4 md:grid-cols-2 gap-6">


            <div class="col-span-2">
                <div class="card">
                    <div class="card-header">
                        <div class="flex justify-between items-center">
                            <h4 class="card-title">Top Exams</h4>

                        </div>
                    </div>

                    <div class="py-6">
                        <div class="px-6" data-simplebar="init" style="max-height: 304px;">
                            <div class="simplebar-wrapper" style="margin: 0px -24px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content"
                                            style="height: auto; overflow: hidden scroll;">
                                            <div class="simplebar-content" style="padding: 0px 24px;">
                                                <div class="space-y-4">

                                                    @if ($top_exams)
                                                        @foreach ($top_exams as $exam)
                                                            <div
                                                                class="border border-gray-200 dark:border-gray-700 rounded p-2">
                                                                <ul class="flex items-center gap-2 mb-2">
                                                                    <a href="javascript:void(0);"
                                                                        class="text-base text-gray-600 dark:text-gray-400">
                                                                        {{ $exam->title }}
                                                                    </a>
                                                                    <i class="mgc_round_fill text-[5px]"></i>
                                                                </ul>
                                                                <p class="text-gray-500 dark:text-gray-400 text-sm mb-1">
                                                                    {{ $exam->instruction }}</p>
                                                                <p class="text-gray-500 dark:text-gray-400 text-sm"><i
                                                                        class="mgc_group_line text-xl me-1 align-middle"></i>
                                                                    <b>{{ $exam->exam_results_count }}</b> Attempts
                                                                </p>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div>
                                                            <p>No records</p>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: auto; height: 467px;">
                                </div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 197px; transform: translate3d(0px, 0px, 0px); display: block;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-2">
                <div class="card">
                    <div class="card-header flex justify-between items-center">
                        <h4 class="card-title">Top Students</h4>
                    </div>

                    <div class="py-6">
                        <div class="px-6" data-simplebar="init" style="max-height: 304px;">
                            <div class="simplebar-wrapper" style="margin: 0px -24px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content"
                                            style="height: auto; overflow: hidden scroll;">
                                            <div class="simplebar-content" style="padding: 0px 24px;">
                                                <div class="space-y-6">

                                                    @if ($top_students)
                                                        @foreach ($top_students as $student)
                                                            <div class="flex items-center">
                                                                <img class="me-3 rounded-full"
                                                                    src="{{ asset( $student->image ) }}"
                                                                    width="40" alt="Generic placeholder image">
                                                                <div class="w-full overflow-hidden">
                                                                    <h5 class="font-semibold"><a
                                                                            href="javascript:void(0);"
                                                                            class="text-gray-600 dark:text-gray-400">{{ $student->firstname . ' ' . $student->lastname  }}</a></h5>
                                                                    <div class="flex items-center gap-2">
                                                                        <i class="mgc_round_fill text-[5px]"></i>
                                                                        <div>Joined {{ $student->created_at->diffForHumans() }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else

                                                    <div class="flex items-center">
                                                        <p>No record</p>
                                                    </div>
                                                    @endif


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: auto; height: 414px;">
                                </div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 223px; transform: translate3d(0px, 0px, 0px); display: block;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> --}}

    </main>
@endsection
