<?php

namespace Modules\Auth\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Wotz\VerificationCode\Notifications\VerificationCodeCreatedInterface;

class VerificationCodeCreated extends Notification implements VerificationCodeCreatedInterface
{
    use Queueable;

    public $code;

    /**
     * Create a new message instance.
     *
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage())
    //         ->subject(__('Your verification code'))
    //         ->greeting(__('Hello!'))
    //         ->line(__('It’s great to meet you.'))
    //         ->line(__('Your verification code: :code', ['code' => $this->code]))
    //         ->line(__('Thank you for using Eureka App.'))
    //         ->line(__('Kind regards'));

    // }

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(__('Your verification code'))
            ->view('emails.verification_code', ['code' => $this->code]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
