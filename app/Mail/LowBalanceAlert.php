<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Common\Models\UserCreditAccount;

class LowBalanceAlert extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        protected User $user,
        protected UserCreditAccount $account,
        protected string $signedUrl,
    ) {}

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject("You're running low on Eureka credits")
            ->view('emails.low-balance-alert')
            ->with([
                'name'      => $this->user->name,
                'balance'   => $this->account->balance,
                'planName'  => $this->account->plan?->name ?? 'Free',
                'signedUrl' => $this->signedUrl,
            ]);
    }
}
