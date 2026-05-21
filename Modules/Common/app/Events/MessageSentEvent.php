<?php

namespace Modules\Common\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Modules\Common\Models\Message;

class MessageSentEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

     public $message;
     public $channel;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }
}
