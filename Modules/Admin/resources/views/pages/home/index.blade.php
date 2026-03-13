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

        <section id="create-founder" class="container mx-auto py-16 bg-white dark:bg-dark dark:text-white">
            <div class="max-w-3xl mx-auto mt-12 bg-white dark:bg-gray-900 shadow rounded-lg p-8">
                <h2 class="text-xl font-semibold mb-6">Create Founder</h2>

                <form action="{{ route('founders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Name</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-800 dark:border-gray-700"
                            required
                        >
                    </div>

                    <!-- Position -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Position</label>
                        <input
                            type="text"
                            name="position"
                            value="{{ old('position') }}"
                            class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-800 dark:border-gray-700"
                            required
                        >
                    </div>


                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Status</label>
                        <select
                            name="is_active"
                            class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-800 dark:border-gray-700"
                        >
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <!-- Image -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Founder Image (PNG only)</label>
                        <input
                            type="file"
                            name="image"
                            accept="image/*"
                            class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-primary dark:bg-gray-800 dark:border-gray-700"
                            required
                        >
                    </div>

                    <div class="pt-4">
                        <button
                            type="submit"
                            class="px-6 py-2 bg-primary text-white rounded-md hover:bg-primary/90"
                        >
                            Create Founder / Team Member
                        </button>
                    </div>

                </form>
            </div>
        </section>

        @if ($founders->count() > 0)
          <section id="edit-founders" class="bg-white py-24 relative container md:py-16 dark:bg-dark dark:text-white">
            <h1 class="font-bold text-3xl text-center mb-10 md:mb-16">
                Edit Founders
            </h1>
            
            <form method="POST" action="{{ route('founders.update.bulk') }}" enctype="multipart/form-data" class="max-w-4xl mx-auto">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 m-3">
                    @foreach ($founders as $founder)
                        <div class="w-full flex flex-col gap-6 gap-y-10 items-center justify-between md:max-w-lg lg:flex-row md:items-start border p-6 rounded-lg">
                            <div class="img-container relative">
                                <div class="h-52 w-52 border-primary border-[8px] translate-y-6"></div>
                                <div class="bg-[#DFDBD7] border-white border-[8px] h-52 w-52 translate-x-6 absolute top-0 right-0 pt-8 overflow-hidden">
                                    <img src="{{ asset($founder->image_path) }}" alt="{{ $founder->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="space-y-2">
                                <label for="image_{{ $founder->id }}" class="font-semibold text-sm">Update Image (optional)</label>
                                <input 
                                    type="file" 
                                    name="images[{{ $founder->id }}]" 
                                    id="image_{{ $founder->id }}"
                                    accept="image/*"
                                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:bg-gray-800 dark:border-gray-700"
                                >
                            </div>
                            </div>
                            
                            <div class="w-full md:max-w-64 space-y-4 text-center md:text-left">
                                <!-- Name Input -->
                                <div class="space-y-2">
                                    <label for="name_{{ $founder->id }}" class="font-semibold text-sm">Name</label>
                                    <input 
                                        type="text" 
                                        name="founders[{{ $founder->id }}][name]" 
                                        id="name_{{ $founder->id }}"
                                        value="{{ $founder->name }}"
                                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:bg-gray-800 dark:border-gray-700"
                                        required
                                    >
                                </div>
                                
                                <!-- Position Input -->
                                <div class="space-y-2">
                                    <label for="position_{{ $founder->id }}" class="font-semibold text-sm">Position</label>
                                    <input 
                                        type="text" 
                                        name="founders[{{ $founder->id }}][position]" 
                                        id="position_{{ $founder->id }}"
                                        value="{{ $founder->position }}"
                                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:bg-gray-800 dark:border-gray-700"
                                        required
                                    >
                                </div>
                                
                                <!-- Is Active Select -->
                                <div class="space-y-2">
                                    <label for="is_active_{{ $founder->id }}" class="font-semibold text-sm">Status</label>
                                    <select 
                                        name="founders[{{ $founder->id }}][is_active]" 
                                        id="is_active_{{ $founder->id }}"
                                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:bg-gray-800 dark:border-gray-700"
                                        required
                                    >
                                        <option value="1" {{ $founder->is_active ? 'selected' : '' }}>Active (True)</option>
                                        <option value="0" {{ !$founder->is_active ? 'selected' : '' }}>Inactive (False)</option>
                                    </select>
                                </div>
                                
                                <!-- Order Column Input -->
                                <div class="space-y-2">
                                    <label for="order_column_{{ $founder->id }}" class="font-semibold text-sm">Display Order</label>
                                    <input 
                                        type="number" 
                                        name="founders[{{ $founder->id }}][order_column]" 
                                        id="order_column_{{ $founder->id }}"
                                        value="{{ $founder->order_column ?? 0 }}"
                                        min="0"
                                        step="1"
                                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary dark:bg-gray-800 dark:border-gray-700"
                                        required
                                    >
                                </div>
                                
                                <div class="h-[1.2px] w-full bg-primary mt-4"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Submit Button -->
                <div class="text-center mt-10">
                    <button 
                        type="submit"
                        class="px-8 py-3 bg-primary text-white rounded-md hover:bg-primary-dark transition-colors duration-200 font-semibold mb-3"
                    >
                        Update All Founders
                    </button>
                </div>
            </form>            
        </section>  
        @endif
        
        </div> 

    </main>
@endsection
