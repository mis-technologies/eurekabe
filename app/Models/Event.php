<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = 'events';
    protected $fillable = [
        'title',
        'type',
        'start_datetime',
        'end_datetime',
        'location',
        'price',
        'description',
        'speakers',
        'sponsors',
        'special_bonus',
        'status',
        'reg_link',
        'image',
        'cta_text', 
    ];
    protected $casts = [
        'speakers' => 'array',
        'sponsors' => 'array'
    ];
}
