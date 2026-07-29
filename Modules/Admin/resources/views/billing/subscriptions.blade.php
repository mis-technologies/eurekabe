@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Subscriptions</h4>
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
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-green-600">{{ $stats['active'] }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Active</div>
        </div>
        <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-amber-500">{{ $stats['expiring_soon'] }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Expiring &lt;7d</div>
        </div>
        <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-blue-500">{{ $stats['with_card'] }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Card Stored</div>
        </div>
        <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-gray-500">{{ $stats['cancelled'] }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Cancelled</div>
        </div>
        <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-red-500">{{ $stats['expired'] }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Expired</div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card mb-4 p-4">
        <form method="GET" action="{{ route('admin.billing.subscriptions') }}" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Status</label>
                <select name="status" class="form-select text-sm" onchange="this.form.submit()">
                    <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All</option>
                    <option value="active"    {{ request('status') === 'active'    ? 'selected' : '' }}>Active</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="expired"   {{ request('status') === 'expired'   ? 'selected' : '' }}>Expired</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Plan</label>
                <select name="plan_id" class="form-select text-sm" onchange="this.form.submit()">
                    <option value="">All Plans</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}" {{ request('plan_id') == $plan->id ? 'selected' : '' }}>
                            {{ $plan->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex-grow min-w-[200px]">
                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Search user</label>
                <div class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or email…"
                        class="form-input text-sm flex-grow">
                    <button type="submit" class="btn bg-primary text-white text-sm px-3 py-1.5">Search</button>
                    @if(request()->hasAny(['status', 'plan_id', 'search']))
                        <a href="{{ route('admin.billing.subscriptions') }}" class="btn bg-gray-200 text-gray-700 text-sm px-3 py-1.5">Clear</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h6 class="card-title">All Subscriptions</h6>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $subscriptions->total() }} total</span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Started</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Expires</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Card</th>
                        <th class="px-4 py-3 text-end text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($subscriptions as $sub)
                        @php
                            $user = $sub->user;
                            $plan = $sub->plan;
                            $storedCard = \Modules\Common\Models\Payment::where('user_id', $sub->user_id)
                                ->where('status', 'success')
                                ->whereNotNull('authorization_code')
                                ->exists();
                            $expiringWarning = $sub->status === 'active'
                                && $sub->expires_at
                                && $sub->expires_at->isBefore(now()->addDays(7));
                        @endphp
                        <tr class="{{ $expiringWarning ? 'bg-amber-50 dark:bg-amber-900/10' : '' }}">
                            <td class="px-4 py-3 text-sm">
                                @if($user)
                                    <div class="font-medium text-gray-800 dark:text-gray-200">
                                        {{ trim(($user->firstname ?? '') . ' ' . ($user->lastname ?? '')) ?: ($user->name ?? 'User #'.$user->id) }}
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                @else
                                    <span class="text-gray-400 italic text-xs">Deleted user</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">
                                {{ $plan?->name ?? '—' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @php
                                    $badge = match($sub->status) {
                                        'active'    => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                        'cancelled' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                                        'expired'   => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                        default     => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $badge }}">
                                    {{ ucfirst($sub->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                {{ $sub->started_at?->format('d M Y') ?? '—' }}
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                @if($sub->expires_at)
                                    <span class="{{ $expiringWarning ? 'text-amber-600 font-semibold' : 'text-gray-500 dark:text-gray-400' }}">
                                        {{ $sub->expires_at->format('d M Y') }}
                                        @if($expiringWarning)
                                            <span class="text-xs ml-1">(soon)</span>
                                        @endif
                                    </span>
                                @else
                                    <span class="text-gray-400 italic text-xs">Not set</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                @if($storedCard)
                                    <span class="inline-flex items-center gap-1 text-green-600 text-xs font-medium">
                                        <i class="mgc_check_line"></i> Yes
                                    </span>
                                @else
                                    <span class="text-gray-400 text-xs">No</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-end text-sm">
                                <div class="flex items-center justify-end gap-2 flex-wrap">

                                    {{-- Force Renew --}}
                                    @if($sub->status === 'active' && $storedCard)
                                        <form action="{{ route('admin.billing.subscriptions.force-renew', $sub->id) }}" method="POST"
                                            onsubmit="return confirm('Force-charge the stored card now for {{ $user?->email }}?')">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:text-blue-800 text-xs font-medium whitespace-nowrap">
                                                Force Renew
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Extend --}}
                                    <button type="button"
                                        onclick="document.getElementById('extend-modal-{{ $sub->id }}').classList.remove('hidden')"
                                        class="text-amber-600 hover:text-amber-800 text-xs font-medium whitespace-nowrap">
                                        Extend
                                    </button>

                                    {{-- Cancel --}}
                                    @if($sub->status === 'active')
                                        <form action="{{ route('admin.billing.subscriptions.cancel', $sub->id) }}" method="POST"
                                            onsubmit="return confirm('Cancel this subscription and downgrade {{ $user?->email }} to the free plan?')">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium whitespace-nowrap">
                                                Cancel
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        {{-- Extend Modal (inline hidden row) --}}
                        <tr id="extend-modal-{{ $sub->id }}" class="hidden bg-gray-50 dark:bg-gray-800/60">
                            <td colspan="7" class="px-4 py-4">
                                <form action="{{ route('admin.billing.subscriptions.extend', $sub->id) }}" method="POST"
                                    class="flex items-end gap-3">
                                    @csrf
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">
                                            Extend by (months)
                                        </label>
                                        <input type="number" name="months" value="1" min="1" max="12"
                                            class="form-input text-sm w-24">
                                    </div>
                                    <button type="submit" class="btn bg-primary text-white text-xs py-1.5 px-3">Apply</button>
                                    <button type="button"
                                        onclick="document.getElementById('extend-modal-{{ $sub->id }}').classList.add('hidden')"
                                        class="btn bg-gray-200 text-gray-700 text-xs py-1.5 px-3">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                No subscriptions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($subscriptions->hasPages())
            <div class="py-4 px-4">
                {{ $subscriptions->links() }}
            </div>
        @endif
    </div>

</main>
@endsection
