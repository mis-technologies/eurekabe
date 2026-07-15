@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Feature Credit Costs</h4>
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
            <h6 class="card-title">All Feature Costs</h6>
        </div>
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Feature Key</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cost (Credits)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Active</th>
                                    <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($costs as $cost)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            <code class="text-xs bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded">{{ $cost->feature_key }}</code>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400 max-w-xs">
                                            {{ $cost->description ?? '—' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800 dark:text-gray-200">
                                            {{ number_format($cost->credits) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($cost->is_active)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">Active</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm">
                                            <button type="button"
                                                onclick="document.getElementById('edit-cost-{{ $cost->id }}').classList.toggle('hidden')"
                                                class="text-primary hover:text-sky-700 text-xs font-medium">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Inline Edit Row -->
                                    <tr id="edit-cost-{{ $cost->id }}" class="hidden bg-gray-50 dark:bg-gray-800/50">
                                        <td colspan="5" class="px-6 py-4">
                                            <form action="{{ route('admin.billing.costs.update', $cost->id) }}" method="POST">
                                                @csrf
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Cost (Credits)</label>
                                                        <input type="number" name="credits" value="{{ $cost->credits }}" class="form-input w-full" min="0" required>
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Description</label>
                                                        <input type="text" name="description" value="{{ $cost->description }}" class="form-input w-full" placeholder="Optional description">
                                                    </div>
                                                    <div class="flex items-end pb-1">
                                                        <label class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-400 cursor-pointer">
                                                            <input type="checkbox" name="is_active" value="1" class="form-checkbox" {{ $cost->is_active ? 'checked' : '' }}>
                                                            Active
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mt-3 flex gap-2">
                                                    <button type="submit" class="btn bg-primary text-white text-xs py-1.5 px-3">Save</button>
                                                    <button type="button"
                                                        onclick="document.getElementById('edit-cost-{{ $cost->id }}').classList.add('hidden')"
                                                        class="btn bg-gray-200 text-gray-700 text-xs py-1.5 px-3">Cancel</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                            No feature costs configured.
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
