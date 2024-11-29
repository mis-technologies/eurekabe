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

        $limit = (int) $request->query('limit') ?? 100;
        $user = Auth::user();

        if($limit){
            $userNotifications = $user->notifications()->take($limit)->latest()->get();
        }else{
            $userNotifications = $user->notifications()->latest()->get();
        }

        

        //GET ALL ONE NOTIFICATION PER ENTITY
        $uniqueNotifications = collect($userNotifications)->unique(function ($item) {
            return $item->data['entity'] . $item->data['entity_id'];
        })->values()->all();

        return response()->json([
            'status' => 'success',
            'message' => 'all notifications retrieved successfully',
            'data' => $uniqueNotifications
        ]);
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUnreadNotifications(Request $request)
    {

        $limit = (int) $request->query('limit');

        if($limit){
            $userNotifications = Auth::user()->unreadNotifications->take($limit);
        }else{
            $userNotifications = Auth::user()->unreadNotifications;
        }


        //GET ALL ONE NOTIFICATION PER ENTITY
        $uniqueNotifications = collect($userNotifications)->unique(function ($item) {
            return $item->data['entity'] . $item->data['entity_id'];
        })->values()->all();

        return response()->json([
            'status' => 'success',
            'message' => 'all unread notifications retrieved successfully',
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
        $notification = Auth::user()->notifications()->where('id', $id)->first();

        $notification->markAsRead();
        return response()->json([
            'status' => 'success',
            'message' => 'successfully marked as read'
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
            'status' => 'success',
            'message' => 'All notifications successfully marked as read'
        ], 200);
    }

}
