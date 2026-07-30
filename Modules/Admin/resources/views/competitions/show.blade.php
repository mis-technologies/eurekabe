@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    {{-- Header --}}
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
            <a href="{{ route('admin.competitions.delete', $competition->id) }}"
                onclick="return confirm('Are you sure you want to delete this competition?')"
                class="btn bg-danger text-white">
                <i class="mgc_delete_line mr-1"></i> Delete
            </a>
        </div>
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

    {{-- Stats --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="card p-5 flex items-center gap-4">
            <div class="w-11 h-11 flex items-center justify-center rounded-lg text-primary bg-primary/10 flex-shrink-0">
                <i class="mgc_user_line text-xl"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $competition->participants->count() }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Participants</div>
            </div>
        </div>
        <div class="card p-5 flex items-center gap-4">
            <div class="w-11 h-11 flex items-center justify-center rounded-lg text-success bg-success/10 flex-shrink-0">
                <i class="mgc_building_2_line text-xl"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $competition->schools->count() }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Schools</div>
            </div>
        </div>
        <div class="card p-5 flex items-center gap-4">
            <div class="w-11 h-11 flex items-center justify-center rounded-lg text-warning bg-warning/10 flex-shrink-0">
                <i class="mgc_clipboard_line text-xl"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $competition->exams->count() }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Exams</div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- ── Left column ── --}}
        <div class="lg:col-span-1 space-y-6">

            {{-- Details --}}
            <div class="card">
                <div class="card-header"><h6 class="card-title">Details</h6></div>
                <div class="p-5 space-y-4 text-sm">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Status</p>
                        @php
                            $badge = match(strtolower($competition->status ?? '')) {
                                'ongoing'   => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                'upcoming'  => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                'completed' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                                'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                default     => 'bg-gray-100 text-gray-600',
                            };
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $badge }}">
                            {{ ucfirst($competition->status ?? '—') }}
                        </span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Visibility</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ ucfirst($competition->visibility ?? '—') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Type</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $competition->type ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Start Date</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $competition->start_date?->format('d M Y, H:i') ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold mb-1">End Date</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $competition->end_date?->format('d M Y, H:i') ?? '—' }}</p>
                    </div>
                    @if($competition->description)
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Description</p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $competition->description }}</p>
                    </div>
                    @endif
                    @if($competition->instruction)
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Instructions</p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $competition->instruction }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Update Status --}}
            <div class="card">
                <div class="card-header"><h6 class="card-title">Update Status</h6></div>
                <div class="p-5">
                    <form action="{{ route('admin.competitions.status', $competition->id) }}" method="POST">
                        @csrf
                        <div class="flex items-end gap-3">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <select name="status" class="form-select w-full">
                                    @foreach(['upcoming','ongoing','completed','cancelled'] as $s)
                                        <option value="{{ $s }}" {{ $competition->status === $s ? 'selected' : '' }}>
                                            {{ ucfirst($s) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn bg-primary text-white">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        {{-- ── Right column ── --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- ── Exams ── --}}
            <div class="card">
                <div class="card-header flex justify-between items-center">
                    <h6 class="card-title">Exams ({{ $competition->exams->count() }})</h6>
                    <button type="button"
                        onclick="document.getElementById('addExamForm').classList.toggle('hidden')"
                        class="btn bg-primary text-white text-xs py-1 px-3">
                        <i class="mgc_add_line mr-1"></i> Add Exam
                    </button>
                </div>

                {{-- Add exam form (hidden by default) --}}
                <div id="addExamForm" class="hidden border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 p-5">
                    <form action="{{ route('admin.competitions.exams.add', $competition->id) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
                            <div class="md:col-span-1">
                                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Exam</label>
                                <select name="exam_id" class="form-select w-full text-sm" required>
                                    <option value="">— Select exam —</option>
                                    @foreach($availableExams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                                    @endforeach
                                </select>
                                @if($availableExams->isEmpty())
                                    <p class="text-xs text-gray-400 mt-1">All exams already attached.</p>
                                @endif
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Duration (min) <span class="text-gray-400 font-normal">optional</span></label>
                                <input type="number" name="duration" min="1" class="form-input w-full text-sm" placeholder="e.g. 60">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Total Questions <span class="text-gray-400 font-normal">optional</span></label>
                                <input type="number" name="total_questions" min="1" class="form-input w-full text-sm" placeholder="e.g. 40">
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="btn bg-primary text-white text-xs py-1.5 px-3">Attach Exam</button>
                            <button type="button"
                                onclick="document.getElementById('addExamForm').classList.add('hidden')"
                                class="btn bg-gray-200 text-gray-700 text-xs py-1.5 px-3">Cancel</button>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Exam</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Questions</th>
                                <th class="px-4 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($competition->exams as $exam)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $exam->title }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        {{ $exam->pivot->duration ?? $exam->duration ?? '—' }}
                                        @if($exam->pivot->duration) <span class="text-gray-400 text-xs">min</span> @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        {{ $exam->pivot->total_questions ?? '—' }}
                                    </td>
                                    <td class="px-4 py-3 text-end">
                                        <a href="{{ route('admin.competitions.exams.remove', [$competition->id, $exam->id]) }}"
                                            onclick="return confirm('Remove this exam from the competition?')"
                                            class="text-red-500 hover:text-red-700 text-xs font-medium">Remove</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-400">
                                        No exams attached. Click <strong>Add Exam</strong> above.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ── Schools (collapsible) ── --}}
            <div class="card">
                <div class="card-header flex justify-between items-center">
                    <h6 class="card-title">Schools ({{ $competition->schools->count() }})</h6>
                    <button type="button" data-collapse-toggle="schoolsList"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-transform duration-200">
                        <i class="mgc_down_line text-lg"></i>
                    </button>
                </div>
                <div id="schoolsList" class="hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase w-12">#</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">School Name</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($competition->schools as $school)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $school->name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-4 py-6 text-center text-sm text-gray-400">No schools attached.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ── Broadcast Notification ── --}}
            <div class="card border-blue-200 dark:border-blue-900/50">
                <div class="card-header bg-blue-50 dark:bg-blue-900/20">
                    <h6 class="card-title flex items-center gap-2">
                        <i class="mgc_notification_line text-blue-600"></i>
                        Send Broadcast Message
                    </h6>
                </div>
                <div class="p-5 space-y-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Send a custom notification to participants or eligible students about this competition.
                    </p>

                    <form action="{{ route('admin.competitions.broadcast', $competition->id) }}" method="POST" id="broadcastForm">
                        @csrf

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Notification Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" placeholder="e.g., Competition Reminder"
                                    class="form-input w-full text-sm" maxlength="255" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Message <span class="text-red-500">*</span>
                                </label>
                                <textarea name="message" placeholder="Write your message here..." rows="4"
                                    class="form-textarea w-full text-sm" maxlength="1000" required></textarea>
                                <p class="text-xs text-gray-400 mt-1">Max 1000 characters</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Send to <span class="text-red-500">*</span>
                                </label>
                                <div class="space-y-2">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="segment" value="all_participants" checked class="form-radio">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">
                                            All Participants <span class="text-gray-500">({{ $competition->participants->count() }} users)</span>
                                        </span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="segment" value="schools" class="form-radio">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">
                                            Students in Competition Schools <span class="text-gray-500">({{ $competition->schools->count() }} schools)</span>
                                        </span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="segment" value="all_eligible" class="form-radio">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">
                                            All Eligible Students
                                            <span class="text-gray-500">
                                                ({{ $competition->visibility === 'public' ? 'all public' : 'school-scoped' }})
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="flex gap-3 pt-2">
                                <button type="submit" class="btn bg-blue-600 text-white hover:bg-blue-700 text-sm">
                                    <i class="mgc_send_line mr-1"></i> Send Message
                                </button>
                                <button type="reset" class="btn bg-gray-200 text-gray-700 hover:bg-gray-300 text-sm">
                                    Clear
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── Participants ── --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Participants ({{ $competition->participants->count() }})</h6>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paid</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($competition->participants as $p)
                                @php
                                    $pBadge = match(strtolower($p->status ?? '')) {
                                        'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                        'pending'   => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                        'disqualified' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                        default     => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                                    };
                                @endphp
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ trim(($p->user?->firstname ?? '') . ' ' . ($p->user?->lastname ?? '')) ?: ($p->user?->name ?? '—') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $p->user?->email ?? '—' }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $p->score ?? 0 }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $pBadge }}">
                                            {{ ucfirst($p->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if($p->isPaid)
                                            <span class="inline-flex items-center gap-1 text-green-600 text-xs font-medium">
                                                <i class="mgc_check_line"></i> Yes
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs">No</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                        {{ $p->created_at?->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-400">No participants yet.</td>
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

@push('scripts')
<script>
    // Lightweight collapse for schools — no Alpine required
    document.querySelectorAll('[data-collapse-toggle]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var target = document.getElementById(btn.dataset.collapseToggle);
            if (target) target.classList.toggle('hidden');
            btn.classList.toggle('rotate-180');
        });
    });
</script>
@endpush
