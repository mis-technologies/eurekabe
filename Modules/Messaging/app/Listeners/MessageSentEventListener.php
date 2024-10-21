<?php

namespace Modules\Messaging\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Messaging\Events\MessageSentEvent;
use Modules\Messaging\Events\SocketEvent;


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
      
        // if($conversation->entity == get_class(new User()) ){

            $from = $event->message->from;
            $to = $event->message->to;

            // Database notification
            $mailContent = [
                'title' => "You have a new message",
                'from_user_name' => $from->name,
                'body' => "You've got mail! There is a new message waiting for you in your Trafull inbox from {$from->name}",
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
                // $conversation['heading'] = [
                //     'title' => $to->name,
                //     'image' => $to->image
                // ];
                // $user = auth()->user();
                // $to->notify((new NewMessageNotification(emailContent: $mailContent, dbContent: $dbContent, channel: ['mail', 'database'])));
                event(new SocketEvent($conversation, "{$to->id}", 'Conversation'));
                return;
                // event(new SocketEvent( $user->unreadNotifications()->limit(1), "{$to->email}", 'Notification'));
            }
       
    }
}
