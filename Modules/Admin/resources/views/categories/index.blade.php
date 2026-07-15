@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Categories &amp; Subjects</h4>
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

    <div class="grid lg:grid-cols-2 gap-6">

        <!-- ===== LEFT: Categories ===== -->
        <div class="flex flex-col gap-6">

            <!-- Add Category Form -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Add Category</h6>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="flex gap-3">
                            <div class="flex-grow">
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-input w-full" placeholder="Category name" required>
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <button type="submit" class="btn bg-primary text-white flex-shrink-0">
                                <i class="mgc_add_line mr-1"></i> Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">All Categories</h6>
                </div>
                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subjects</th>
                                            <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse($categories as $category)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $category->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-primary/20 text-primary">
                                                        {{ $category->subjects_count ?? $category->subjects->count() }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                    <a href="{{ route('admin.categories.delete', $category->id) }}"
                                                        onclick="return confirm('Delete this category? All associated subjects may be affected.')"
                                                        class="text-red-500 hover:text-red-700 text-xs font-medium">
                                                        <i class="mgc_delete_bin_line"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                                    No categories yet. Add one above.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ===== RIGHT: Subjects ===== -->
        <div class="flex flex-col gap-6">

            <!-- Add Subject Form -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Add Subject</h6>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.subjects.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-3">
                            <div>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-input w-full" placeholder="Subject name" required>
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <select name="category_id" class="form-select w-full" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <button type="submit" class="btn bg-primary text-white">
                                    <i class="mgc_add_line mr-1"></i> Add Subject
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Subjects Table -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">All Subjects</h6>
                </div>
                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                            <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse($subjects as $subject)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $subject->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $subject->category?->name ?? '—' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                    <a href="{{ route('admin.subjects.delete', $subject->id) }}"
                                                        onclick="return confirm('Delete this subject?')"
                                                        class="text-red-500 hover:text-red-700 text-xs font-medium">
                                                        <i class="mgc_delete_bin_line"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                                    No subjects yet. Add one above.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</main>
@endsection
