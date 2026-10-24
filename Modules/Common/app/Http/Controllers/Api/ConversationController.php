<?php

namespace Modules\Common\Http\Controllers\Api;

use App\Models\ContentReport;
use App\Models\User;
use App\Models\UserBlock;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Events\MessageSentEvent;
use Modules\Common\Facades\FileFacade;
use Modules\Common\Http\Requests\StartConversationRequest;
use Modules\Common\Models\Conversation;
use Modules\Common\Models\Message;

class ConversationController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConversations()
    {
        $user = Auth::user();
        $conversations = Conversation::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere(function ($query) use ($user) {
                    $query->where('entity', 'App\Models\User')
                        ->where('entity_id', $user->id);
                });
        })->paginate(30);
        $conversations->setCollection($conversations->getCollection()->filter(function ($conversation) use ($user) {
            $otherId = $conversation->user_id == $user->id ? $conversation->entity_id : $conversation->user_id;
            return !UserBlock::existsBetween($user->id, (int) $otherId);
        })->values());
        return response()->json([
            'status' => 'success',
            'message' => 'User conversations retreived successfully',
            'data' => $conversations,
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
        $authUser = Auth::user();
        if ($validated['recipient_type'] == 'user') {
            $validated['entity'] = 'App\Models\User';
            $validated['entity_id'] = $validated['recipient_id'];
        }

        if ($validated['recipient_type'] == 'school') {
            $validated['entity'] = 'Modules\School\Models\School';
            $validated['entity_id'] = $validated['recipient_id'];
        }

        if ($validated['recipient_type'] == 'user' && UserBlock::existsBetween($authUser->id, (int) $validated['entity_id'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'You cannot message this user.',
            ], 403);
        }

        //start conversation here if it doesn't exists before
        $existingConversation = Conversation::where(function ($query) use ($authUser, $validated) {
            // First set of conditions as a group
            $query->where(function ($q) use ($authUser, $validated) {
                $q->where('user_id', $authUser->id)
                  ->where('entity_id', $validated['entity_id'])
                  ->where('entity', $validated['entity']);
            })
            // OR second set of conditions as a group
            ->orWhere(function ($q) use ($authUser, $validated) {
                $q->where('user_id', $validated['entity_id'])
                  ->where('entity_id', $authUser->id)
                  ->where('entity', $validated['entity']);
            });
        })->first();

        // If no conversation exists, then create a new one
        if (!$existingConversation) {
            $conversation = Conversation::create([
                'user_id' => $authUser->id,
                'entity_id' => $validated['entity_id'],
                'entity' => $validated['entity'],
            ]);
        } else {
            $conversation = $existingConversation;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Conversation started successfully',
            'data' => $conversation,
        ], 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSingleConversation(Request $request, $id)
    {
        if (!$conversation = Conversation::whereId($id)->orWhere('uuid', $id)->first()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Conversation not found',
            ], 400); //
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User conversation retrieved successfully',
            'data' => $conversation,
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConversationMessages(Request $request, $id)
    {

        if (!$conversation = Conversation::whereId($id)->orWhere('uuid', $id)->first()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Conversation not found',
            ], 400); //
        }

        
        
        // I should mark all conversations within the chat sent to the current logged in user, fetching the messages as read
        if ($conversation->entity == get_class(new User())) {
            $conversation->messages()->where('to_user_id', Auth::user()->id)->update(['read_at' => now()]);
        }

        $messages = $conversation->messages()->latest()->paginate(50);

        return response()->json([
            'status' => 'success',
            'message' => 'User conversation messages retrieved successfully',
            'data' => $messages,
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request, $id)
    {
        $authUser = Auth::user();
        if (!$conversation = Conversation::find($id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Conversation not found',
            ], 404);
        }

        $otherId = $conversation->user_id == $authUser->id ? $conversation->entity_id : $conversation->user_id;
        if ($conversation->entity == get_class(new User()) && UserBlock::existsBetween($authUser->id, (int) $otherId)) {
            return response()->json([
                'status' => 'error',
                'message' => 'You cannot message this user.',
            ], 403);
        }

        $payload = $request->validate([
            'text' => 'nullable|string|max:2000',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,webp,heic,heif,pdf|max:10240', // one photo or PDF, 10 MB
        ]);

        if (!filled($payload['text'] ?? null) && !$request->hasFile('file')) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Write a message or attach a photo or PDF.',
            ], 422);
        }

        $file = $request->file('file');
        unset($payload['file']);

        $payload['user_id'] = $authUser->id;
        if ($conversation->entity == get_class(new User())) {

            if ($payload['user_id'] == $conversation->entity_id) {
                $payload['to_user_id'] = $conversation->user_id;
            }

            //if the person that started the conversation is sending message
            if ($payload['user_id'] == $conversation->user_id) {
                $payload['to_user_id'] = $conversation->entity_id;
            }
        }
        $message = $conversation->messages()->create($payload);

        if ($file) {
            try {
                $isPdf = $file->getClientMimeType() === 'application/pdf';
                $isPdf
                    ? FileFacade::uploadRawFile($file, $message, null, 'chat')
                    : FileFacade::cloudinaryUpload($file, $message);
            } catch (\Throwable $e) {
                // Don't leave an empty message behind if the upload fails.
                $message->delete();
                report($e);

                return response()->json([
                    'status'  => 'error',
                    'message' => 'Could not upload your attachment. Please try again.',
                ], 422);
            }
        }

        event(new MessageSentEvent($message->load('files')));
        return response()->json([
            'success' => true,
            'message' => 'Conversations message created successfully',
            'data' => $conversation->messages()->latest()->limit(2)->get(),
        ]);
    }

    /**
     * Number of unread messages sent to the current user (for the home badge).
     */
    public function unreadCount()
    {
        $count = Message::where('to_user_id', Auth::id())->whereNull('read_at')->count();

        return response()->json(['status' => 'success', 'data' => ['count' => $count]]);
    }

    /**
     * Block a user. Blocked users cannot message the blocker and vice versa.
     */
    public function blockUser(Request $request, $userId)
    {
        $authUser = Auth::user();
        if ((int) $userId === $authUser->id || !User::whereKey($userId)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'Invalid user'], 422);
        }

        UserBlock::firstOrCreate(['blocker_id' => $authUser->id, 'blocked_id' => $userId]);

        return response()->json(['status' => 'success', 'message' => 'User blocked']);
    }

    public function unblockUser($userId)
    {
        UserBlock::where('blocker_id', Auth::id())->where('blocked_id', $userId)->delete();

        return response()->json(['status' => 'success', 'message' => 'User unblocked']);
    }

    /**
     * Report a user (and optionally a specific message) for objectionable behaviour.
     */
    public function reportUser(Request $request, $userId)
    {
        $data = $request->validate([
            'reason'          => 'required|string|in:spam,harassment,inappropriate,impersonation,other',
            'details'         => 'nullable|string|max:1000',
            'conversation_id' => 'nullable|integer',
            'message_id'      => 'nullable|integer',
        ]);

        if ((int) $userId === Auth::id() || !User::whereKey($userId)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'Invalid user'], 422);
        }

        ContentReport::create($data + [
            'reporter_id'      => Auth::id(),
            'reported_user_id' => $userId,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Report submitted. Our team will review it within 24 hours.']);
    }

    /**
     * Return online presence for a user.
     * "Online" = last_seen_at within the last 3 minutes.
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPresence($userId)
    {
        if (!$user = User::find($userId)) {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }

        $isOnline = $user->last_seen_at && $user->last_seen_at->gt(now()->subMinutes(3));

        return response()->json([
            'status' => 'success',
            'data'   => [
                'is_online'    => $isOnline,
                'last_seen_at' => $user->last_seen_at,
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteConversationMessage($id)
    {
        $user = Auth::user();
        $mes = Message::whereUserId($user->id)->whereId($id)->first();
        $mes->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Message deleted successfully',
        ], 200);
    }

}
