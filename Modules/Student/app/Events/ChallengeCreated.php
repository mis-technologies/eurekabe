<?php

namespace Modules\Student\Events;

use  Modules\Common\Providers\OneSignalProvider;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\Student\Models\StudentChallenge;

class ChallengeCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public  $challenge;
    /**
     * Create a new event instance.
     */
    public function __construct(StudentChallenge $challenge)
    {
        $this->challenge = $challenge;
       
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
