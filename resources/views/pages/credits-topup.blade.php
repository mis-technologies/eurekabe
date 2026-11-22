<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credits &amp; Billing — Eureka</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f5f5f5;
            color: #222;
            margin: 0;
            padding: 0;
        }
        .wrap {
            max-width: 640px;
            margin: 0 auto;
            padding: 24px 16px 60px;
        }
        h1 { font-size: 22px; margin-bottom: 4px; }
        h2 { font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px; color: #777; margin: 32px 0 12px; }
        .card {
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
        }
        .balance-row { display: flex; align-items: baseline; gap: 6px; }
        .balance-amount { font-size: 32px; font-weight: 800; }
        .balance-total { color: #999; font-size: 16px; }
        .balance-meta { color: #777; font-size: 13px; margin-top: 4px; }
        .success-banner {
            background: #e6f6ec; border: 1px solid #34c759; color: #1a7a3a;
            border-radius: 10px; padding: 14px 16px; margin-bottom: 16px; font-weight: 600;
        }
        .error-banner {
            background: #fdeaea; border: 1px solid #e03131; color: #a0201e;
            border-radius: 10px; padding: 14px 16px; margin-bottom: 16px;
        }
        .plan-card {
            border: 1.5px solid #e5e5e5; border-radius: 12px; padding: 16px; margin-bottom: 12px;
        }
        .plan-head { display: flex; justify-content: space-between; align-items: flex-start; }
        .plan-name { font-weight: 700; font-size: 16px; }
        .plan-credits { color: #777; font-size: 13px; margin-top: 2px; }
        .plan-price { font-weight: 800; font-size: 18px; color: #3b5bdb; }
        .btn {
            display: inline-block; width: 100%; box-sizing: border-box; text-align: center;
            background: #3b5bdb; color: #fff; border: none; border-radius: 10px;
            padding: 12px; font-weight: 700; font-size: 15px; margin-top: 12px; cursor: pointer;
        }
        .qty-row { display: flex; align-items: center; gap: 10px; margin-top: 10px; }
        .qty-row input { width: 60px; padding: 8px; border-radius: 8px; border: 1px solid #ddd; text-align: center; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        td, th { padding: 8px 4px; border-bottom: 1px solid #eee; text-align: left; }
        .amount-credit { color: #1a7a3a; font-weight: 600; }
        .amount-debit { color: #a0201e; font-weight: 600; }
        .pager { display: flex; justify-content: space-between; margin-top: 10px; font-size: 13px; }
        .pager a { color: #3b5bdb; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrap">
    <h1>Credits &amp; Billing</h1>
    <p style="color:#777; margin-top:0;">{{ $user->email }}</p>

    @if($justPaid)
        <div class="success-banner">Payment successful — your credits have been added below.</div>
    @endif

    @if($errors->any())
        <div class="error-banner">{{ $errors->first() }}</div>
    @endif

    <div class="card">
        <div class="balance-row">
            <span class="balance-amount">{{ number_format($account->balance) }}</span>
            <span class="balance-total">/ {{ number_format($account->monthly_allowance) }}</span>
        </div>
        <div class="balance-meta">
            {{ $account->plan?->name ?? 'Free' }} plan · Resets {{ optional($account->next_reset_at)->format('j M Y') }}
        </div>
    </div>

    <h2>Monthly Plans</h2>
    @foreach($plans->where('type', 'monthly') as $plan)
        <div class="plan-card">
            <div class="plan-head">
                <div>
                    <div class="plan-name">{{ $plan->name }}</div>
                    <div class="plan-credits">{{ number_format($plan->monthly_credits) }} credits/month</div>
                </div>
                <div class="plan-price">₦{{ number_format($plan->price_ngn / 100) }}<span style="font-size:12px;color:#999;">/month</span></div>
            </div>
            <form method="POST" action="{{ route('credits.web.initiate') }}">
                @csrf
                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                <button type="submit" class="btn">
                    {{ $account->plan?->id === $plan->id ? 'Current plan — renew' : 'Upgrade' }}
                </button>
            </form>
        </div>
    @endforeach

    <h2>Credit Packs</h2>
    @foreach($plans->where('type', 'pay_as_you_go') as $pack)
        <div class="plan-card">
            <div class="plan-head">
                <div>
                    <div class="plan-name">{{ $pack->name }}</div>
                    <div class="plan-credits">{{ number_format($pack->monthly_credits) }} credits</div>
                </div>
                <div class="plan-price">₦{{ number_format($pack->price_ngn / 100) }}</div>
            </div>
            <form method="POST" action="{{ route('credits.web.initiate') }}">
                @csrf
                <input type="hidden" name="plan_id" value="{{ $pack->id }}">
                <div class="qty-row">
                    <label for="qty-{{ $pack->id }}" style="font-size:13px; color:#777;">Quantity</label>
                    <input type="number" id="qty-{{ $pack->id }}" name="quantity" value="1" min="1" max="100">
                </div>
                <button type="submit" class="btn">Buy {{ number_format($pack->monthly_credits) }} Credits</button>
            </form>
        </div>
    @endforeach

    <h2>Recent Activity</h2>
    <div class="card">
        <table>
            <thead>
                <tr><th>Date</th><th>Description</th><th style="text-align:right;">Amount</th></tr>
            </thead>
            <tbody>
                @forelse($transactions as $tx)
                    <tr>
                        <td>{{ $tx->created_at->format('d M') }}</td>
                        <td>{{ $tx->description }}</td>
                        <td style="text-align:right;" class="{{ in_array($tx->type, ['credit', 'refund', 'reset']) ? 'amount-credit' : 'amount-debit' }}">
                            {{ in_array($tx->type, ['credit', 'refund', 'reset']) ? '+' : '-' }}{{ number_format($tx->amount) }}
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" style="color:#999;">No activity yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($transactions->previousPageUrl() || $transactions->nextPageUrl())
            <div class="pager">
                <span>@if($transactions->previousPageUrl())<a href="{{ $transactions->previousPageUrl() }}">&larr; Newer</a>@endif</span>
                <span>@if($transactions->nextPageUrl())<a href="{{ $transactions->nextPageUrl() }}">Older &rarr;</a>@endif</span>
            </div>
        @endif
    </div>
</div>
</body>
</html>
