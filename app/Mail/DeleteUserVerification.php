<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeleteUserVerification extends Mailable
{
    use Queueable, SerializesModels;


    protected $verificationCode;
    /**
     * Create a new message instance.
     */
    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

     /**
     * Build the message.
     */
    public function build(): self
    {
        // Compose the email content directly in the text body
        return $this->subject('Email Verification')
                    ->view('mails.verf-email-before-delete')
                    ->with([
                        'verificationCode' => $this->verificationCode,

                    ]);
    }

    /**
     * Get the channels the notification should be sent on.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
}
