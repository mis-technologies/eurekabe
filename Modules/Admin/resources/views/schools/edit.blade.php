@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Edit School</h4>
        <a href="{{ route('admin.schools.index') }}" class="btn bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200">
            <i class="mgc_arrow_left_line mr-1"></i> Back to Schools
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Edit: {{ $school->name }}</h6>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.schools.update', $school->id) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="form-label" for="name">Name <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $school->name) }}"
                            class="form-input w-full" placeholder="School name" required>
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="acronym">Acronym</label>
                        <input type="text" id="acronym" name="acronym" value="{{ old('acronym', $school->acronym) }}"
                            class="form-input w-full" placeholder="e.g. UNILAG">
                        @error('acronym')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="type">Type</label>
                        <select id="type" name="type" class="form-select w-full">
                            <option value="">-- Select Type --</option>
                            <option value="university" {{ old('type', $school->type) === 'university' ? 'selected' : '' }}>University</option>
                            <option value="polytechnic" {{ old('type', $school->type) === 'polytechnic' ? 'selected' : '' }}>Polytechnic</option>
                            <option value="college" {{ old('type', $school->type) === 'college' ? 'selected' : '' }}>College</option>
                            <option value="secondary" {{ old('type', $school->type) === 'secondary' ? 'selected' : '' }}>Secondary</option>
                        </select>
                        @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="year">Year Founded</label>
                        <input type="number" id="year" name="year" value="{{ old('year', $school->year) }}"
                            class="form-input w-full" min="1800" max="{{ date('Y') }}">
                        @error('year')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="city">City</label>
                        <input type="text" id="city" name="city" value="{{ old('city', $school->city) }}"
                            class="form-input w-full" placeholder="City">
                        @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="state">State</label>
                        <input type="text" id="state" name="state" value="{{ old('state', $school->state) }}"
                            class="form-input w-full" placeholder="State">
                        @error('state')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="form-label" for="about">About</label>
                        <textarea id="about" name="about" rows="4"
                            class="form-input w-full">{{ old('about', $school->about) }}</textarea>
                        @error('about')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                            class="form-checkbox" {{ old('is_active', $school->is_active) ? 'checked' : '' }}>
                        <label class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer" for="is_active">
                            Active
                        </label>
                        @error('is_active')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="btn bg-primary text-white">
                        <i class="mgc_edit_line mr-1"></i> Update School
                    </button>
                    <a href="{{ route('admin.schools.index') }}" class="btn bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

</main>
@endsection
