@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Payments</h4>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-gray-700 dark:text-gray-200">{{ number_format($stats['total']) }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Total</div>
        </div>
        <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-green-600">{{ number_format($stats['success']) }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Successful</div>
        </div>
        <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-amber-500">{{ number_format($stats['pending']) }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Pending</div>
        </div>
        <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-red-500">{{ number_format($stats['failed']) }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Failed</div>
        </div>
        <div class="card p-4 text-center">
            <div class="text-2xl font-bold text-blue-600">&#8358;{{ number_format($stats['revenue'] / 100, 0) }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Total Revenue</div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card mb-4 p-4">
        <form method="GET" action="{{ route('admin.billing.payments') }}" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Status</label>
                <select name="status" class="form-select text-sm" onchange="this.form.submit()">
                    <option value="" {{ !request('status') ? 'selected' : '' }}>All</option>
                    <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>Success</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="failed"  {{ request('status') === 'failed'  ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            <div class="flex-grow min-w-[200px]">
                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Search user or reference</label>
                <div class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Email, name, or reference…"
                        class="form-input text-sm flex-grow">
                    <button type="submit" class="btn bg-primary text-white text-sm px-3 py-1.5">Search</button>
                    @if(request()->hasAny(['status', 'search']))
                        <a href="{{ route('admin.billing.payments') }}" class="btn bg-gray-200 text-gray-700 text-sm px-3 py-1.5">Clear</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h6 class="card-title">All Payments</h6>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $payments->total() }} total</span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Card Stored</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($payments as $payment)
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                @if($payment->user)
                                    <div class="font-medium">
                                        {{ trim(($payment->user->firstname ?? '') . ' ' . ($payment->user->lastname ?? '')) ?: ($payment->user->name ?? 'User #'.$payment->user->id) }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $payment->user->email }}</div>
                                @else
                                    <span class="text-gray-400 italic text-xs">Deleted user</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                {{ $payment->plan?->name ?? '—' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-gray-800 dark:text-gray-200">
                                &#8358;{{ number_format($payment->amount / 100, 0) }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                <code class="text-xs bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded">{{ $payment->paystack_reference ?? '—' }}</code>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-center">
                                @if($payment->authorization_code)
                                    <span class="inline-flex items-center gap-1 text-green-600 text-xs font-medium">
                                        <i class="mgc_check_line"></i> Yes
                                    </span>
                                @else
                                    <span class="text-gray-400 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm">
                                @php
                                    $status = strtolower($payment->status ?? 'unknown');
                                    $badge = match($status) {
                                        'success', 'paid', 'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                        'pending', 'processing'        => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                        'failed', 'cancelled'          => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                        default                        => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $badge }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $payment->created_at?->format('d M Y, H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                No payments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($payments->hasPages())
            <div class="py-4 px-4">
                {{ $payments->links() }}
            </div>
        @endif
    </div>

</main>
@endsection
