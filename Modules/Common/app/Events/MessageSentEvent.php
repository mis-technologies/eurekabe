<?php

namespace Modules\Common\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Common\Models\Message;

class MessageSentEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message->loadMissing(['from', 'to', 'files']);
    }

    public function broadcastOn(): Channel
    {
        return new Channel('chat.' . $this->message->conversation_id);
    }

    public function broadcastAs(): string
    {
        return 'MessageSent';
    }

    public function broadcastWith(): array
    {
        return [
            'id'              => $this->message->id,
            'uuid'            => $this->message->uuid,
            'conversation_id' => $this->message->conversation_id,
            'user_id'         => $this->message->user_id,
            'to_user_id'      => $this->message->to_user_id,
            'text'            => $this->message->text,
            'read_at'         => $this->message->read_at,
            'from'            => $this->message->from,
            'created_at'      => $this->message->created_at?->toIso8601String(),
        ];
    }
}
