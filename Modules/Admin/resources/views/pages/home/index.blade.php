@extends('admin::layouts.app')
@include('admin::partials.znotify')


@section('content')
    <main class="flex-grow p-6">

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Update Home page</h4>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.pages.home.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid lg:grid-cols-3 gap-6">
                        <!-- Hero Section -->

                        @php
                            $heroSection = json_decode($homePage->herosection);
                            $imgUrls = $heroSection->img_url ?? [];
                        @endphp

                        <!-- Title Input -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <textarea id="title" name="herosection[title]" placeholder="Enter title" class="form-input mt-1 block w-full">{{ old('herosection.title', $heroSection->title ?? '') }}</textarea>
                        </div>

                        <!-- Description Input -->
                        <div>
                            <label for="desc" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="desc" name="herosection[desc]" placeholder="Enter description" class="form-input mt-1 block w-full">{{ old('herosection.desc', $heroSection->desc ?? '') }}</textarea>
                        </div>

                        <!-- Community URL Input -->
                        <div>
                            <label for="community_url" class="block text-sm font-medium text-gray-700">Community WhatsApp
                                Link</label>
                            <textarea id="community_url" name="herosection[community_url]" placeholder="Enter WhatsApp link"
                                class="form-input mt-1 block w-full">{{ old('herosection.community_url', $heroSection->community_url ?? '') }}</textarea>
                        </div>

                        <!-- Image Inputs -->
                        @foreach (['img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7', 'img8'] as $imgKey)
                            <div>
                                <label for="{{ $imgKey }}" class="block text-sm font-medium text-gray-700">Hero
                                    Section {{ ucfirst($imgKey) }}</label>
                                <div class="w-32 h-32 overflow-hidden rounded-t-xl">
                                    @if (isset($imgUrls->$imgKey))
                                        <img style="height: 100%" class="w-64 h-64 object-cover rounded-t-xl"
                                            src="{{ asset($imgUrls->$imgKey) }}" alt="Hero Image">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                            <span class="text-gray-500">No Image Available</span>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" id="{{ $imgKey }}"
                                    name="herosection[img_url][{{ $imgKey }}]" class="form-input mt-1 block w-full">
                            </div>
                        @endforeach

                        <!-- pathner section -->

                        @php
                            $pathnerSection = json_decode($homePage->pathnersection);
                            $imgUrls = $pathnerSection->img_url ?? [];
                            $schools = $pathnerSection->schools ?? [];
                        @endphp

                        <!-- Description Input -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="title" name="pathnersection[title]" placeholder="Enter description"
                                class="form-input mt-1 block w-full">{{ old('pathnersection.title', $pathnerSection->title ?? '') }}</textarea>
                        </div>

                        <div class="flex flex-wrap gap-6">
                            @foreach ($schools as $index => $school)
                                <!-- School Card -->
                                <div class="flex flex-col items-center w-48">
                                    <!-- School Image -->
                                    <div class="w-32 h-32 overflow-hidden rounded-full">
                                        @if (isset($school->img_url))
                                            <img src="{{ asset($school->img_url) }}" alt="{{ $school->school_name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                <span class="text-gray-500">No Image Available</span>
                                            </div>
                                        @endif
                                    </div>
                                    <input type="file" name="pathnersection[schools][{{ $index }}][img_url]" class="form-input mt-2 block w-full">

                                    <!-- School Name -->
                                    <div class="mt-2 text-center">
                                        <input type="text" name="pathnersection[schools][{{ $index }}][school_name]" value="{{ $school->school_name ?? '' }}" placeholder="Enter School Name" class="form-input mt-1 block w-full text-center">
                                    </div>
                                </div>
                            @endforeach
                        </div>





            </div>

            <!-- Update Button -->
            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
            </form>

        </div>
        </div> <!-- end card -->

    </main>
@endsection
