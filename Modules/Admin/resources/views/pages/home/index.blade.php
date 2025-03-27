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
                        @endphp

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Title</label>
                            <textarea id="title" name="title" placeholder="Enter title" class="form-input mt-1 block w-full">{{ old('title', $heroSection->title) }}</textarea>
                        </div>

                        <!-- Description Input -->
                        <div>
                            <label for="desc" class="block text-sm font-medium text-gray-700">
                                Desc</label>
                            <textarea id="desc" name="desc" placeholder="Enter description" class="form-input mt-1 block w-full">{{ old('desc', $heroSection->desc) }}</textarea>
                        </div>

                        <!-- Community URL Input -->
                        <div>
                            <label for="community_url" class="block text-sm font-medium text-gray-700"> Join Community
                                WhatsApp Link</label>
                            <textarea id="community_url" name="community_url" placeholder="Enter WhatsApp link"
                                class="form-input mt-1 block w-full">{{ old('community_url', $heroSection->community_url) }}</textarea>
                        </div>
                        <!-- Image Input -->

                        @php
                            $heroSection = json_decode($homePage->herosection);
                            $imgUrls = $heroSection->img_url; // No need to decode again
                        @endphp

                        @php
                            $imageFields = [
                                'img1' => $imgUrls->img1 ?? '',
                                'img2' => $imgUrls->img2 ?? '',
                                'img3' => $imgUrls->img3 ?? '',
                                'img4' => $imgUrls->img4 ?? '',
                                'img5' => $imgUrls->img5 ?? '',
                                'img6' => $imgUrls->img6 ?? '',
                                'img7' => $imgUrls->img7 ?? '',
                                'img8' => $imgUrls->img8 ?? '',
                            ];
                        @endphp

                        @foreach ($imageFields as $name => $url)
                            <div>

                                <label class="block text-sm font-medium text-gray-700">Hero Section Image</label>
                                <div class="w-32 h-32 overflow-hidden rounded-t-xl">
                                    <input type="file">
                                    
                                    @if ($url)
                                        <img style="height: 100%" class="w-64 h-64 object-cover rounded-t-xl" src="{{ asset($url) }}"
                                            alt="Hero Image">
                                           
                                         
                                    @else
                                    
                                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                            <span class="text-gray-500">No Image Available</span>
                                        </div>
                                    @endif

                                  
                                </div>
                            </div>
                        @endforeach
                      
                        <!-- Partner Section -->
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
