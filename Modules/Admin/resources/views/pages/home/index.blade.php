@extends('admin::layouts.app')
@include('admin::partials.znotify')

@section('content')
    <main class="flex-grow p-6">
        @php
        $heroSection = json_decode($homePage->herosection);
        $imgUrls = $heroSection->img_url; // No need to decode again
    @endphp

@php
$heroSection = json_decode($homePage->herosection);
@endphp
        <!-- Page Title End -->
        <div class="grid lg:grid-cols-4 gap-6">
            <div>
                @if($homePage)
                <div class="card">
                
                @if(isset($imgUrls->img1))
                    <img class="w-full h-auto rounded-t-xl" src="{{ asset($imgUrls->img1) }}" alt="Image Description">
                @endif
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                            Hero Section
                        </h3>
                       
                        <p class="mt-1 text-gray-800 dark:text-gray-400">
                            {{ $heroSection->title }}
                        </p>
                        <a class="btn bg-primary text-white mt-2"  href="{{ route('admin.pages.home.edit-hero-section', ['column' => 'herosection']) }}">
                        Edit
                        </a>
                    </div>
                </div>
            </div>
            
            <div>
                <div class="card">
                    <img class="w-full h-auto rounded-t-xl" src="{{ asset('assets/images/small/small-2.jpg')}}" alt="Image Description">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                            Card title
                        </h3>
                        <p class="mt-1 text-gray-800 dark:text-gray-400">
                            Some quick example text to build on the card title and make up the bulk of the card's content.
                        </p>
                        <p class="mt-5 text-xs text-gray-500 dark:text-gray-500">
                            Last updated 5 mins ago
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                            Card title
                        </h3>
                        <p class="mt-1 text-gray-800 dark:text-gray-400">
                            Some quick example text to build on the card title and make up the bulk of the card's content.
                        </p>
                        <p class="mt-5 text-xs text-gray-500 dark:text-gray-500">
                            Last updated 5 mins ago
                        </p>
                    </div>
                    <img class="w-full h-auto rounded-b-xl" src="assets/images/small/small-3.jpg" alt="Image Description">
                </div>
            </div>

            @else
            <p>No data available</p>

          
            @endif
        </div>

    </main>
@endsection
