<?php

namespace Modules\Messaging\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Modules\Messaging\Models\Conversation;
use App\Models\User;
use Modules\File\Models\File;
use Modules\Messaging\Events\MessageSentEvent;
use Webpatser\Uuid\Uuid;


class Message extends Model
{
    use HasFactory;

    protected $fillable = ['conversation_id', 'user_id', 'to_user_id', 'text', 'read_at', 'uuid'];

    public $appends = ['is_own'];

    public $with = ['from', 'to', 'files'];

    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }

    public function files(){
        return $this->hasMany(File::class, 'entity_id')->where('entity', get_class($this) );
    }

    public function from(){
        return $this->belongsTo(User::class, 'user_id')
        ->select('id', 'firstname', 'username', 'lastname', 'image', 'email');
    }

    public function to(){
        return $this->belongsTo(User::class, 'to_user_id')
        ->select('id', 'firstname', 'username', 'lastname', 'image', 'email');
    }

    public function getIsOwnAttribute(){
        return auth()->user()->id === $this->user_id;
    }


    // public function getCreatedAtAttribute(){
    //     return Carbon::createFromDate($this->attributes['created_at'])->diffForHumans();
    // }
    
    public static function boot(){
        parent::boot();
        static::creating(function($message){
            $message->uuid = Uuid::generate(4)->__get('string'); // string, hex, uuid_ordered
        });
        static::created(function($message) {

            if( request()['files'] ){
                $files = request()['files'];
                foreach ($files as $key => $value) {
                    \Modules\File\Facades\FileFacade::cloudinaryUpload($value, $message, identifier: $key);  
                }
            }
            
         });

    }

}


