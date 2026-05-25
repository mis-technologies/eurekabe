<?php

namespace Modules\Student\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Modules\Common\Providers\OneSignalProvider;
use Modules\Student\Events\ChallengeSubmitted;
use Modules\Student\Models\StudentChallenge;

class ChallengeSubmittedListener implements ShouldQueue
{
    public function __construct() {}

    public function handle(ChallengeSubmitted $event): void
    {
        $challenge = $event->challenge;
        $participants = $challenge->participants;
        $participantName = $event->participantName;

        $onesignalIds = $participants->pluck('one_signal_id')->filter()->values()->all();

        if (!empty($onesignalIds)) {
            try {
                if ($challenge->status === StudentChallenge::STATUS_COMPLETED) {
                    // Last submission — announce the winner
                    $winner = $challenge->winner;
                    $winnerName = $winner ? ($winner->firstname ?? 'A participant') : 'A participant';

                    OneSignalProvider::sendToUsers(
                        $onesignalIds,
                        'Challenge Complete!',
                        "$winnerName has won the challenge. Check the results!",
                        [
                            'challenge_id' => $challenge->id,
                            'exam_id'      => $challenge->exam_id,
                            'status'       => $challenge->status,
                            'winner_id'    => $challenge->winner_id,
                        ]
                    );

                    // Also send a database notification about the winner
                    $dbContent = [
                        'title'  => 'Challenge Complete!',
                        'text'   => "$winnerName has won the challenge. Check the results!",
                        'entity' => get_class($challenge),
                        'entity_id' => $challenge->id,
                        'meta'   => [
                            'challenge_id' => $challenge->id,
                            'exam_id'      => $challenge->exam_id,
                            'status'       => $challenge->status,
                            'winner_id'    => $challenge->winner_id,
                        ],
                    ];

                    $participants->each(function ($participant) use ($dbContent) {
                        $participant->notify(new \Modules\Common\Notifications\Notification(
                            $dbContent,
                            $dbContent,
                            'database'
                        ));
                    });
                } else {
                    // Intermediate submission — notify others that someone submitted
                    OneSignalProvider::sendToUsers(
                        $onesignalIds,
                        'Challenge Update',
                        "$participantName has submitted their challenge entry",
                        [
                            'challenge_id' => $challenge->id,
                            'exam_id'      => $challenge->exam_id,
                            'status'       => $challenge->status,
                        ]
                    );
                }
            } catch (\Exception $e) {
                Log::error('Failed to send ChallengeSubmitted OneSignal notification', [
                    'error'        => $e->getMessage(),
                    'challenge_id' => $challenge->id,
                ]);
            }
        }
    }
}
