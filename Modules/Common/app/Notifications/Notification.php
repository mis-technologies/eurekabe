<?php

namespace Modules\Common\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification as BaseNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;
use Modules\Common\Providers\OneSignalProvider;

class Notification extends BaseNotification //implements ShouldQueue
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
        $this->emailContent = $emailContent;
        $this->dbContent = $dbContent;
        $this->channel = $channel;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        if (is_array($this->channel) && in_array('push', $this->channel)) {
            $this->toPush($notifiable); // Pass $notifiable to toPush
        }
        return (is_array($this->channel) ? $this->channel : [$this->channel]) ?? ['mail'];
    }

    // push notification
    public function toPush($notifiable)
    {
       try {
            OneSignalProvider::sendToUsers(
                [$notifiable->one_signal_id],
                $this->dbContent['title'],
                $this->dbContent['text'],
                [
                    'url' => $this->dbContent['url'] ?? null,
                    'data' => $this->dbContent,
                ]
            );
        } catch (\Exception $e) {
            // Handle the exception
            Log::error('Failed to send OneSignal notification', [
                'error' => $e->getMessage(),
                'notifiable_id' => $notifiable->id,
            ]);
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // $body = $this->emailContent;
        // $subject = $this->emailContent;
        // $action = $this->emailAction ?? "<a class='btn btn-primary'>Login</a>";
        // return (new MailMessage)
        //     ->subject('New Mail From Influenzit')
        //     ->view('core::emails.customemailnotification', ['body' => $body, 'subject'=> $subject, 'action'=>$action]);
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
