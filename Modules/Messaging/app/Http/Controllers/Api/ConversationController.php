<?php

namespace Modules\Messaging\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Messaging\Models\Conversation;
use Modules\Messaging\Events\MessageSentEvent;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = auth()->user();
        $conversations = Conversation::whereUserId($user->id)->paginate(3);
        return response()->json([
            'status' => 'success',
            'message' => 'User conversations retreived successfully',
            'data' => $conversations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {   
        $payload = $request->validate([
            'text' => 'required',
            'conversation_id' => 'required',
        ]);

        $conversation = Conversation::findOrFail($payload['conversation_id']);
        $payload['user_id'] = auth()->user()->id;
        $payload['user_id'] = auth()->user()->id;
        $message = $conversation->messages()->create($payload);
        event( new MessageSentEvent( $message) );
        return response()->json([
            'status' => 'success',
            'message' => 'Conversation created successfully',
            'data' => $conversation
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request,  $id)
    {

       
        if(!$conversation = Conversation::whereId($id)->orWhere('uuid', $id)->first()){
            return response()->json([
                'status' => 'error',
                'message' => 'Conversation not found',
            ], 400); //
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User conversation retrieved successfully',
            'data' => $conversation
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages(Request $request, $id)
    {
       
        if(!$conversation = Conversation::whereId($id)->orWhere('uuid', $id)->first()){
            return response()->json([
                'status' => 'error',
                'message' => 'Conversation not found',
            ], 400); //
        }
        $messages = $conversation->messages()->latest()->paginate(50);
        return response()->json([
            'status' => 'success',
            'message' => 'User conversation messages retrieved successfully',
            'data' => $messages
        ]);
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request, $id)
    {
        $authUser = auth()->user();
        if(!$conversation = Conversation::find($id) ){
            return response()->json([
                'status' => 'error',
                'message' => 'Conversation not found',
            ], 404); 
        }

        $payload = $request->validate([
            'text' => 'sometimes'
        ]);
       
        $payload['user_id'] = $authUser->id;
        if($conversation->entity == get_class(new User() )){
            
            if($payload['user_id'] == $conversation->entity_id  ){
                $payload['to_user_id'] = $conversation->user_id;
            }
            
            //if the person that started the conversation is sending message
            if($payload['user_id'] == $conversation->user_id  ){
                $payload['to_user_id'] = $conversation->entity_id;
            }
        }
        $conversation->messages()->create($payload);
        return response()->json([
            'status' => 'success',
            'message' => 'Conversations message created successfully',
            'data' => $conversation->messages()->latest()->with('files')->limit(2)->get(),
        ]);
    }


}
