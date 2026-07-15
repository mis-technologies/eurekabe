@extends('admin::layouts.app')

@section('title', 'Dashboard')

@section('content')
<main class="flex-grow p-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Dashboard</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                Welcome back, <span class="font-medium text-gray-700 dark:text-gray-300">{{ auth()->user()->firstname }}</span>.
                Here's what's happening.
            </p>
        </div>
        <div class="text-right hidden sm:block">
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ now()->format('l') }}</p>
            <p class="text-xs text-gray-400 dark:text-gray-500">{{ now()->format('d M Y') }}</p>
        </div>
    </div>

    {{-- ── KPI Row 1 ──────────────────────────────────── --}}
    <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-4 mb-4">

        <a href="{{ route('admin.students') }}" class="card group hover:shadow-md transition-shadow">
            <div class="p-5 flex items-center gap-4">
                <div class="w-12 h-12 flex-shrink-0 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:bg-blue-200 dark:group-hover:bg-blue-900/50 transition-colors">
                    <i class="mgc_mortarboard_line text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">Students</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 leading-tight">{{ number_format($students) }}</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.exams.index') }}" class="card group hover:shadow-md transition-shadow">
            <div class="p-5 flex items-center gap-4">
                <div class="w-12 h-12 flex-shrink-0 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-200 dark:group-hover:bg-emerald-900/50 transition-colors">
                    <i class="mgc_book_line text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">Exams</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 leading-tight">{{ number_format($exams) }}</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.results.index') }}" class="card group hover:shadow-md transition-shadow">
            <div class="p-5 flex items-center gap-4">
                <div class="w-12 h-12 flex-shrink-0 rounded-lg bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center text-violet-600 dark:text-violet-400 group-hover:bg-violet-200 dark:group-hover:bg-violet-900/50 transition-colors">
                    <i class="mgc_chart_bar_line text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">Attempts</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 leading-tight">{{ number_format($results) }}</p>
                </div>
            </div>
        </a>

        <div class="card">
            <div class="p-5 flex items-center gap-4">
                <div class="w-12 h-12 flex-shrink-0 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 dark:text-amber-400">
                    <i class="mgc_list_check_2_line text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">Questions</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 leading-tight">{{ number_format($questions) }}</p>
                </div>
            </div>
        </div>

    </div>

    {{-- ── KPI Row 2 ──────────────────────────────────── --}}
    <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-4 mb-6">

        <a href="{{ route('admin.schools.index') }}" class="card group hover:shadow-md transition-shadow">
            <div class="p-5 flex items-center gap-4">
                <div class="w-12 h-12 flex-shrink-0 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400 group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors">
                    <i class="mgc_school_line text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">Schools</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 leading-tight">{{ number_format($schools) }}</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.competitions.index') }}" class="card group hover:shadow-md transition-shadow">
            <div class="p-5 flex items-center gap-4">
                <div class="w-12 h-12 flex-shrink-0 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-yellow-600 dark:text-yellow-400 group-hover:bg-yellow-200 dark:group-hover:bg-yellow-900/50 transition-colors">
                    <i class="mgc_trophy_line text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">Competitions</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 leading-tight">{{ number_format($competitions) }}</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.materials.index') }}" class="card group hover:shadow-md transition-shadow">
            <div class="p-5 flex items-center gap-4">
                <div class="w-12 h-12 flex-shrink-0 rounded-lg bg-teal-100 dark:bg-teal-900/30 flex items-center justify-center text-teal-600 dark:text-teal-400 group-hover:bg-teal-200 dark:group-hover:bg-teal-900/50 transition-colors">
                    <i class="mgc_document_line text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">Materials</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 leading-tight">{{ number_format($materials) }}</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.billing.plans') }}" class="card group hover:shadow-md transition-shadow">
            <div class="p-5 flex items-center gap-4">
                <div class="w-12 h-12 flex-shrink-0 rounded-lg bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center text-pink-600 dark:text-pink-400 group-hover:bg-pink-200 dark:group-hover:bg-pink-900/50 transition-colors">
                    <i class="mgc_card_pay_line text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-wide">Active Plans</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 leading-tight">{{ number_format($active_plans) }}</p>
                </div>
            </div>
        </a>

    </div>

    {{-- ── Main Content ──────────────────────────────── --}}
    <div class="grid xl:grid-cols-3 gap-5">

        {{-- Top Exams (spans 2 cols) --}}
        <div class="card xl:col-span-2">
            <div class="card-header flex items-center justify-between">
                <h6 class="card-title">Top Exams by Attempts</h6>
                <a href="{{ route('admin.exams.index') }}" class="text-xs text-primary hover:underline font-medium">View all →</a>
            </div>
            @forelse($top_exams as $exam)
                <div class="flex items-center gap-4 px-5 py-3 border-b border-gray-100 dark:border-gray-700 last:border-0 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                    <span class="w-6 text-xs font-bold {{ $loop->iteration === 1 ? 'text-amber-500' : ($loop->iteration === 2 ? 'text-gray-400' : 'text-orange-400') }} flex-shrink-0 text-center">
                        #{{ $loop->iteration }}
                    </span>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate">{{ $exam->title }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $exam->school?->name ?? 'General' }}</p>
                    </div>
                    <div class="flex-shrink-0 text-right">
                        <span class="inline-flex items-center gap-1 text-xs font-semibold {{ $exam->exam_results_count > 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-400' }}">
                            <i class="mgc_chart_bar_line text-sm"></i>
                            {{ number_format($exam->exam_results_count) }}
                        </span>
                        <p class="text-xs text-gray-400 dark:text-gray-500">attempts</p>
                    </div>
                </div>
            @empty
                <div class="px-5 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                    <i class="mgc_book_line text-3xl mb-2 block opacity-30"></i>
                    No exam data yet.
                </div>
            @endforelse
        </div>

        {{-- Quick Actions (1 col) --}}
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Quick Actions</h6>
            </div>
            <div class="p-4 space-y-2">
                <a href="{{ route('admin.exams.create') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-emerald-50 dark:hover:bg-emerald-900/10 group transition-colors">
                    <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-200 dark:group-hover:bg-emerald-900/50 transition-colors">
                        <i class="mgc_book_line text-base"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Create Exam</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Add a new exam</p>
                    </div>
                    <i class="mgc_arrow_right_line text-gray-400 ms-auto flex-shrink-0"></i>
                </a>

                <a href="{{ route('admin.schools.create') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-purple-50 dark:hover:bg-purple-900/10 group transition-colors">
                    <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400 group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors">
                        <i class="mgc_school_line text-base"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Add School</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Register a school</p>
                    </div>
                    <i class="mgc_arrow_right_line text-gray-400 ms-auto flex-shrink-0"></i>
                </a>

                <a href="{{ route('admin.competitions.create') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-yellow-50 dark:hover:bg-yellow-900/10 group transition-colors">
                    <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-yellow-600 dark:text-yellow-400 group-hover:bg-yellow-200 dark:group-hover:bg-yellow-900/50 transition-colors">
                        <i class="mgc_trophy_line text-base"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">New Competition</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Schedule a competition</p>
                    </div>
                    <i class="mgc_arrow_right_line text-gray-400 ms-auto flex-shrink-0"></i>
                </a>

                <a href="{{ route('admin.notifications.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-orange-50 dark:hover:bg-orange-900/10 group transition-colors">
                    <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600 dark:text-orange-400 group-hover:bg-orange-200 dark:group-hover:bg-orange-900/50 transition-colors">
                        <i class="mgc_notification_line text-base"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Send Notification</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Notify all users</p>
                    </div>
                    <i class="mgc_arrow_right_line text-gray-400 ms-auto flex-shrink-0"></i>
                </a>

                <a href="{{ route('admin.billing.adjust') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-pink-50 dark:hover:bg-pink-900/10 group transition-colors">
                    <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center text-pink-600 dark:text-pink-400 group-hover:bg-pink-200 dark:group-hover:bg-pink-900/50 transition-colors">
                        <i class="mgc_transfer_line text-base"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Adjust Credits</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Manual credit change</p>
                    </div>
                    <i class="mgc_arrow_right_line text-gray-400 ms-auto flex-shrink-0"></i>
                </a>

                <a href="{{ route('admin.billing.plans') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/10 group transition-colors">
                    <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:bg-blue-200 dark:group-hover:bg-blue-900/50 transition-colors">
                        <i class="mgc_card_pay_line text-base"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Credit Plans</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Manage subscriptions</p>
                    </div>
                    <i class="mgc_arrow_right_line text-gray-400 ms-auto flex-shrink-0"></i>
                </a>
            </div>
        </div>

    </div>

    {{-- ── Recent Activity Row ────────────────────────── --}}
    <div class="grid xl:grid-cols-2 gap-5 mt-5">

        {{-- Recent Users --}}
        <div class="card">
            <div class="card-header flex items-center justify-between">
                <h6 class="card-title">Recent Users</h6>
                <a href="{{ route('admin.users.index') }}" class="text-xs text-primary hover:underline font-medium">View all →</a>
            </div>
            @forelse($recent_users as $user)
                <div class="flex items-center gap-3 px-5 py-3 border-b border-gray-100 dark:border-gray-700 last:border-0">
                    <img src="{{ $user->image }}"
                        alt="{{ $user->firstname }}"
                        class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate">
                            {{ $user->firstname }} {{ $user->lastname }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
                    </div>
                    <div class="flex-shrink-0 flex flex-col items-end gap-1">
                        @php
                            $badge = match(strtolower($user->role ?? 'student')) {
                                'admin'    => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                'advocate' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300',
                                default    => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                            };
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $badge }}">
                            {{ ucfirst($user->role ?? 'student') }}
                        </span>
                        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $user->created_at?->diffForHumans(null, true, true) }}</p>
                    </div>
                </div>
            @empty
                <div class="px-5 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                    <i class="mgc_user_line text-3xl mb-2 block opacity-30"></i>
                    No users yet.
                </div>
            @endforelse
        </div>

        {{-- Recent Students --}}
        <div class="card">
            <div class="card-header flex items-center justify-between">
                <h6 class="card-title">Recent Students</h6>
                <a href="{{ route('admin.students') }}" class="text-xs text-primary hover:underline font-medium">View all →</a>
            </div>
            @forelse($top_students as $student)
                <div class="flex items-center gap-3 px-5 py-3 border-b border-gray-100 dark:border-gray-700 last:border-0">
                    <img src="{{ $student->image }}"
                        alt="{{ $student->firstname }}"
                        class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate">
                            {{ $student->firstname }} {{ $student->lastname }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                            {{ $student->school?->name ?? 'No school assigned' }}
                        </p>
                    </div>
                    <div class="flex-shrink-0 flex flex-col items-end gap-1">
                        @if($student->status == 1)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300">Active</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400">Inactive</span>
                        @endif
                        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $student->created_at?->diffForHumans(null, true, true) }}</p>
                    </div>
                </div>
            @empty
                <div class="px-5 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                    <i class="mgc_mortarboard_line text-3xl mb-2 block opacity-30"></i>
                    No students yet.
                </div>
            @endforelse
        </div>

    </div>

</main>
@endsection
