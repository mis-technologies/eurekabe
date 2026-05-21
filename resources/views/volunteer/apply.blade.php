@extends('layout.app')
@section('content')
    <div class="container mx-auto py-12 px-4">
        <!-- Success/Error Messages -->
        @if ($message = session('success'))
            <div class="mb-8 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 rounded-lg" role="alert">
                <div class="flex items-center">
                    <svg class="w-4 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ $message }}</span>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-8 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 rounded-lg" role="alert">
                <div class="font-bold mb-2">Please correct the following errors:</div>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full mb-6">
                <span class="text-2xl">🌟</span>
            </div>
            <h1 class="text-4xl font-bold mb-4 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Call for Volunteers - Join the Eureka EdTech Team!</h1>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                Are you passionate about <strong>education, creativity, and innovation</strong>? 📚<br>
                Eureka EdTech is on a mission to make learning smarter, more engaging, and accessible for everyone — and we're looking for talented volunteers to join our <strong>remote creative team</strong>!
            </p>
        </div>


         <!-- Application Form -->
            <div class="md:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white">Apply Now</h2>
                    
                    <form method="POST" action="{{ route('volunteer.apply.submit') }}" class="space-y-6">
                        @csrf

                        <!-- Personal Info Row -->
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">First Name *</label>
                                <input type="text" name="firstname" value="{{ old('firstname') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       required />
                                @error('firstname')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Last Name *</label>
                                <input type="text" name="lastname" value="{{ old('lastname') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       required />
                                @error('lastname')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <!-- Contact Info Row -->
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       required />
                                @error('email')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone *</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       required />
                                @error('phone')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <!-- Education Row -->
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">University</label>
                                <input type="text" name="university" value="{{ old('university') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       placeholder="Optional" />
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Course</label>
                                <input type="text" name="course" value="{{ old('course') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       placeholder="Optional" />
                            </div>
                        </div>

                        <!-- Skills Section -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Skills *</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="skills[]" value="graphic_design" 
                                           class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" 
                                           {{ in_array('graphic_design', old('skills', [])) ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700 dark:text-gray-300">Graphic Design</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="skills[]" value="video_editing" 
                                           class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" 
                                           {{ in_array('video_editing', old('skills', [])) ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700 dark:text-gray-300">Video Editing / Animation</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="skills[]" value="social_media" 
                                           class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" 
                                           {{ in_array('social_media', old('skills', [])) ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700 dark:text-gray-300">Social Media / Content Creation</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="skills[]" value="community_management" 
                                           class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500" 
                                           {{ in_array('community_management', old('skills', [])) ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700 dark:text-gray-300">Community Management</span>
                                </label>
                            </div>
                            @error('skills')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                        </div>

                        <!-- Motivation -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Why do you want to volunteer? * <span class="text-xs text-gray-500">(minimum 100 characters)</span></label>
                            <textarea name="motivation" rows="3" minlength="100"
                                      class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                      placeholder="Tell us about your motivation..." 
                                      required>{{ old('motivation') }}</textarea>
                            @error('motivation')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                        </div>

                        <!-- Experience -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Previous Experience <span class="text-xs text-gray-500">(minimum 100 characters)</span></label>
                            <textarea name="experience" rows="3" minlength="100"
                                      class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                      placeholder="Any relevant experience...">{{ old('experience') }}</textarea>
                            @error('experience')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" 
                                    class="w-full bg-primary hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-medium py-3 rounded-lg transition duration-200">
                                Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    </div>

@endsection