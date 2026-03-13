<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeleteUserNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

     /**
     * Build the message.
     */
    public function build(): self
    {
        // Compose the email content directly in the text body
        return $this->subject('Deleted Notification')
                    ->view('mails.user-deleted')
                    ->with([
                        'Thanks' => 'User Deleted',

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
