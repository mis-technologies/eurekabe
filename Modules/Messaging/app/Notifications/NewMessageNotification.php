<?php

namespace Modules\Messaging\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $channel = null;
    public $dbContent;
    public $emailContent;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($emailContent, $dbContent, $channel)
    {
        //
        $this->emailContent = $emailContent;
        $this->dbContent = $dbContent;
        $this->channel = $channel;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return (is_array($this->channel) ? $this->channel : [$this->channel]) ?? ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Inbox Message')
                    ->view('messaging::emails.messagenotification', ['content' => $this->emailContent, 'notifiable' => $notifiable]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->dbContent;
    }
}


