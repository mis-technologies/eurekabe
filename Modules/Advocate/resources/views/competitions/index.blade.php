@extends('advocate::layouts.app')

@section('content')
    <main class="flex-grow p-6">

        <!-- Page Title Start -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('advocate.competitions.create') }}" class="btn bg-primary text-white">Create Competition</a>
        </div>
        <!-- Page Title End -->

        <div class="flex flex-auto flex-col">
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($competitions as $competition)
                    <div class="card">
                        <div class="card-header">
                            <div class="flex justify-between items-center">
                                <h5 class="card-title">{{ $competition->name }}</h5>
                                <div class="{{ $competition->visibility == 'public' ? 'bg-success' : 'bg-danger' }} text-xs text-white rounded-md py-1 px-1.5 font-medium" role="alert">
                                    {{ ucfirst($competition->visibility) }}
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="py-3 px-6">
                                <a href="{{ route('advocate.competitions.edit', $competition->id) }}" class="block">
                                    <div class="py-3 px-6 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                        <h5 class="my-2">
                                            <span class="text-slate-900 dark:text-slate-200">{{ $competition->description }}</span>
                                        </h5>
                                        <p class="text-gray-500 text-sm mb-9">{{ $competition->instruction }}</p>
                                    </div>
                                </a>
                            </div>

                            <div class="border-t p-5 border-gray-300 dark:border-gray-700">
                                <div class="grid lg:grid-cols-2">
                                    <div class="flex items-center justify-between">
                                        <a href="#" class="text-sm">
                                            <i class="mgc_calendar_line text-lg me-2"></i>
                                            <span class="align-text-bottom">{{ $competition->start_date->format('d M Y') }}</span>
                                        </a>

                                        <a href="#" class="text-sm">
                                            <i class="mgc_calendar_event_line text-lg me-2"></i>
                                            <span class="align-text-bottom">{{ $competition->end_date->format('d M Y') }}</span>
                                        </a>
                                    </div>

                                    <div class="flex justify-end">
                                        <a href="{{ route('advocate.competitions.edit', $competition->id) }}" class="btn bg-secondary text-white">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-6">
                {!! $competitions->links() !!}
            </div>
        </div>
    </main>
@endsection