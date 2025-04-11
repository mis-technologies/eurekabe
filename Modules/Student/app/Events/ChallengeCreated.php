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
    public StudentChallenge $challenge;
    /**
     * Create a new event instance.
     */
    public function __construct(StudentChallenge $challenge)
    {
        $this->challenge = $challenge;
        $participants = $challenge->participants;
        
        // Get array of one signal IDs
        $onesignalIds = $participants->pluck('one_signal_id')->filter()->values()->all();
        
        // Only send if we have valid OneSignal IDs
        if (!empty($onesignalIds)) {
            try {
                OneSignalProvider::sendToUsers(
                    $onesignalIds,
                    'New Challenge Created',
                    'You have a new challenge from ' . $challenge->participants[0]->firstname,
                    [
                        'challenge_id' => $challenge->id,
                        'exam_id' => $challenge->exam_id,
                        'status' => $challenge->status,
                    ]
                );
            } catch (\Exception $e) {
                // Log the error but don't throw it to prevent event handling disruption
                Log::error('Failed to send OneSignal notification', [
                    'error' => $e->getMessage(),
                    'challenge_id' => $challenge->id
                ]);
            }
        }
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
