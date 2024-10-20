<?php

namespace Modules\Messaging\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SocketEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $payload;
    public $channel;
    public $event;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($payload, $channel, $event)
    {
        $this->payload = $payload;
        $this->channel = $channel;
        $this->event = $event;
    }


     public function broadcastWith()
    {
        // This must always be an array. Since it will be parsed with json_encode()
        return [
            'data' => $this->payload,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array|string
     */
    public function broadcastOn()
    {
        
        return new Channel($this->channel);
    }

    public function broadcastAs()
    {
        return $this->event ?? 'Notification';
    }
    
}

