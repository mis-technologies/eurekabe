@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.competitions.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <i class="mgc_arrow_left_line text-xl"></i>
            </a>
            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $competition->name }}</h4>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.competitions.edit', $competition->id) }}" class="btn bg-primary text-white">
                <i class="mgc_edit_line mr-1"></i> Edit
            </a>
            <form action="{{ route('admin.competitions.destroy', $competition->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Are you sure you want to delete this competition?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn bg-danger text-white">
                    <i class="mgc_delete_line mr-1"></i> Delete
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Row -->
    <div class="grid md:grid-cols-2 gap-6 mb-6">
        <div class="card">
            <div class="p-6 flex items-center gap-4">
                <div class="w-12 h-12 flex justify-center items-center rounded text-primary bg-primary/25">
                    <i class="mgc_user_line text-xl"></i>
                </div>
                <div>
                    <h5 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $competition->participants?->count() ?? 0 }}</h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Participants</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="p-6 flex items-center gap-4">
                <div class="w-12 h-12 flex justify-center items-center rounded text-success bg-success/25">
                    <i class="mgc_building_2_line text-xl"></i>
                </div>
                <div>
                    <h5 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $competition->schools?->count() ?? 0 }}</h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Schools</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">

        <!-- Details + Status Update -->
        <div class="lg:col-span-1 space-y-6">

            <!-- Details Card -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Details</h6>
                </div>
                <div class="p-6 space-y-4 text-sm">
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">Status</p>
                        @php
                            $statusBadge = match(strtolower($competition->status ?? '')) {
                                'ongoing'   => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                'upcoming'  => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                'completed' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                                'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                default     => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                            };
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge }}">
                            {{ ucfirst($competition->status ?? '—') }}
                        </span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">Type</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $competition->type ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">Visibility</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ ucfirst($competition->visibility ?? '—') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">Start Date</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $competition->start_date ? \Carbon\Carbon::parse($competition->start_date)->format('d M Y, H:i') : '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">End Date</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $competition->end_date ? \Carbon\Carbon::parse($competition->end_date)->format('d M Y, H:i') : '—' }}</p>
                    </div>
                    @if($competition->description)
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">Description</p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $competition->description }}</p>
                    </div>
                    @endif
                    @if($competition->instruction)
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-medium mb-1">Instructions</p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $competition->instruction }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Status Update Form -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Update Status</h6>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.competitions.status', $competition->id) }}" method="POST">
                        @csrf
                        <div class="flex items-end gap-3">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <select name="status" class="form-select w-full">
                                    <option value="upcoming" {{ $competition->status === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                    <option value="ongoing" {{ $competition->status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ $competition->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $competition->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <button type="submit" class="btn bg-primary text-white">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Right Column: Schools, Exams, Participants -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Schools -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Schools ({{ $competition->schools?->count() ?? 0 }})</h6>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">School Name</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($competition->schools ?? [] as $school)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $school->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-6 text-center text-sm text-gray-500 dark:text-gray-400">No schools attached.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Exams -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Exams ({{ $competition->exams?->count() ?? 0 }})</h6>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Exam Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Questions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($competition->exams ?? [] as $exam)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $exam->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $exam->duration ?? '—' }} min</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $exam->questions_count ?? $exam->questions?->count() ?? 0 }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-500 dark:text-gray-400">No exams attached.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Participants -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Participants ({{ $competition->participants?->count() ?? 0 }})</h6>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($competition->participants ?? [] as $participant)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $participant->user?->firstname ?? $participant->firstname ?? '' }} {{ $participant->user?->lastname ?? $participant->lastname ?? '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $participant->user?->email ?? $participant->email ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $participant->created_at?->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-500 dark:text-gray-400">No participants yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</main>
@endsection
