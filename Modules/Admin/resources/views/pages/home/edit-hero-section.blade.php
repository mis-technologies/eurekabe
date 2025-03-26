@extends('admin::layouts.app')
@include('admin::partials.znotify')


@section('content')
    <main class="flex-grow p-6">

        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h4 class="card-title">Update Home page Hero Section</h4>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.pages.update', ['column' => $column]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf


                    <div class="grid lg:grid-cols-3 gap-6">
                        <!-- Title Input -->
                        @php
                            $heroSection = json_decode($homePage->herosection);
                        @endphp
                        <!-- Title Input -->
                        @php
                            $heroSection = json_decode($homePage->herosection);
                        @endphp
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">{{ ucfirst($column) }}
                                Title</label>
                            <textarea id="title" name="title" placeholder="Enter title" class="form-input mt-1 block w-full">{{ old('title', $heroSection->title) }}</textarea>
                        </div>

                        <!-- Description Input -->
                        <div>
                            <label for="desc" class="block text-sm font-medium text-gray-700">{{ ucfirst($column) }}
                                Desc</label>
                            <textarea id="desc" name="desc" placeholder="Enter description" class="form-input mt-1 block w-full">{{ old('desc', $heroSection->desc) }}</textarea>
                        </div>

                        <!-- Community URL Input -->
                        <div>
                            <label for="community_url"
                                class="block text-sm font-medium text-gray-700">{{ ucfirst($column) }} Join Community
                                WhatsApp Link</label>
                            <textarea id="community_url" name="community_url" placeholder="Enter WhatsApp link"
                                class="form-input mt-1 block w-full">{{ old('community_url', $heroSection->community_url) }}</textarea>
                        </div>


                        @php
                            $heroSection = json_decode($homePage->herosection);
                            $imgUrls = $heroSection->img_url; // No need to decode again
                        @endphp

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image 1</label>
                            <img class="w-64 h-64 object-cover rounded-t-xl" src="{{ asset($imgUrls->img1) }}"
                                alt="Image Description">
                            <input type="file" name="img1" id="image" class="form-input mt-1 block w-full">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image 2</label>
                            <img class="w-64 h-64 object-cover rounded-t-xl" src="{{ asset($imgUrls->img2) }}"
                                alt="Image Description">
                            <input type="file" name="img2" class="form-input mt-1 block w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image 3</label>
                            <img class="w-64 h-64 object-cover rounded-t-xl" src="{{ asset($imgUrls->img3) }}"
                                alt="Image Description">
                            <input type="file" name="img3" class="form-input mt-1 block w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image 4</label>
                            <img class="w-64 h-64 object-cover rounded-t-xl" src="{{ asset($imgUrls->img4) }}"
                                alt="Image Description">
                            <input type="file" name="img4" class="form-input mt-1 block w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image 5</label>
                            <img class="w-64 h-64 object-cover rounded-t-xl" src="{{ asset($imgUrls->img5) }}"
                                alt="Image Description">
                            <input type="file" name="img5" class="form-input mt-1 block w-full">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image 6</label>
                            <img class="w-64 h-64 object-cover rounded-t-xl" src="{{ asset($imgUrls->img6) }}"
                                alt="Image Description">
                            <input type="file" name="img6" class="form-input mt-1 block w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image 7</label>
                            <img class="w-64 h-64 object-cover rounded-t-xl" src="{{ asset($imgUrls->img7) }}"
                                alt="Image Description">
                            <input type="file" name="img7" class="form-input mt-1 block w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image 8</label>
                            <img class="w-64 h-64 object-cover rounded-t-xl" src="{{ asset($imgUrls->img8) }}"
                                alt="Image Description">
                            <input type="file" name="img8" class="form-input mt-1 block w-full">
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
