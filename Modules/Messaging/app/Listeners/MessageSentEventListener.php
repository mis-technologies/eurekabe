<?php

namespace Modules\Messaging\Listeners;

use Illuminate\Support\Facades\Log;
use Modules\Common\Events\SocketEvent;
use Modules\Messaging\Events\MessageSentEvent;

class MessageSentEventListener//implements ShouldQueue

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
        
        if ($to) {
            $conversation['recent_message']['is_own'] = false;
            event(new SocketEvent($conversation, "chat.{$conversation->id}", 'Conversation'));
            return;
        }

    }
}
