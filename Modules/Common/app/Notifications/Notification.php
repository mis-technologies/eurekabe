<?php

namespace Modules\Common\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification as BaseNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;
use Modules\Common\Providers\ExpoNotificationProvider;
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

        Log::info('Sending OneSignal notification', [
            'channel' => $this->channel,
            'emailContent' => $this->emailContent,
            'dbContent' => $this->dbContent,
        ]);
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        if (is_array($this->channel) && in_array('push', $this->channel)) {
            $this->toPush($notifiable); // Pass $notifiable to toPush
        }
        $channel = $this->channel;

        // remove push from the channel array
        if (is_array($channel) && in_array('push', $channel)) {
            $channel = array_diff($channel, ['push']);
        }
        return (is_array($channel) ? $channel : [$channel]) ?? ['mail'];
    }

    // push notification
    public function toPush($notifiable)
    {
        try {
            $title = $this->dbContent['title'] ?? '';
            $body  = $this->dbContent['text']  ?? '';

            // Expo push token (preferred — managed Expo workflow)
            if (!empty($notifiable->expo_push_token)) {
                ExpoNotificationProvider::send(
                    [$notifiable->expo_push_token],
                    $title,
                    $body,
                    $this->dbContent
                );
            }

            // OneSignal fallback (legacy / bare workflow)
            if (!empty($notifiable->one_signal_id)) {
                OneSignalProvider::sendToUsers(
                    [$notifiable->one_signal_id],
                    $title,
                    $body,
                    ['data' => $this->dbContent, 'url' => $this->dbContent['url'] ?? null]
                );
            }
        } catch (\Exception $e) {
            Log::error('Notification::toPush failed', ['error' => $e->getMessage()]);
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
