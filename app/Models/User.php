<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Common\Models\School;
use Modules\File\Models\File;

class User extends Authenticatable 
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    
    public function schools()
    {
        return $this->belongsToMany(School::class)->withPivot('role');
    }


    public function getImageAttribute(){
        if(!$profilePic = File::whereUserId($this->id)->where('identifier', 'profile_pic')->first() ){
            return "https://ui-avatars.com/api/?name={$this->firstname } {$this->lastname }&color=184391&background=fff"; //999
        }
        return $profilePic->url;
    }
   
}
