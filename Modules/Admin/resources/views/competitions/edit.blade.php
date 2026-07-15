@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.competitions.show', $competition->id) }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <i class="mgc_arrow_left_line text-xl"></i>
            </a>
            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Edit Competition</h4>
        </div>
    </div>

    @if(session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">{{ $competition->name }}</h6>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.competitions.update', $competition->id) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $competition->name) }}" class="form-input w-full" placeholder="Competition name" required>
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                        <textarea name="description" rows="4" class="form-input w-full" placeholder="Brief description of the competition...">{{ old('description', $competition->description) }}</textarea>
                        @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Instructions</label>
                        <textarea name="instruction" rows="4" class="form-input w-full" placeholder="Instructions for participants...">{{ old('instruction', $competition->instruction) }}</textarea>
                        @error('instruction')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status <span class="text-red-500">*</span></label>
                        <select name="status" class="form-select w-full" required>
                            <option value="">— Select Status —</option>
                            <option value="upcoming" {{ old('status', $competition->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="ongoing" {{ old('status', $competition->status) === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('status', $competition->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $competition->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Visibility</label>
                        <select name="visibility" class="form-select w-full">
                            <option value="">— Select Visibility —</option>
                            <option value="public" {{ old('visibility', $competition->visibility) === 'public' ? 'selected' : '' }}>Public</option>
                            <option value="school" {{ old('visibility', $competition->visibility) === 'school' ? 'selected' : '' }}>School</option>
                            <option value="private" {{ old('visibility', $competition->visibility) === 'private' ? 'selected' : '' }}>Private</option>
                        </select>
                        @error('visibility')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
                        <input type="text" name="type" value="{{ old('type', $competition->type) }}" class="form-input w-full" placeholder="e.g. quiz, essay">
                        @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div></div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date</label>
                        <input type="datetime-local" name="start_date"
                            value="{{ old('start_date', $competition->start_date ? \Carbon\Carbon::parse($competition->start_date)->format('Y-m-d\TH:i') : '') }}"
                            class="form-input w-full">
                        @error('start_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Date</label>
                        <input type="datetime-local" name="end_date"
                            value="{{ old('end_date', $competition->end_date ? \Carbon\Carbon::parse($competition->end_date)->format('Y-m-d\TH:i') : '') }}"
                            class="form-input w-full">
                        @error('end_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Schools</label>
                        @php $selectedSchoolIds = old('school_ids', $competition->schools->pluck('id')->toArray()); @endphp
                        <select name="school_ids[]" multiple class="form-select w-full" style="height: 160px;">
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}" {{ in_array($school->id, $selectedSchoolIds) ? 'selected' : '' }}>
                                    {{ $school->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Hold Ctrl / Cmd to select multiple schools.</p>
                        @error('school_ids')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                </div>

                <div class="mt-6 flex items-center gap-3">
                    <button type="submit" class="btn bg-primary text-white">
                        <i class="mgc_save_line mr-1"></i> Save Changes
                    </button>
                    <a href="{{ route('admin.competitions.show', $competition->id) }}" class="btn bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

</main>
@endsection
