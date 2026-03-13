<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerApplication extends Model
{
    use HasFactory;

    protected $table = 'volunteer_applications';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'university',
        'course',
        'graduation_year',
        'motivation',
        'experience',
        'skills',
        'status',
        'admin_notes',
        'reviewed_at',
        'reviewed_by',
    ];

    protected $casts = [
        'skills' => 'array',
        'reviewed_at' => 'datetime',
    ];
}
