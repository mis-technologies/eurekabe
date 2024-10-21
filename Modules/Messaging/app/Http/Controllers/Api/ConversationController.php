<?php

namespace Modules\Messaging\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\File\Facades\FileFacade;
use Modules\Messaging\Models\Conversation;
use Modules\Messaging\Events\MessageSentEvent;
use Modules\Messaging\Http\Requests\StartConversationRequest;
use Modules\Messaging\Models\Message;

class ConversationController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConversations()
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
    public function startConversation(StartConversationRequest $request)
    {
        $validated = $request->validated();
        $authUser = auth()->user();
        if( $validated['recipient_type'] == 'user' ){
            $validated['entity'] = 'App\Models\User';
            $validated['entity_id'] = $validated['recipient_id'];
        }

        if( $validated['recipient_type'] == 'school' ){
            $validated['entity'] = 'Modules\School\Models\School';
            $validated['entity_id'] = $validated['recipient_id'];
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
            'to_user_id' => $validated['recipient_id'], 
            'text' => $validated['text'] 
        ]);


        if( $request->files->count() ){
            $files = $request->files;
            foreach ($files as $key => $value) {
                FileFacade::defaultUpload($value, $message, identifier: $key);  
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Message sent successfully',
            'data' => $message
        ],200);
    }



   
    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSingleConversation(Request $request,  $id)
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
    public function getConversationMessages(Request $request, $id)
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
        $message = $conversation->messages()->create($payload);
        event( new MessageSentEvent( $message) );
        return response()->json([
            'success' => true,
            'message' => 'Conversations message created successfully',
            'data' => $conversation->messages()->latest()->with('files')->limit(2)->get(),
        ]);
    }



     /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteConversationMessage($id)
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
