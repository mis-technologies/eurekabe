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
                    <div class="overflow-x-auto p-6">
                        <livewire:student-exam-table />
                    </div>
                </div>
            </div>

        </div>

    </main>
@endsection
