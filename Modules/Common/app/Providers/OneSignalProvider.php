<?php

namespace Modules\Common\Providers;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OneSignalProvider
{
    private static string $apiUrl = "https://onesignal.com/api/v1/notifications?c=push";
    
    

    /**
     * Send push notification to multiple users
     *
     * @param array $playerIds Array of OneSignal player IDs
     * @param string $title Notification title
     * @param string $message Notification message
     * @param array $additionalData Additional data to send with notification
     * @return array Response from OneSignal
     */
    public static function sendToUsers(
        array $playerIds,
        string $title,
        string $message,
        array $additionalData = []
    ): array {
        return self::send([
            'include_player_ids' => $playerIds,
            'contents' => ['en' => $message],
            'headings' => ['en' => $title],
            'data' => $additionalData
        ]);
    }

    /**
     * Send push notification to a segment
     *
     * @param string $segment Segment name
     * @param string $title Notification title
     * @param string $message Notification message
     * @param array $additionalData Additional data to send with notification
     * @return array Response from OneSignal
     */
    public static function sendToSegment(
        string $segment,
        string $title,
        string $message,
        array $additionalData = []
    ): array {
        return self::send([
            'included_segments' => [$segment],
            'contents' => ['en' => $message],
            'headings' => ['en' => $title],
            'data' => $additionalData
        ]);
    }

    /**
     * Send the actual notification
     *
     * @param array $data Notification data
     * @return array Response from OneSignal
     * @throws Exception
     */
    private static function send(array $data): array
    {
        try {
            $appId = env('ONESIGNAL_APP_ID');
            $apiKey = env('ONESIGNAL_REST_API_KEY');

            if (!$appId || !$apiKey) {
                throw new Exception('OneSignal credentials not configured');
            }

            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post(self::$apiUrl, array_merge([
                'app_id' => $appId,
            ], $data));

            // Log::info('OneSignal API Response', [
            //     'status' => $response->status(),
            //     'response' => $response->json(),
            //     'request' => $data
            // ]);

            if (!$response->successful()) {
                Log::error('OneSignal API Error', [
                    'status' => $response->status(),
                    'response' => $response->json(),
                    'request' => $data
                ]);
                throw new Exception('Failed to send notification: ' . $response->body());
            }

            return $response->json();
        } catch (Exception $e) {
            Log::error('OneSignal Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
