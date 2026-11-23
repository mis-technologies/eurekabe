<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Common\Models\Competition;

class CompetitionEntryPaymentLink extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        protected User $user,
        protected Competition $competition,
        protected string $authorizationUrl,
    ) {}

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject("Complete your entry for \"{$this->competition->name}\"")
            ->view('emails.competition-entry-payment-link')
            ->with([
                'name'             => $this->user->name,
                'competitionName'  => $this->competition->name,
                'authorizationUrl' => $this->authorizationUrl,
            ]);
    }
}
