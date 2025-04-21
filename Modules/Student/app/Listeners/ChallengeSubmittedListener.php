<?php

namespace Modules\Student\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Modules\Common\Providers\OneSignalProvider;
use Modules\Student\Events\ChallengeCreated;
use Modules\Student\Events\ChallengeSubmitted;

class ChallengeSubmittedListener implements ShouldQueue
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
    public function handle(ChallengeSubmitted $event): void
    {        
        $challenge = $event->challenge;
        $participants = $challenge->participants;
        $participantName = $event->participantName;

        // Get array of one signal IDs
        $onesignalIds = $participants->pluck('one_signal_id')->filter()->values()->all();
        // Only send if we have valid OneSignal IDs
        if (!empty($onesignalIds)) {
            try {
                OneSignalProvider::sendToUsers(
                    $onesignalIds,
                    'New Challenge Submission Entry',
                    $participantName . ' has submitted a challenge entry',
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
}
