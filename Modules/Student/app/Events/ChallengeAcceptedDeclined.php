<?php

namespace Modules\Student\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Student\Models\StudentChallenge;

class ChallengeAcceptedDeclined
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public  $challenge;
    public  $action; // accepted, declined, etc.
    public  $participantName;
    /**
     * Create a new event instance.
     */
    public function __construct(StudentChallenge $challenge, $action, $participantName )
    {
        $this->challenge = $challenge;
        $this->action = $action;
        $this->participantName = $participantName;
    
    }
    

    /**
     * Get the channels the event should be broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
