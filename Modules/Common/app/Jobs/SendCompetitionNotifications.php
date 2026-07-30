<?php

namespace Modules\Common\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Common\Models\Competition;
use Modules\Common\Models\CompetitionParticipant;
use Modules\Common\Notifications\Notification as EurekaNotification;
use App\Models\User;

class SendCompetitionNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $competition;
    protected $eventType; // 'created', 'opened', 'closing_soon', 'closed', 'results_ready'

    public function __construct(Competition $competition, string $eventType)
    {
        $this->competition = $competition;
        $this->eventType = $eventType;
    }

    public function handle()
    {
        match ($this->eventType) {
            'created' => $this->notifyCreated(),
            'opened' => $this->notifyOpened(),
            'closing_soon' => $this->notifyClosingSoon(),
            'closed' => $this->notifyClosed(),
            'results_ready' => $this->notifyResultsReady(),
            default => null,
        };
    }

    protected function getRecipients()
    {
        if ($this->competition->visibility === 'public') {
            return User::where('user_type', 'student')->get();
        }

        return User::whereHas('schools', function ($q) {
            $q->whereIn('school_id', $this->competition->schools()->pluck('schools.id'));
        })->get();
    }

    protected function notifyCreated()
    {
        $recipients = $this->getRecipients();

        foreach ($recipients as $user) {
            $user->notify(new EurekaNotification(null, [
                'title' => 'New Competition Available',
                'text' => "{$this->competition->name} is now available. Join now to compete!",
                'entity' => get_class($this->competition),
                'entity_id' => $this->competition->id,
                'meta' => ['competition_id' => $this->competition->id],
            ], ['database', 'push']));
        }
    }

    protected function notifyOpened()
    {
        $recipients = $this->getRecipients();

        foreach ($recipients as $user) {
            $user->notify(new EurekaNotification(null, [
                'title' => 'Competition Window Opened',
                'text' => "{$this->competition->name} window is now open. Start competing!",
                'entity' => get_class($this->competition),
                'entity_id' => $this->competition->id,
                'meta' => ['competition_id' => $this->competition->id, 'event' => 'window_opened'],
            ], ['database', 'push']));
        }
    }

    protected function notifyClosingSoon()
    {
        $participants = CompetitionParticipant::where('competition_id', $this->competition->id)
            ->pluck('user_id');

        User::whereIn('id', $participants)->each(function ($user) {
            $user->notify(new EurekaNotification(null, [
                'title' => 'Competition Closing Soon',
                'text' => "{$this->competition->name} window closes in 15 minutes. Hurry up!",
                'entity' => get_class($this->competition),
                'entity_id' => $this->competition->id,
                'meta' => ['competition_id' => $this->competition->id, 'event' => 'closing_soon'],
            ], ['database', 'push']));
        });
    }

    protected function notifyClosed()
    {
        $participants = CompetitionParticipant::where('competition_id', $this->competition->id)
            ->with('user')
            ->get();

        foreach ($participants as $participant) {
            $participant->user->notify(new EurekaNotification(null, [
                'title' => 'Competition Closed',
                'text' => "{$this->competition->name} window has closed. Check the leaderboard!",
                'entity' => get_class($this->competition),
                'entity_id' => $this->competition->id,
                'meta' => ['competition_id' => $this->competition->id, 'event' => 'closed'],
            ], ['database', 'push']));
        }
    }

    protected function notifyResultsReady()
    {
        $participants = CompetitionParticipant::where('competition_id', $this->competition->id)
            ->with('user')
            ->get();

        foreach ($participants as $participant) {
            $isWinner = $participant->user_id === $this->competition->winner_id;
            $title = $isWinner ? 'You Won!' : 'Results Ready';
            $text = $isWinner
                ? "Congratulations! You won {$this->competition->name}!"
                : "Results for {$this->competition->name} are ready. Check the leaderboard!";

            $participant->user->notify(new EurekaNotification(null, [
                'title' => $title,
                'text' => $text,
                'entity' => get_class($this->competition),
                'entity_id' => $this->competition->id,
                'meta' => [
                    'competition_id' => $this->competition->id,
                    'event' => 'results_ready',
                    'is_winner' => $isWinner,
                ],
            ], ['database', 'push']));
        }
    }
}
