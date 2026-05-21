<?php

namespace Modules\Common\Models;

// use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class Notification extends DatabaseNotification
{
    use HasFactory;

    protected $fillable = [];


    public $appends = ['payload', 'quick_actions'];

    public $hidden = ['data'];

    public function getActorAttribute(){

        $user = Auth::user();
        $entity = $this->data['entity'];
        if($entity = get_class($user)){
            return $entity::find($this->data['entity_id']);
        }
        return null;
    }

    public function getPayloadAttribute(){
        $user = Auth::user();
        $entity = $this->getAttribute('data')['entity'];
        $payload['text'] = $this->data['text'];
        $payload['title'] = $this->data['title'];
        $payload['entity'] = $entity;

        if($entity == get_class( $user) && User::find($this->getAttribute('data')['entity_id'])  ){
            $entity = get_class( $user);
            $actor =  $entity::find($this->getAttribute('data')['entity_id']);
            $payload['name'] = $actor->name ?? '';
            $payload['image'] = $actor->profile_pic ?? '';
        }else{
            $payload['name'] = 'App';
            $payload['image'] = "https://ui-avatars.com/api/?name=I&color=FFFFFF&background=DF475C";
        }

        return $payload;
    }


    public function getQuickActionsAttribute(){
        $actions = [];
       
        if($this->getAttribute('data')['entity'] == 'Modules\Transaction\\Entities\Transaction'){
            $actions['view_notification'] = route('transactions.show', $this->getAttribute('data')['entity_id']);
        }

        if($this->getAttribute('data')['entity'] == 'Modules\Common\\Entities\Conversation'){
            $actions['view_conversation'] = route('transactions.show', $this->getAttribute('data')['entity_id']);
        }

        if($this->getAttribute('data')['entity'] == 'Modules\Trip\\Entities\Trip'){
            $actions['view_trip'] = route('transactions.show', $this->getAttribute('data')['entity_id']);
        }

        return $actions;
    }

    public function getCreatedAtAttribute(){
        return \Illuminate\Support\Carbon::createFromDate($this->attributes['created_at'])->diffForHumans();
    }
    
    
}
