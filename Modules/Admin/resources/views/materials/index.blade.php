@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Study Materials</h4>
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
        <div class="card-header flex justify-between items-center">
            <h6 class="card-title">All Materials</h6>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $materials->total() }} total</span>
        </div>

        <!-- Status Filter Tabs -->
        <div class="px-6 py-3 border-b border-gray-200 dark:border-gray-700">
            @php $currentStatus = request('status', ''); @endphp
            <div class="flex items-center gap-2">
                <a href="{{ request()->fullUrlWithQuery(['status' => '']) }}"
                    class="inline-flex items-center px-3 py-1.5 rounded text-xs font-medium {{ $currentStatus === '' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                    All
                </a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'processing']) }}"
                    class="inline-flex items-center px-3 py-1.5 rounded text-xs font-medium {{ $currentStatus === 'processing' ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                    Processing
                </a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'ready']) }}"
                    class="inline-flex items-center px-3 py-1.5 rounded text-xs font-medium {{ $currentStatus === 'ready' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                    Ready
                </a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'failed']) }}"
                    class="inline-flex items-center px-3 py-1.5 rounded text-xs font-medium {{ $currentStatus === 'failed' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                    Failed
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="border-t border-gray-200 dark:border-gray-700 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Uploaded By</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Original File</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Words</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                                <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($materials as $material)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $materials->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200 max-w-xs">
                                        {{ $material->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $material->user?->firstname }} {{ $material->user?->lastname }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        <span class="truncate max-w-[150px] block" title="{{ $material->original_filename ?? $material->file_path }}">
                                            {{ $material->original_filename ?? basename($material->file_path ?? '') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ number_format($material->word_count ?? 0) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $statusBadge = match(strtolower($material->status ?? '')) {
                                                'ready'      => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                'processing' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300',
                                                'failed'     => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                default      => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge }}">
                                            {{ ucfirst($material->status ?? '—') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $material->created_at?->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('admin.materials.show', $material->id) }}"
                                                class="text-primary hover:text-sky-700 text-xs font-medium">View</a>
                                            <form action="{{ route('admin.materials.delete', $material->id) }}" method="POST" class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this material?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No materials found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($materials->hasPages())
                    <div class="py-4 px-4">
                        {{ $materials->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</main>
@endsection
