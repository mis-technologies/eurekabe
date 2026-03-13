<?php

namespace Modules\Advocate\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        $this->details= $details;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject('Password Reset link')
        ->view('advocate::mails.reset-password');
    }

}
