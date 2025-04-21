<?php

namespace Modules\Student\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Student\Models\StudentChallenge;

class ChallengeSubmitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public  $challenge;
    public  $participantName;
    /**
     * Create a new event instance.
     */
    public function __construct(StudentChallenge $challenge, $participantName )
    {
        $this->challenge = $challenge;
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
