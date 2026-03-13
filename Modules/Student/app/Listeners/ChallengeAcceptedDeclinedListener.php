<?php

namespace Modules\Student\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Modules\Common\Providers\OneSignalProvider;
use Modules\Student\Events\ChallengeAcceptedDeclined;
use Modules\Student\Events\ChallengeCreated;
use Modules\Student\Models\StudentChallenge;

class ChallengeAcceptedDeclinedListener implements ShouldQueue
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
    public function handle(ChallengeAcceptedDeclined $event): void
    {        
        $challenge = $event->challenge;
        $action = $event->action; // accepted, declined, etc.
        $participantName = $event->participantName;

        $challengeUserId = $challenge->user_id;
        $challengeUser = User::find($challengeUserId);
        
        // Get array of one signal IDs
        $onesignalIds = [$challengeUser->onesignal_ids];

        // Only send if we have valid OneSignal IDs
        if (!empty($onesignalIds)) {
            try {
                OneSignalProvider::sendToUsers(
                    $onesignalIds,
                    'Challenge ' . $action,
                    $participantName . 'has ' . $action . ' your challenge',
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
            'title' => "Challenge " . $action,
            'text' => "$participantName has " . $action . " your challenge",
            'entity' => get_class($challenge),
            'entity_id' => $challenge->id,
            'meta' => [
                'challenge_id' => $challenge->id,
                'exam_id' => $challenge->exam_id,
                'status' => $challenge->status,
            ],
        ];

        $challengeUser->notify(new \Modules\Common\Notifications\Notification(
            $dbContent,
            $dbContent,
            'database'
        ));

    }
}
