<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Common\Models\School;
use Modules\File\Models\File;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Support\Str;



class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'email_verified_at',
        'password',
        'role',
        'school_id',
        'verified_by',
        'verified_at',
        'username',
        'interest',
        'about',
        'mobile',
        'ref_by',
        'balance',
        'image',
        'address',
        'status',
        'ev',
        'sv',
        'ver_code',
        'ver_code_send_at',
        'ts',
        'tv',
        'tsc',
        'provider',
        'provider_id',
        'gender',
        'level',
        'cgpa',
        'leading_experience',
        'position',
        'leading_attribute',
        'refereed_by',
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

    public $appends = ['name', 'image'];

    public function canAccessPanel(Panel $panel): bool
    {
        // return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
        return true;
    }

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
            'interest' => 'array',
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

    public function getImageAttribute()
    {
        if (!$profilePic = File::whereUserId($this->id)->where('identifier', 'profile_pic')->first()) {
            return "https://ui-avatars.com/api/?name={$this->firstname} {$this->lastname}&color=184391&background=fff";
        }
        return $profilePic->url;
    }

    public function getNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    private function generateSlug($name)
    {
        if (static::whereUsername($slug = Str::slug($name, '-'))->exists()) {
            $user = static::latest('id')->first();
            return "{$slug}" . $user->id + rand();
        }
        return $slug;
    }

    public function generateUsername()
    {
        if (!$this->username) {
            $this->username = $this->generateSlug($this->firstname . $this->lastname);
            $this->save();
        }
    }
}