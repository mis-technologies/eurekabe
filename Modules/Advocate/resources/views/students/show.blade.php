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
                        <h6 class="card-title">Student Overview</h6>
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
                                        {{ $stats['total_exams'] }}</h4>
                                    <span class="text-sm">Total Exams</span>
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
                                        {{ $stats['total_challenges'] }}</h4>
                                    <span class="text-sm">Total Challenges</span>
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
                                        {{ $stats['total_feedbacks'] }}</h4>
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
                                        {{ $stats['total_hours'] }}</h4>
                                    <span class="text-sm">Total Hours Spent</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-span-3">
                <div class="card">
                    <div class="card-header flex justify-between">
                        <h6 class="card-title">Student Exams</h6>
                    </div>
                    <div class="overflow-x-auto p-6">
                        @livewire('student-exam-table', ['student_id' => $student->id])
                    </div>
                </div>
            </div>
            
        </div>

    </main>
@endsection
