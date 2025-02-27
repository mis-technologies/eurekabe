<?php

namespace Modules\Messaging\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Messaging\Models\Message;
use Webpatser\Uuid\Uuid;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity', // project, campaing, collaboration, chat, user
        'entity_id', //1101
        'user_id', //1105
        'uuid',
    ];

    public $appends = ['recent_message', 'unread_count', 'heading', 'date', 'is_delivery_request'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getRecentMessageAttribute()
    {
        return Message::where('conversation_id', $this->id)->latest()->first();
    }

    public function getIsDeliveryRequestAttribute()
    {
        if ($this->entity == 'Modules\Trip\Entities\PackageDelivery') {
            return true;
        } else {
            return false;
        }
    }

    public function getQuickActionsAttribute()
    {
        // $actions = [];
        // if($this->entity === 'Modules\Trip\Entities\PackageDelivery' ){
        //     if($delivery  = PackageDelivery::find($this->entity_id)){
        //        if($delivery->status==='pending'){
        //             $actions['accept'] = route('deliveries.accept', $delivery->id);
        //             $actions['close'] = route('deliveries.close', $delivery->id);
        //             $actions['bid'] = route('deliveries.bid', $delivery->id);
        //             $actions['reject'] = route('deliveries.reject', $delivery->id);
        //        }
        //     }
        // }
        // return $actions;
    }

    public function getUnreadCountAttribute()
    {
        return Message::where('conversation_id', $this->id)->whereNull('read_at')->count();
    }
    public function getDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getHeadingAttribute()
    {
        $user = User::find($this->user_id);
        $entityUser = User::find($this->entity_id);

        $recentMessage = Message::where('conversation_id', $this->id)->latest()->first();
        $authUserId = Auth::user()->id;
        if ($user->id == $authUserId) {
            return [
                'name' => $entityUser->name,
                'profile_pic' => $entityUser->profile_pic,
                'recent_message' => $recentMessage->text ?? 'New conversation',
                'recent_message_created_at' => $recentMessage->created_at ?? $this->created_at,
            ];
        } else {
            return [
                'name' => $user->name,
                'profile_pic' => $user->profile_pic,
                'recent_message' => $recentMessage->text ?? 'New conversation',
                'recent_message_created_at' => $recentMessage->created_at ?? $this->created_at,
            ];
        }

    }

    public function getEntityDetailsAttribute()
    {
        return app($this->entity)::findOrFail($this->entity_id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'conversation_user');
    }

    public function scopeDm($query)
    {
        return $query->where('entity', 'App\Models\User');
    }

    public function scopeTicket($query)
    {
        return $query->where('entity', 'Modules\Support\Entities\SupportTicket');
    }

    public function participants()
    {
        $messages = collect($this->messages)->unique(function ($item) {
            return $item->user_id . $item->to_user_id;
        });

        $participants = $messages->map(function ($me) {
            return $me->toUser;
        });

        return $participants;
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($conv) {
            $conv->uuid = Uuid::generate(4)->__get('string'); // string, hex, uuid_ordered
        });

        static::retrieved(function ($conv) {

        });

    }
}
