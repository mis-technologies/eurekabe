<?php

namespace Modules\Messaging\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;
use Modules\Common\Notifications\Notification;
use Modules\Messaging\Events\MessageSentEvent;

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
        // Log::info('NewMessageNotification: ' . json_encode($event->message));
        $conversation = $event->message->conversation;
        $from = $event->message->from;
        $to = $event->message->to;

        // if ($to) {
        //     // Update unread message count in cache
        //     $cacheKey = "user:{$to->id}:unread_messages";
        //     $lastNotificationKey = "user:{$to->id}:last_notification_time";
        //     $unreadMessages = Cache::get($cacheKey, []);
        //     $lastNotificationTime = Cache::get($lastNotificationKey, null);

        //     // Check if 30 minutes have passed since the last notification
        //     if ($lastNotificationTime && now()->diffInMinutes($lastNotificationTime) < 30) {
        //         return; // Exit early if less than 30 minutes have passed
        //     }

        //     // Group messages by sender
        //     if (!isset($unreadMessages[$from->id])) {
        //         $unreadMessages[$from->id] = [
        //             'name' => $from->name,
        //             'count' => 0,
        //         ];
        //     }
        //     $unreadMessages[$from->id]['count']++;

        //     Cache::put($cacheKey, $unreadMessages, now()->addMinutes(30));

        //     // Prepare aggregated notification content
        //     $totalUnread = array_sum(array_column($unreadMessages, 'count'));
        //     $otherSenders = count($unreadMessages) - 1;
        //     $summary = "You have $totalUnread unread messages";
        //     if ($otherSenders > 0) {
        //         $summary .= " from {$unreadMessages[$from->id]['name']} and $otherSenders others.";
        //     } else {
        //         $summary .= " from {$unreadMessages[$from->id]['name']}.";
        //     }

        //     $dbContent = [
        //         'title' => "New Messages",
        //         'text' => $summary,
        //         'entity' => get_class($from),
        //         'entity_id' => $from->id,
        //         'meta' => '',
        //     ];

        //     // Send notification
        //     $to->notify(new Notification(emailContent: null, dbContent: $dbContent, channel: ['database', 'push']));

        //     // Update the last notification time in cache
        //     Cache::put($lastNotificationKey, now(), now()->addMinutes(30));
        // }

        if ($to) {
            // Fetch unread messages from the database
            $unreadMessagesQuery = \Modules\Messaging\Models\Message::where('to_user_id', $to->id)
                ->whereNull('read_at')
                ->with('from')
                ->get();

            $totalUnread = $unreadMessagesQuery->count();

            if ($totalUnread === 0) {
                return; // Exit early if there are no unread messages
            }

            // Check if 30 minutes have passed since the last notification
            $lastNotificationKey = "user:{$to->id}:last_notification_time";
            $lastNotificationTime = Cache::get($lastNotificationKey, null);

            if ($lastNotificationTime && now()->diffInMinutes($lastNotificationTime) < 30) {
                return; // Exit early if less than 30 minutes have passed
            }

            // Group unread messages by sender
            $unreadMessagesBySender = $unreadMessagesQuery->groupBy('from.id');
            $senders = $unreadMessagesBySender->keys()->map(function ($senderId) use ($unreadMessagesBySender) {
                $sender = $unreadMessagesBySender[$senderId]->first()->from;
                return $sender->firstname ?? $sender->username ?? 'Unknown';
            });

            // Prepare notification summary
            $summary = "You have $totalUnread unread messages";
            if ($senders->count() > 1) {
                $summary .= " from {$senders->take(3)->join(', ')}";
                if ($senders->count() > 3) {
                    $summary .= " and others.";
                } else {
                    $summary .= ".";
                }
            } else {
                $summary .= " from {$senders->first()}.";
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

            // Update the last notification time in cache
            Cache::put($lastNotificationKey, now(), now()->addMinutes(30));
        }

    }
}
