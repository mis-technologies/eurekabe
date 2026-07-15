@extends('admin::layouts.app')

@section('content')
<main class="flex-grow p-6">

    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Adjust User Credits</h4>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
            <div class="flex items-center gap-2">
                <i class="mgc_check_circle_line text-lg"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
            <div class="flex items-center gap-2">
                <i class="mgc_close_circle_line text-lg"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="grid lg:grid-cols-2 gap-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Manual Credit Adjustment</h6>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.billing.adjust.apply') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            User Email <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            class="form-input w-full @error('email') border-red-500 @enderror"
                            placeholder="user@example.com"
                            required
                        >
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Amount <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            name="amount"
                            id="amount"
                            value="{{ old('amount') }}"
                            class="form-input w-full @error('amount') border-red-500 @enderror"
                            placeholder="e.g. 100 to add, -50 to deduct"
                            required
                        >
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Positive value adds credits. Negative value deducts credits. Cannot be zero.
                        </p>
                        @error('amount')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Description / Reason <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            name="description"
                            id="description"
                            rows="3"
                            class="form-input w-full @error('description') border-red-500 @enderror"
                            placeholder="e.g. Admin bonus, Promotional credit, Correction..."
                            required
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn bg-primary text-white w-full">
                        <i class="mgc_currency_dollar_line mr-2"></i>
                        Apply Credit Adjustment
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Notes</h6>
            </div>
            <div class="p-6 space-y-3 text-sm text-gray-600 dark:text-gray-400">
                <div class="flex items-start gap-2">
                    <i class="mgc_information_line text-blue-500 mt-0.5 flex-shrink-0"></i>
                    <p>Enter the user's email address to look them up. The email must match an existing user account.</p>
                </div>
                <div class="flex items-start gap-2">
                    <i class="mgc_add_circle_line text-green-500 mt-0.5 flex-shrink-0"></i>
                    <p>A <strong>positive</strong> amount (e.g. <code class="bg-gray-100 dark:bg-gray-800 px-1 rounded">100</code>) will add credits to the user's balance.</p>
                </div>
                <div class="flex items-start gap-2">
                    <i class="mgc_minus_circle_line text-red-500 mt-0.5 flex-shrink-0"></i>
                    <p>A <strong>negative</strong> amount (e.g. <code class="bg-gray-100 dark:bg-gray-800 px-1 rounded">-50</code>) will deduct credits from the user's balance.</p>
                </div>
                <div class="flex items-start gap-2">
                    <i class="mgc_file_line text-amber-500 mt-0.5 flex-shrink-0"></i>
                    <p>All adjustments are recorded in the credit transaction log with the description you provide.</p>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
