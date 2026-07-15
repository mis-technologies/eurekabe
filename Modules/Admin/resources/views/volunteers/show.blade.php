@extends('admin::layouts.app')

@section('content')
    <main class="flex-grow p-6">

        <!-- Page Title Start -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">Volunteer Application Details</h4>
                <a href="{{ route('admin.volunteers') }}" class="text-sm text-primary hover:underline">← Back to all applications</a>
            </div>
            <div class="flex gap-2">
                @if($volunteer->status != 'approved')
                    <form action="{{ route('admin.volunteers.update-status', $volunteer->id) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="btn bg-green-500 text-white hover:bg-green-600"
                                onclick="return confirm('Approve this application?')">
                            Approve
                        </button>
                    </form>
                @endif
                
                @if($volunteer->status != 'rejected')
                    <form action="{{ route('admin.volunteers.update-status', $volunteer->id) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn bg-red-500 text-white hover:bg-red-600"
                                onclick="return confirm('Reject this application?')">
                            Reject
                        </button>
                    </form>
                @endif
            </div>
        </div>
        <!-- Page Title End -->

        <div class="grid lg:grid-cols-2 gap-6">
            <!-- Personal Information -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Personal Information</h6>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500 dark:text-gray-400">Full Name</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $volunteer->firstname }} {{ $volunteer->lastname }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500 dark:text-gray-400">Email</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $volunteer->email }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500 dark:text-gray-400">Phone</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $volunteer->phone }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500 dark:text-gray-400">University</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $volunteer->university ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500 dark:text-gray-400">Course</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $volunteer->course ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Application Date</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $volunteer->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Status -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Application Status</h6>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500 dark:text-gray-400">Status</span>
                            <span>
                                @if($volunteer->status == 'approved')
                                    <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">Approved</span>
                                @elseif($volunteer->status == 'rejected')
                                    <span class="bg-red-100 text-red-800 text-sm px-3 py-1 rounded-full">Rejected</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full">Pending</span>
                                @endif
                            </span>
                        </div>
                        @if($volunteer->reviewed_at)
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500 dark:text-gray-400">Reviewed At</span>
                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $volunteer->reviewed_at->format('M d, Y h:i A') }}</span>
                            </div>
                        @endif
                        
                        <div>
                            <span class="text-gray-500 dark:text-gray-400 block mb-2">Skills</span>
                            <div class="flex flex-wrap gap-2">
                                @if($volunteer->skills)
                                    @foreach($volunteer->skills as $skill)
                                        <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                                            {{ ucwords(str_replace('_', ' ', $skill)) }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-gray-400">No skills listed</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Motivation -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Motivation</h6>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $volunteer->motivation }}</p>
                </div>
            </div>

            <!-- Experience -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Previous Experience</h6>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $volunteer->experience ?? 'No experience provided.' }}</p>
                </div>
            </div>
        </div>
    </main>
@endsection
