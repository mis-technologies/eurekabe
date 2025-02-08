<?php

namespace Modules\Messaging\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Messaging\Models\Message;
use App\Models\User;
use Webpatser\Uuid\Uuid;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity', // project, campaing, collaboration, chat, user
        'entity_id', //1101
        'user_id', //1105
        'uuid' 
    ];

    public $appends = ['recent_message', 'unread_count', 'heading', 'date', 'is_delivery_request'];
    
    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function getRecentMessageAttribute(){
        return Message::where('conversation_id', $this->id)->latest()->first();
    }

    public function getIsDeliveryRequestAttribute(){
        if($this->entity == 'Modules\Trip\Entities\PackageDelivery'){
            return true;
        }else{
            return false;
        }
    }

    public function getQuickActionsAttribute(){
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

    public function getUnreadCountAttribute(){
        return Message::where('conversation_id', $this->id)->whereNull('read_at')->count();
    }
    public function getDateAttribute(){
        return $this->created_at->diffForHumans();
    }


    public function getHeadingAttribute(){
        $user = User::find($this->user_id);
        $entityUser = User::find($this->entity_id);
        
        $recentMessage = Message::where('conversation_id', $this->id)->latest()->first();
        if($recentMessage){
          
           $recentToUser = User::find($recentMessage->to_user_id);
           $recentFromUser = User::find($recentMessage->user_id);
        
            if ($this->entity == 'App\Models\User' ) {
                if( $recentToUser && $recentFromUser){
                    $user = auth()->user();
                    if ($user->id == $recentToUser->id ) {
                        return [
                            'name' => $recentFromUser->name,
                            'profile_pic' => $recentFromUser->profile_pic,
                            'recent_message' => $recentMessage->text,
                            'recent_message_created_at' => $recentMessage->created_at,
                        ];
                    }else {
                        return [
                            'name' => $recentToUser->name,
                            'profile_pic' => $recentToUser->profile_pic,
                            'recent_message' => $recentMessage->text,
                            'recent_message_created_at' => $recentMessage->created_at,
                        ];
                    }
        
                }
            }



        }


       
    }


    public function getEntityDetailsAttribute(){
       return app($this->entity)::findOrFail($this->entity_id) ;       
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function users(){
        return $this->belongsToMany(User::class, 'conversation_user');
    }
  
    public function scopeDm($query)
    {
        return $query->where('entity', 'App\Models\User' );
    }

    public function scopeTicket($query)
    {
        return $query->where('entity', 'Modules\Support\Entities\SupportTicket' );
    }


    public function participants(){
        $messages = collect($this->messages )->unique(function ($item) {
            return $item->user_id . $item->to_user_id;
        });

        $participants = $messages->map(function ($me) {
            return $me->toUser;
        });
       

        return $participants;
    }
   

    public static function boot(){
        parent::boot();
        static::creating(function($conv) {
            $conv->uuid = Uuid::generate(4)->__get('string'); // string, hex, uuid_ordered
        });

        static::retrieved(function($conv) {
            
        });

       
        
        

    }
}
