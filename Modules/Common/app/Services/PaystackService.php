<?php

namespace Modules\Common\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Modules\Common\Models\CreditPlan;
use Modules\Common\Models\Payment;

class PaystackService
{
    private string $secretKey;
    private string $baseUrl = 'https://api.paystack.co';

    public function __construct()
    {
        $this->secretKey = config('services.paystack.secret_key', '');
    }

    /**
     * Initialize a Paystack transaction.
     * Monthly plans force card-only so the authorization can be stored for recurring billing.
     * Returns ['authorization_url', 'reference'] or throws.
     */
    public function initiate(User $user, CreditPlan $plan, Payment $payment): array
    {
        $payload = [
            'email'        => $user->email,
            'amount'       => $payment->amount,  // already in kobo
            'reference'    => $payment->paystack_reference,
            'callback_url' => config('services.paystack.callback_url'),
            'metadata'     => [
                'user_id'   => $user->id,
                'plan_id'   => $plan->id,
                'plan_type' => $plan->type,
            ],
        ];

        // Force card channel for monthly subscriptions so Paystack stores a reusable auth
        if ($plan->type === 'monthly') {
            $payload['channels'] = ['card'];
        }

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->secretKey}",
            'Content-Type'  => 'application/json',
        ])->post("{$this->baseUrl}/transaction/initialize", $payload);

        if (!$response->successful() || !($response->json('status'))) {
            throw new \RuntimeException($response->json('message') ?? 'Paystack initialization failed');
        }

        return [
            'authorization_url' => $response->json('data.authorization_url'),
            'reference'         => $response->json('data.reference'),
        ];
    }

    /**
     * Verify a transaction with Paystack.
     * Returns the full data array or throws.
     */
    public function verify(string $reference): array
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->secretKey}",
        ])->get("{$this->baseUrl}/transaction/verify/{$reference}");

        if (!$response->successful() || !($response->json('status'))) {
            throw new \RuntimeException($response->json('message') ?? 'Paystack verification failed');
        }

        return $response->json('data');
    }

    /**
     * Charge a stored card authorization (used for monthly subscription renewals).
     * Returns the transaction data array or throws.
     * Caller should check $data['status'] === 'success' before crediting the user.
     */
    public function chargeAuthorization(string $authorizationCode, string $email, int $amountKobo, string $reference): array
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->secretKey}",
            'Content-Type'  => 'application/json',
        ])->post("{$this->baseUrl}/transaction/charge_authorization", [
            'authorization_code' => $authorizationCode,
            'email'              => $email,
            'amount'             => $amountKobo,
            'reference'          => $reference,
        ]);

        if (!$response->successful() || !($response->json('status'))) {
            throw new \RuntimeException($response->json('message') ?? 'Paystack charge authorization failed');
        }

        return $response->json('data');
    }

    /**
     * Validate the Paystack webhook signature.
     */
    public function validateWebhook(string $payload, string $signature): bool
    {
        $secret = config('services.paystack.webhook_secret', '');
        return hash_equals(
            hash_hmac('sha512', $payload, $secret),
            $signature
        );
    }
}
