@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.materials.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <i class="mgc_arrow_left_line text-xl"></i>
            </a>
            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Material Detail</h4>
        </div>
        <form action="{{ route('admin.materials.delete', $material->id) }}" method="POST" class="inline"
            onsubmit="return confirm('Are you sure you want to delete this material? This cannot be undone.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn bg-danger text-white">
                <i class="mgc_delete_line mr-1"></i> Delete Material
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-6">

        <!-- Info Card -->
        <div class="lg:col-span-1 space-y-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Material Info</h6>
                </div>
                <div class="p-6 space-y-4 text-sm">
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">Title</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $material->title }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">Uploaded By</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $material->user?->firstname }} {{ $material->user?->lastname }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $material->user?->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">Original File</p>
                        <p class="text-gray-700 dark:text-gray-300 break-all">{{ $material->original_filename ?? basename($material->file_path ?? '—') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">Word Count</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ number_format($material->word_count ?? 0) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">Status</p>
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
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">Created</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $material->created_at?->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Stats</h6>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 dark:text-gray-400">Questions Generated</span>
                        <span class="font-semibold text-gray-800 dark:text-gray-200">
                            {{ $material->questions_count ?? $material->questions?->count() ?? 0 }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 dark:text-gray-400">Resources</span>
                        <span class="font-semibold text-gray-800 dark:text-gray-200">
                            {{ $material->resources_count ?? $material->resources?->count() ?? 0 }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="lg:col-span-2">
            @if($material->summary)
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Summary</h6>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ Str::limit($material->summary, 300) }}</p>
                    @if(strlen($material->summary) > 300)
                        <details class="mt-3">
                            <summary class="text-primary text-sm cursor-pointer hover:underline">Show full summary</summary>
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap mt-3">{{ $material->summary }}</p>
                        </details>
                    @endif
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Summary</h6>
                </div>
                <div class="p-6 text-center text-sm text-gray-500 dark:text-gray-400">
                    No summary available yet.
                    @if($material->status === 'processing')
                        <p class="mt-1 text-xs">This material is still being processed.</p>
                    @endif
                </div>
            </div>
            @endif
        </div>

    </div>

</main>
@endsection
