@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h4 class="card-title">Update Events</h4>
                <a href="{{ route('admin.pages.update.event.view') }}" target="_blank" class="btn bg-primary text-white" rel="noopener noreferrer">Create new</a>
            </div>
        </div>

        @php
        $assets = env('APP_URL').'/';
        @endphp

        <div class="p-6">
            <div class="grid lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ $event?->title }}</label>
                    <div class="w-32 h-32 overflow-hidden rounded-t-xl">
                        <img style="height: 100%" class="w-64 h-64 object-cover rounded-t-xl" src="{{$assets.$event?->image }}" alt="Event Image">
                    </div>

                    <h4 class="text-sm font-medium text-gray-700 mt-2">{{ $event?->event_date }}</h4>
                    <p class="text-sm mt-2">{{ \Illuminate\Support\Str::limit(strip_tags($event?->description), 100) }}</p>



                    <a href="{{ route('admin.pages.update.event.view', $event->id) }}" class="btn bg-primary mt-4 text-white" target="_blank" rel="noopener noreferrer">
                        Edit
                    </a>
                    <a href="{{ route('admin.pages.delete.event', $event->id) }}" class="btn bg-danger mt-4 text-white">
                        Delete
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div> <!-- end card -->

</main>
@endsection
