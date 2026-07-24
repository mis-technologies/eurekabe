<?php

namespace Modules\Common\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExpoNotificationProvider
{
    private const API_URL = 'https://exp.host/--/api/v2/push/send';

    /**
     * Send a push notification to one or more Expo push tokens.
     *
     * @param array  $tokens   Array of Expo push token strings (ExponentPushToken[...])
     * @param string $title    Notification title
     * @param string $body     Notification body
     * @param array  $data     Extra payload attached to the notification
     */
    public static function send(array $tokens, string $title, string $body, array $data = []): void
    {
        $valid = array_values(array_filter($tokens, fn ($t) => !empty($t)));
        if (empty($valid)) {
            return;
        }

        $messages = array_map(fn ($token) => [
            'to'    => $token,
            'title' => $title,
            'body'  => $body,
            'data'  => $data,
            'sound' => 'default',
        ], $valid);

        try {
            $response = Http::withHeaders([
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ])->post(self::API_URL, $messages);

            if (!$response->successful()) {
                Log::error('ExpoNotificationProvider: API error', [
                    'status'   => $response->status(),
                    'response' => $response->body(),
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('ExpoNotificationProvider: exception', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Send to a single user model (reads expo_push_token automatically).
     */
    public static function sendToUser($user, string $title, string $body, array $data = []): void
    {
        if (!empty($user->expo_push_token)) {
            self::send([$user->expo_push_token], $title, $body, $data);
        }
    }

    /**
     * Send to a collection of user models.
     */
    public static function sendToUsers($users, string $title, string $body, array $data = []): void
    {
        $tokens = collect($users)->pluck('expo_push_token')->filter()->values()->all();
        self::send($tokens, $title, $body, $data);
    }
}
