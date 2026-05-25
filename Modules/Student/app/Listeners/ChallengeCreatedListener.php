<?php

namespace Modules\Student\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Modules\Common\Providers\OneSignalProvider;
use Modules\Student\Events\ChallengeCreated;

class ChallengeCreatedListener implements ShouldQueue
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {       
    }

    /**
     * Handle the event.
     */
    public function handle(ChallengeCreated $event): void
    {        
        $challenge = $event->challenge;
        $participants = $challenge->participants;



        // Get array of one signal IDs
        $onesignalIds = $participants->pluck('one_signal_id')->filter()->values()->all();
        // Only send if we have valid OneSignal IDs
        if (!empty($onesignalIds)) {
            try {
                OneSignalProvider::sendToUsers(
                    $onesignalIds,
                    'New Challenge Created',
                    'You have a new challenge on Eureka ',

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


        // Send database notification

        $dbContent = [
            'title' => "You have a new challenge",
            'text' => "You have a new challenge on Eureka",
            'entity' => get_class($challenge),
            'entity_id' => $challenge->id,
            'meta' => [
                'challenge_id' => $challenge->id,
                'exam_id' => $challenge->exam_id,
                'status' => $challenge->status,
            ],
        ];

        $participants->each(function ($participant) use ($dbContent) {
            $participant->notify(new \Modules\Common\Notifications\Notification(
                $dbContent,
                $dbContent,
                'database'
            ));
        });

    }
}
