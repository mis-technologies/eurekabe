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

        $limit = (int) $request->query('limit');
        $unread = (boolean) $request->query('unread');
        $user = Auth::user();

        if($limit){
            if($unread){
                $userNotifications = Auth::user()->unreadNotifications->take($limit);
            }else{
                $userNotifications = $user->notifications()->take($limit)->latest()->get();
            }
        }
        //GET ALL ONE NOTIFICATION PER ENTITY
        $uniqueNotifications = collect($userNotifications)->unique(function ($item) {
            return $item->data['entity'] . $item->data['entity_id'];
        })->values()->all();

        return response()->json([
           'success' => true,
            'message' => 'Notifications retrieved successfully',
            'data' => $uniqueNotifications
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
        if(!$notification = Auth::user()->notifications()->where('id', $id)->first()){
            return response()->json([
                'success' => false,
                'message' => 'Notification not found'
            ], 404);
        }
        $notification->markAsRead();
        return response()->json([
           'success' => true,
            'message' => 'successfully marked as read'
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
        if(!$notification = Auth::user()->notifications()->where('id', $id)->first()){
            return response()->json([
                'success' => false,
                'message' => 'Notification not found'
            ], 404);
        }
        return response()->json([
           'success' => true,
            'message' => 'Retrieved successfully',
            'data' => $notification
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
        event(new SocketEvent( [], Auth::user()->email, 'Notification'));
        return response()->json([
           'success' => true,
            'message' => 'All notifications successfully marked as read'
        ], 200);
    }

}
