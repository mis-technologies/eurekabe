<?php

namespace Modules\Messaging\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Messaging\Models\Message;
use Modules\File\Facades\FileFacade;
use Modules\Messaging\Models\Conversation;

class MessageController extends Controller
{
   


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'string|sometimes',
            'to_user_id' => 'sometimes|exists:users,id',
            'package_id' => 'sometimes|exists:packages,id',
            'trip_id' => 'sometimes|exists:trips,id',
            'schedule_id' => 'sometimes|exists:schedules,id',
        ]);

        $authUser = auth()->user();
        if( isset($validated['to_user_id']) ){
            $validated['entity'] = 'App\Models\User';
            $validated['entity_id'] = $validated['to_user_id'];
        }

       
        //start conversation here if it doesn't exists before
        $conversation = Conversation::updateOrCreate(
            [ 'user_id' => $authUser->id,  'entity_id' =>  $validated['entity_id'], 'entity' => $validated['entity']   ],
            [ 
                'entity_id' =>  $validated['entity_id'], 
                'entity' => $validated['entity'], 
                'user_id' => $authUser->id
            ],
        );

       
        $message = Message::create([
            'conversation_id' => $conversation->id, 
            'user_id' => $authUser->id, 
            'to_user_id' => $validated['to_user_id'], 
            'text' => $validated['text'] 
        ]);

        // dd( $message );


        if( $request->files->count() ){
            $files = $request->files;
            foreach ($files as $key => $value) {
                FileFacade::publicFileUpload($value, $message, identifier: $key);  
            }
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Message sent successfully',
            'data' => $message
        ],200);
    }
    
   
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $mes = Message::whereUserId( $user->id)->whereId($id)->first();
        $mes->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Message deleted successfully',
        ],200);
    }
}
