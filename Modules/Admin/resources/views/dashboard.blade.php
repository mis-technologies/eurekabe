@extends('admin::layouts.app')

@section('title', 'Dashboard')

@section('content')
<main class="flex-grow p-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-50">Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                Welcome back, <span class="font-semibold text-gray-900 dark:text-gray-100">{{ auth()->user()->firstname }}</span>.
                Here's your platform overview.
            </p>
        </div>
        <div class="text-right mt-4 sm:mt-0">
            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ now()->format('l') }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ now()->format('d M Y \a\t H:i') }}</p>
        </div>
    </div>

    {{-- ── KPI Grid ──────────────────────────────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <a href="{{ route('admin.students') }}" class="card group hover:shadow-lg hover:scale-105 transition-all duration-200">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wide mb-2">Students</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-50">{{ number_format($students) }}</p>
                </div>
                <div class="w-14 h-14 flex-shrink-0 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-900/10 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:from-blue-200 dark:group-hover:from-blue-900/50 transition-colors">
                    <i class="mgc_mortarboard_line text-2xl"></i>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.exams.index') }}" class="card group hover:shadow-lg hover:scale-105 transition-all duration-200">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wide mb-2">Exams</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-50">{{ number_format($exams) }}</p>
                </div>
                <div class="w-14 h-14 flex-shrink-0 rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-emerald-900/30 dark:to-emerald-900/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:from-emerald-200 dark:group-hover:from-emerald-900/50 transition-colors">
                    <i class="mgc_book_line text-2xl"></i>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.results.index') }}" class="card group hover:shadow-lg hover:scale-105 transition-all duration-200">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wide mb-2">Attempts</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-50">{{ number_format($results) }}</p>
                </div>
                <div class="w-14 h-14 flex-shrink-0 rounded-xl bg-gradient-to-br from-violet-100 to-violet-50 dark:from-violet-900/30 dark:to-violet-900/10 flex items-center justify-center text-violet-600 dark:text-violet-400 group-hover:from-violet-200 dark:group-hover:from-violet-900/50 transition-colors">
                    <i class="mgc_chart_bar_line text-2xl"></i>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.competitions.index') }}" class="card group hover:shadow-lg hover:scale-105 transition-all duration-200">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wide mb-2">Competitions</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-50">{{ number_format($competitions) }}</p>
                </div>
                <div class="w-14 h-14 flex-shrink-0 rounded-xl bg-gradient-to-br from-yellow-100 to-yellow-50 dark:from-yellow-900/30 dark:to-yellow-900/10 flex items-center justify-center text-yellow-600 dark:text-yellow-400 group-hover:from-yellow-200 dark:group-hover:from-yellow-900/50 transition-colors">
                    <i class="mgc_trophy_line text-2xl"></i>
                </div>
            </div>
        </a>

    </div>

    {{-- ── Secondary KPI Grid ────────────────────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <div class="card group hover:shadow-lg hover:scale-105 transition-all duration-200">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wide mb-2">Questions</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-50">{{ number_format($questions) }}</p>
                </div>
                <div class="w-14 h-14 flex-shrink-0 rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 dark:from-amber-900/30 dark:to-amber-900/10 flex items-center justify-center text-amber-600 dark:text-amber-400">
                    <i class="mgc_list_check_2_line text-2xl"></i>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.schools.index') }}" class="card group hover:shadow-lg hover:scale-105 transition-all duration-200">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wide mb-2">Schools</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-50">{{ number_format($schools) }}</p>
                </div>
                <div class="w-14 h-14 flex-shrink-0 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 dark:from-purple-900/30 dark:to-purple-900/10 flex items-center justify-center text-purple-600 dark:text-purple-400 group-hover:from-purple-200 dark:group-hover:from-purple-900/50 transition-colors">
                    <i class="mgc_school_line text-2xl"></i>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.materials.index') }}" class="card group hover:shadow-lg hover:scale-105 transition-all duration-200">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wide mb-2">Materials</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-50">{{ number_format($materials) }}</p>
                </div>
                <div class="w-14 h-14 flex-shrink-0 rounded-xl bg-gradient-to-br from-teal-100 to-teal-50 dark:from-teal-900/30 dark:to-teal-900/10 flex items-center justify-center text-teal-600 dark:text-teal-400 group-hover:from-teal-200 dark:group-hover:from-teal-900/50 transition-colors">
                    <i class="mgc_document_line text-2xl"></i>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.billing.plans') }}" class="card group hover:shadow-lg hover:scale-105 transition-all duration-200">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wide mb-2">Active Plans</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-50">{{ number_format($active_plans) }}</p>
                </div>
                <div class="w-14 h-14 flex-shrink-0 rounded-xl bg-gradient-to-br from-pink-100 to-pink-50 dark:from-pink-900/30 dark:to-pink-900/10 flex items-center justify-center text-pink-600 dark:text-pink-400 group-hover:from-pink-200 dark:group-hover:from-pink-900/50 transition-colors">
                    <i class="mgc_card_pay_line text-2xl"></i>
                </div>
            </div>
        </a>

    </div>

    {{-- ── Main Content Grid ─────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        {{-- Top Exams (spans 2 cols) --}}
        <div class="lg:col-span-2 card">
            <div class="card-header flex items-center justify-between border-b border-gray-100 dark:border-gray-700">
                <div>
                    <h6 class="card-title">Top Exams by Attempts</h6>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Most attempted exams this period</p>
                </div>
                <a href="{{ route('admin.exams.index') }}" class="text-xs text-primary hover:underline font-semibold">View all →</a>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($top_exams as $exam)
                    <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-emerald-900/30 dark:to-emerald-900/10 flex items-center justify-center">
                                <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400">
                                    #{{ $loop->iteration }}
                                </span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $exam->title }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $exam->school?->name ?? 'General' }}</p>
                        </div>
                        <div class="flex-shrink-0 text-right">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-emerald-50 dark:bg-emerald-900/20">
                                <i class="mgc_chart_bar_line text-sm text-emerald-600 dark:text-emerald-400"></i>
                                <span class="text-sm font-semibold text-emerald-700 dark:text-emerald-300">{{ number_format($exam->exam_results_count) }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center">
                        <i class="mgc_book_line text-4xl text-gray-300 dark:text-gray-600 mb-3 block"></i>
                        <p class="text-gray-600 dark:text-gray-400 font-medium">No exam data yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="card">
            <div class="card-header border-b border-gray-100 dark:border-gray-700">
                <h6 class="card-title">Quick Actions</h6>
            </div>
            <div class="p-4 space-y-2 max-h-96 overflow-y-auto">
                <a href="{{ route('admin.exams.create') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-emerald-50 dark:hover:bg-emerald-900/10 group transition-colors">
                    <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-200 dark:group-hover:bg-emerald-900/50 transition-colors">
                        <i class="mgc_book_line text-base"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Create Exam</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Add new exam</p>
                    </div>
                    <i class="mgc_arrow_right_line text-gray-400 flex-shrink-0"></i>
                </a>

                <a href="{{ route('admin.schools.create') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-purple-50 dark:hover:bg-purple-900/10 group transition-colors">
                    <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400 group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors">
                        <i class="mgc_school_line text-base"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Add School</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Register school</p>
                    </div>
                    <i class="mgc_arrow_right_line text-gray-400 flex-shrink-0"></i>
                </a>

                <a href="{{ route('admin.competitions.create') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-yellow-50 dark:hover:bg-yellow-900/10 group transition-colors">
                    <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-yellow-600 dark:text-yellow-400 group-hover:bg-yellow-200 dark:group-hover:bg-yellow-900/50 transition-colors">
                        <i class="mgc_trophy_line text-base"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">New Competition</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Schedule event</p>
                    </div>
                    <i class="mgc_arrow_right_line text-gray-400 flex-shrink-0"></i>
                </a>

                <a href="{{ route('admin.notifications.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-orange-50 dark:hover:bg-orange-900/10 group transition-colors">
                    <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600 dark:text-orange-400 group-hover:bg-orange-200 dark:group-hover:bg-orange-900/50 transition-colors">
                        <i class="mgc_notification_line text-base"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Send Notification</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Notify users</p>
                    </div>
                    <i class="mgc_arrow_right_line text-gray-400 flex-shrink-0"></i>
                </a>

                <a href="{{ route('admin.billing.adjust') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-pink-50 dark:hover:bg-pink-900/10 group transition-colors">
                    <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center text-pink-600 dark:text-pink-400 group-hover:bg-pink-200 dark:group-hover:bg-pink-900/50 transition-colors">
                        <i class="mgc_transfer_line text-base"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Adjust Credits</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Manual adjustment</p>
                    </div>
                    <i class="mgc_arrow_right_line text-gray-400 flex-shrink-0"></i>
                </a>

                <a href="{{ route('admin.billing.plans') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/10 group transition-colors">
                    <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:bg-blue-200 dark:group-hover:bg-blue-900/50 transition-colors">
                        <i class="mgc_card_pay_line text-base"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Credit Plans</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Manage plans</p>
                    </div>
                    <i class="mgc_arrow_right_line text-gray-400 flex-shrink-0"></i>
                </a>
            </div>
        </div>

    </div>

    {{-- ── Activity Section ──────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent Users --}}
        <div class="card">
            <div class="card-header border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <h6 class="card-title">Recent Users</h6>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Latest account registrations</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="text-xs text-primary hover:underline font-semibold">View all →</a>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700 max-h-80 overflow-y-auto">
                @forelse($recent_users as $user)
                    <div class="flex items-center gap-3 px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <img src="{{ $user->image }}"
                            alt="{{ $user->firstname }}"
                            class="w-10 h-10 rounded-full object-cover flex-shrink-0 border-2 border-gray-200 dark:border-gray-700">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                                {{ $user->firstname }} {{ $user->lastname }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
                        </div>
                        <div class="flex-shrink-0 text-right">
                            @php
                                $badge = match(strtolower($user->role ?? 'student')) {
                                    'admin'    => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                    'advocate' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300',
                                    default    => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $badge }}">
                                {{ ucfirst($user->role ?? 'student') }}
                            </span>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $user->created_at?->diffForHumans(null, true, true) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center">
                        <i class="mgc_user_line text-4xl text-gray-300 dark:text-gray-600 mb-3 block"></i>
                        <p class="text-gray-600 dark:text-gray-400 font-medium">No users yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Recent Students --}}
        <div class="card">
            <div class="card-header border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <div>
                    <h6 class="card-title">Recent Students</h6>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Latest student enrollments</p>
                </div>
                <a href="{{ route('admin.students') }}" class="text-xs text-primary hover:underline font-semibold">View all →</a>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700 max-h-80 overflow-y-auto">
                @forelse($top_students as $student)
                    <div class="flex items-center gap-3 px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <img src="{{ $student->image }}"
                            alt="{{ $student->firstname }}"
                            class="w-10 h-10 rounded-full object-cover flex-shrink-0 border-2 border-gray-200 dark:border-gray-700">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                                {{ $student->firstname }} {{ $student->lastname }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                {{ $student->school?->name ?? 'No school' }}
                            </p>
                        </div>
                        <div class="flex-shrink-0 text-right">
                            @if($student->status == 1)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-600 dark:bg-green-400 mr-1.5"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-1.5"></span>
                                    Inactive
                                </span>
                            @endif
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $student->created_at?->diffForHumans(null, true, true) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center">
                        <i class="mgc_mortarboard_line text-4xl text-gray-300 dark:text-gray-600 mb-3 block"></i>
                        <p class="text-gray-600 dark:text-gray-400 font-medium">No students yet</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</main>
@endsection
