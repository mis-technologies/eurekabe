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

    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h6 class="card-title">All Payments</h6>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $payments->total() }} total</span>
        </div>
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount (&#8358;)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($payments as $payment)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            @if($payment->user)
                                                <div class="font-medium">{{ $payment->user->name ?? ($payment->user->firstname . ' ' . $payment->user->lastname) }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $payment->user->email }}</div>
                                            @else
                                                <span class="text-gray-400 italic text-xs">Deleted user</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            {{ $payment->plan?->name ?? '—' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800 dark:text-gray-200">
                                            &#8358;{{ number_format($payment->amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <code class="text-xs bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded">{{ $payment->paystack_reference ?? '—' }}</code>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $payment->created_at?->format('d M Y, H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
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
            </div>
        </div>
    </div>

</main>
@endsection
