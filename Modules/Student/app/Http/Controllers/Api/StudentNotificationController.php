<?php

namespace Modules\Student\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Events\SocketEvent;

class StudentNotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotifications(Request $request)
    {
        $perPage = $request->query('per_page', 10); // Default per_page to 10 if not provided
        $unread = filter_var($request->query('unread', false), FILTER_VALIDATE_BOOLEAN); // Default unread to false
        $user = Auth::user();

        // Validate per_page
        if (!is_numeric($perPage) || $perPage <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid per_page parameter',
            ], 400);
        }

        // Fetch notifications based on the unread parameter
        if ($unread) {
            $notificationsQuery = $user->unreadNotifications();
        } else {
            $notificationsQuery = $user->notifications();
        }

        // Apply pagination and fetch notifications
        $paginatedNotifications = $notificationsQuery->latest()->paginate($perPage);

        // Filter unique notifications by entity and entity_id
        $uniqueNotifications = $paginatedNotifications->getCollection()->unique(function ($item) {
            return $item->data['entity'] . $item->data['entity_id'];
        })->values()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->data['title'] ?? null,
                'text' => $item->data['text'] ?? null,
                'meta' => is_array($item->data['meta'] ?? null) ? $item->data['meta'] : null,
                'entity' => $item->data['entity'] ?? null,
                'entity_id' => $item->data['entity_id'] ?? null,

                'read_at' => $item->read_at,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        // Replace the collection in the paginator with the unique notifications
        $paginatedNotifications->setCollection($uniqueNotifications);

        return response()->json([
            'success' => true,
            'message' => 'Notifications retrieved successfully',
            'data' => $paginatedNotifications,
        ]);
    }

    /**
     * Mark user's notification as read.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead(Request $request, $id)
    {
        if (!$notification = Auth::user()->notifications()->where('id', $id)->first()) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found',
            ], 404);
        }
        $notification->markAsRead();
        return response()->json([
            'success' => true,
            'message' => 'successfully marked as read',
        ], 200);
    }

    /**
     * Mark user's notification as read.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSingle(Request $request, $id)
    {
        if (!$notification = Auth::user()->notifications()->where('id', $id)->first()) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Retrieved successfully',
            'data' => [
                'id' => $notification->id,
                'title' => $notification->data['title'] ?? null,
                'text' => $notification->data['text'] ?? null,
                'meta' => is_array($notification->data['meta'] ?? null) ? $notification->data['meta'] : null,
                'entity' => $notification->data['entity'] ?? null,
                'entity_id' => $notification->data['entity_id'] ?? null,

                'read_at' => $notification->read_at,
                'created_at' => $notification->created_at,
                'updated_at' => $notification->updated_at,
            ],
        ], 200);
    }

    /**
     * Mark all user's notifications as read.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAllRead(Request $request)
    {
        $request->user()
            ->unreadNotifications()
            ->get()->each(function ($n) {
            $n->markAsRead();
        });
        event(new SocketEvent([], Auth::user()->email, 'Notification'));
        return response()->json([
            'success' => true,
            'message' => 'All notifications successfully marked as read',
        ], 200);
    }

}
