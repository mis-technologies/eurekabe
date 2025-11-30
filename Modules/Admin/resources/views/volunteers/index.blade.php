@extends('admin::layouts.app')
@include('admin::partials.znotify')

@section('content')
    <main class="flex-grow p-6">

        <!-- Page Title Start -->
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">Volunteer Applications</h4>
        </div>
        <!-- Page Title End -->

        <div class="col-span-3">
            <div class="card">
                <div class="card-header flex justify-between">
                    <h6 class="card-title">All Volunteer Applications</h6>
                    <span class="text-sm text-gray-500">Total: {{ $volunteers->count() }}</span>
                </div>
                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                            <div class="py-3 px-4">
                                <div class="relative max-w-xs">
                                    <label for="table-with-pagination-search" class="sr-only">Search</label>
                                    <input type="text" name="table-with-pagination-search"
                                        id="table-with-pagination-search" class="form-input ps-11"
                                        placeholder="Search for items">
                                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                                        <svg class="h-3.5 w-3.5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                No</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Name</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Email</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Phone</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Skills</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Status</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Date</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse ($volunteers as $volunteer)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $loop->index + 1 }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $volunteer->firstname }} {{ $volunteer->lastname }}
                                                    @if($volunteer->university)
                                                        <br><span class="text-xs text-gray-500">{{ $volunteer->university }}</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $volunteer->email }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $volunteer->phone }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                                    @if($volunteer->skills)
                                                        @foreach($volunteer->skills as $skill)
                                                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded mb-1">
                                                                {{ ucwords(str_replace('_', ' ', $skill)) }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        <span class="text-gray-400">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                    @if($volunteer->status == 'approved')
                                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Approved</span>
                                                    @elseif($volunteer->status == 'rejected')
                                                        <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded">Rejected</span>
                                                    @else
                                                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Pending</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $volunteer->created_at->format('M d, Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                    <a href="{{ route('admin.volunteers.show', $volunteer->id) }}" 
                                                       class="text-primary hover:text-sky-700 mr-3">View</a>
                                                    
                                                    @if($volunteer->status != 'approved')
                                                        <form action="{{ route('admin.volunteers.update-status', $volunteer->id) }}" 
                                                              method="POST" class="inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="approved">
                                                            <button type="submit" class="text-green-600 hover:text-green-800 mr-2"
                                                                    onclick="return confirm('Approve this application?')">
                                                                Approve
                                                            </button>
                                                        </form>
                                                    @endif
                                                    
                                                    @if($volunteer->status != 'rejected')
                                                        <form action="{{ route('admin.volunteers.update-status', $volunteer->id) }}" 
                                                              method="POST" class="inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit" class="text-red-600 hover:text-red-800"
                                                                    onclick="return confirm('Reject this application?')">
                                                                Reject
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                    No volunteer applications found.
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
    </main>
@endsection
