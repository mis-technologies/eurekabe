@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Credit Plans</h4>
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

    <!-- Create New Plan -->
    <div class="card mb-6">
        <div class="card-header">
            <h6 class="card-title">Add New Credit Plan</h6>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.billing.plans.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input w-full" placeholder="e.g. Pro Monthly" required>
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-input w-full" placeholder="e.g. pro-monthly" required>
                        @error('slug')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
                        <select name="type" class="form-select w-full" required>
                            <option value="">-- Select --</option>
                            <option value="monthly" {{ old('type') === 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="pay_as_you_go" {{ old('type') === 'pay_as_you_go' ? 'selected' : '' }}>Pay As You Go</option>
                        </select>
                        @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Monthly Credits</label>
                        <input type="number" name="monthly_credits" value="{{ old('monthly_credits', 0) }}" class="form-input w-full" min="0" required>
                        @error('monthly_credits')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Price (&#8358;)</label>
                        <input type="number" name="price_ngn" value="{{ old('price_ngn', 0) }}" class="form-input w-full" min="0" step="0.01" required>
                        @error('price_ngn')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex items-end gap-6 pb-1">
                        <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" name="rollover" value="1" class="form-checkbox" {{ old('rollover') ? 'checked' : '' }}>
                            Rollover
                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="form-checkbox" checked>
                            Active
                        </label>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn bg-primary text-white">
                        <i class="mgc_add_line mr-1"></i> Create Plan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Plans Table -->
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">All Plans</h6>
        </div>
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Credits/mo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price (&#8358;)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rollover</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Active</th>
                                    <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($plans as $plan)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $plan->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <code class="text-xs bg-gray-100 dark:bg-gray-800 px-1 rounded">{{ $plan->slug }}</code>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            @if($plan->type === 'monthly')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">Monthly</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">Pay As You Go</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            {{ number_format($plan->monthly_credits) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            &#8358;{{ number_format($plan->price_ngn, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            @if($plan->rollover)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">Yes</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">No</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($plan->is_active)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">Active</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <div class="flex items-center justify-end gap-2">
                                                <button type="button"
                                                    onclick="document.getElementById('edit-form-{{ $plan->id }}').classList.toggle('hidden')"
                                                    class="text-primary hover:text-sky-700 text-xs font-medium">
                                                    Edit
                                                </button>
                                                <form action="{{ route('admin.billing.plans.toggle', $plan->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-amber-600 hover:text-amber-800 text-xs font-medium">
                                                        {{ $plan->is_active ? 'Disable' : 'Enable' }}
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.billing.plans.delete', $plan->id) }}"
                                                    onclick="return confirm('Delete this plan? This cannot be undone.')"
                                                    class="text-red-500 hover:text-red-700 text-xs font-medium">
                                                    Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Inline Edit Row -->
                                    <tr id="edit-form-{{ $plan->id }}" class="hidden bg-gray-50 dark:bg-gray-800/50">
                                        <td colspan="8" class="px-6 py-4">
                                            <form action="{{ route('admin.billing.plans.update', $plan->id) }}" method="POST">
                                                @csrf
                                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Name</label>
                                                        <input type="text" name="name" value="{{ $plan->name }}" class="form-input w-full" required>
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Slug</label>
                                                        <input type="text" name="slug" value="{{ $plan->slug }}" class="form-input w-full" required>
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Type</label>
                                                        <select name="type" class="form-select w-full" required>
                                                            <option value="monthly" {{ $plan->type === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                                            <option value="pay_as_you_go" {{ $plan->type === 'pay_as_you_go' ? 'selected' : '' }}>Pay As You Go</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Monthly Credits</label>
                                                        <input type="number" name="monthly_credits" value="{{ $plan->monthly_credits }}" class="form-input w-full" min="0" required>
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Price (&#8358;)</label>
                                                        <input type="number" name="price_ngn" value="{{ $plan->price_ngn }}" class="form-input w-full" min="0" step="0.01" required>
                                                    </div>
                                                    <div class="flex items-end gap-6 pb-1">
                                                        <label class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400 cursor-pointer">
                                                            <input type="checkbox" name="rollover" value="1" class="form-checkbox" {{ $plan->rollover ? 'checked' : '' }}>
                                                            Rollover
                                                        </label>
                                                        <label class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400 cursor-pointer">
                                                            <input type="checkbox" name="is_active" value="1" class="form-checkbox" {{ $plan->is_active ? 'checked' : '' }}>
                                                            Active
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mt-3 flex gap-2">
                                                    <button type="submit" class="btn bg-primary text-white text-xs py-1.5 px-3">Save Changes</button>
                                                    <button type="button"
                                                        onclick="document.getElementById('edit-form-{{ $plan->id }}').classList.add('hidden')"
                                                        class="btn bg-gray-200 text-gray-700 text-xs py-1.5 px-3">Cancel</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                            No credit plans found. Create one above.
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

</main>
@endsection
