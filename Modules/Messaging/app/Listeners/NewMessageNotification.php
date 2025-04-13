<?php

namespace Modules\Messaging\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Common\Events\SocketEvent;
use Modules\Common\Notifications\Notification;
use Modules\Messaging\Events\MessageSentEvent;
use Illuminate\Support\Facades\Cache;

class NewMessageNotification implements ShouldQueue

{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

    public function handle(MessageSentEvent $event)
    {
        $conversation = $event->message->conversation;
        $from = $event->message->from;
        $to = $event->message->to;

        if ($to) {
            // Update unread message count in cache
            $cacheKey = "user:{$to->id}:unread_messages";
            $unreadMessages = Cache::get($cacheKey, []);

            // Group messages by sender
            if (!isset($unreadMessages[$from->id])) {
                $unreadMessages[$from->id] = [
                    'name' => $from->name,
                    'count' => 0,
                ];
            }
            $unreadMessages[$from->id]['count']++;

            Cache::put($cacheKey, $unreadMessages, now()->addMinutes(30));

            // Prepare aggregated notification content
            $totalUnread = array_sum(array_column($unreadMessages, 'count'));
            $otherSenders = count($unreadMessages) - 1;
            $summary = "You have $totalUnread unread messages";
            if ($otherSenders > 0) {
                $summary .= " from {$unreadMessages[$from->id]['name']} and $otherSenders others.";
            } else {
                $summary .= " from {$unreadMessages[$from->id]['name']}.";
            }

            $dbContent = [
                'title' => "New Messages",
                'text' => $summary,
                'entity' => get_class($from),
                'entity_id' => $from->id,
                'meta' => '',
            ];

            // Send notification
            $to->notify(new Notification(emailContent: null, dbContent: $dbContent, channel: ['database', 'push']));
        }
    }
}
