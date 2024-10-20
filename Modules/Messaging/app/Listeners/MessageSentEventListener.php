<?php

namespace Modules\Messaging\Listeners;

use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Messaging\Events\MessageSentEvent;
use Modules\Messaging\Events\SocketEvent;
use Modules\Messaging\Notifications\NewMessageNotification;


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

            $fromUser = $event->message->fromUser;
            $toUser = $event->message->toUser;

            // Database notification
            $mailContent = [
                'title' => "You have a new message",
                'from_user_name' => $fromUser->name,
                'body' => "You've got mail! There is a new message waiting for you in your Trafull inbox from {$fromUser->name}",
                'actions' => "<a href='https://influenzit.com' >View Message </a>",
            ];


            $dbContent = [
                'title' => "You have a new message",
                'text' => "You have a new conversation message from {$fromUser->name}",
                'entity' => get_class($fromUser),
                'entity_id' => $fromUser->id,
                'meta' => '',
            ];


            $conversation['heading'] = [
                'title' => $fromUser->name,
                'image' => $fromUser->profile_pic
            ];
    
    
            if($toUser){
                
                $user = auth()->user();
                $toUser->notify((new NewMessageNotification(emailContent: $mailContent, dbContent: $dbContent, channel: ['mail', 'database'])));
                event(new SocketEvent($conversation, "{$toUser->email}", 'Conversation'));
                // event(new SocketEvent( $user->unreadNotifications()->limit(1), "{$toUser->email}", 'Notification'));
            }
    
            if($toUser){
                $conversation['heading'] = [
                    'title' => $toUser->name,
                    'image' => $toUser->profile_pic
                ];
            }
            event(new SocketEvent($conversation, "{$fromUser->email}", 'Conversation'));
            // event(new SocketEvent( user()->unreadNotifications()->limit(1), "{$fromUser->email}", 'Notification'));


            event(new SocketEvent($conversation, "testchannel", 'Conversation'));


        // }

       
   
    }
}
