@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <i class="mgc_arrow_left_line text-xl"></i>
            </a>
            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">User Detail</h4>
        </div>
        <a href="{{ route('admin.users.delete', $user->id) }}"
            onclick="return confirm('Are you sure you want to delete this user? This cannot be undone.')"
            class="btn bg-danger text-white">
            <i class="mgc_delete_line mr-1"></i> Delete User
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

    <div class="grid lg:grid-cols-3 gap-6">

        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Profile</h6>
                </div>
                <div class="p-6">
                    <div class="flex flex-col items-center text-center mb-6">
                        @if($user->image)
                            <img src="{{ $user->image }}" alt="{{ $user->firstname }}"
                                class="w-20 h-20 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700 mb-3">
                        @else
                            <div class="w-20 h-20 rounded-full bg-primary/20 flex items-center justify-center mb-3">
                                <i class="mgc_user_line text-3xl text-primary"></i>
                            </div>
                        @endif
                        <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            {{ $user->firstname }} {{ $user->lastname }}
                        </h5>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $user->email }}</p>
                        @php
                            $roleBadge = match(strtolower($user->role ?? '')) {
                                'admin'    => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                'advocate' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
                                default    => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                            };
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $roleBadge }}">
                            {{ ucfirst($user->role ?? 'student') }}
                        </span>
                    </div>

                    <div class="space-y-3 text-sm">
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                            <i class="mgc_phone_line w-4"></i>
                            <span>{{ $user->phone ?? '—' }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                            <i class="mgc_user_line w-4"></i>
                            <span>{{ ucfirst($user->gender ?? '—') }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                            <i class="mgc_building_2_line w-4"></i>
                            <span>{{ $user->school?->name ?? '—' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="mgc_round_fill w-4 text-xs {{ $user->status == 1 ? 'text-green-500' : 'text-red-500' }}"></i>
                            <span class="{{ $user->status == 1 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                            <i class="mgc_calendar_line w-4"></i>
                            <span>Joined {{ $user->created_at?->format('d M Y') }}</span>
                        </div>
                        @if($user->last_seen_at ?? $user->updated_at)
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                            <i class="mgc_alarm_2_line w-4"></i>
                            <span>Last seen {{ ($user->last_seen_at ?? $user->updated_at)?->diffForHumans() }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Credit Account Card -->
            @if($user->creditAccount)
            <div class="card mt-6">
                <div class="card-header">
                    <h6 class="card-title">Credit Account</h6>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Plan</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $user->creditAccount->plan?->name ?? '—' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Balance</span>
                        <span class="font-semibold text-primary">{{ number_format($user->creditAccount->balance ?? 0) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Monthly Allowance</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ number_format($user->creditAccount->plan?->monthly_credits ?? 0) }}</span>
                    </div>
                    @if($user->creditAccount->next_reset_at)
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Next Reset</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $user->creditAccount->next_reset_at?->format('d M Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Edit Form Card -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Edit User</h6>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                                <select name="role" class="form-select w-full" required>
                                    <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                                    <option value="advocate" {{ $user->role === 'advocate' ? 'selected' : '' }}>Advocate</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <select name="status" class="form-select w-full" required>
                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">School</label>
                                <select name="school_id" class="form-select w-full">
                                    <option value="">— No School —</option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}" {{ $user->school_id == $school->id ? 'selected' : '' }}>
                                            {{ $school->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn bg-primary text-white">
                                <i class="mgc_save_line mr-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Recent Exam Attempts -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Recent Exam Attempts</h6>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Exam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($user->studentExams->take(10) as $attempt)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $attempt->exam?->title ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $statusBadge = match(strtolower($attempt->status ?? '')) {
                                                'passed'    => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                'failed'    => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                'submitted' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                default     => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge }}">
                                            {{ ucfirst($attempt->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $attempt->score ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $attempt->created_at?->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                        No exam attempts yet.
                                    </td>
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
