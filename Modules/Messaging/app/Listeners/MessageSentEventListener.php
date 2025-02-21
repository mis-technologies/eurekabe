<?php

namespace Modules\Messaging\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Common\Notifications\Notification;
use Modules\Messaging\Events\MessageSentEvent;
use Modules\Common\Events\SocketEvent;

class MessageSentEventListener //implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(MessageSentEvent $event)
    {
        $conversation = $event->message->conversation;
        $from = $event->message->from;
        $to = $event->message->to;

        // Database notification
        $mailContent = [
            'title' => "You have a new message",
            'from_user_name' => $from->name,
            'body' => "You've got mail! There is a new message waiting for you in your Eureka inbox from {$from->name}",
            'actions' => "<a href='https://eurekabe.com' >View Message </a>",
        ];

        $dbContent = [
            'title' => "You have a new message",
            'text' => "You have a new conversation message from {$from->name}",
            'entity' => get_class($from),
            'entity_id' => $from->id,
            'meta' => '',
        ];

        $conversation['heading'] = [
            'title' => $from->name,
            'image' => $from->image
        ];


        if($to){
            $to->notify((new Notification(emailContent: $mailContent, dbContent: $dbContent, channel: ['database'])));
            event(new SocketEvent($conversation, "{$to->email}", 'Conversation'));
            event(new SocketEvent( $to->unreadNotifications()->limit(1), "{$to->email}", 'Notification'));
            return;
        }
       
    }
}
