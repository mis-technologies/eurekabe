<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Exam\Models\Exam;

class School extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'about',
        'year',
        'acronym',
        'city',
        'type',
        'rank',
        'state',
        'logo',
        'cover_image',
        'is_active',
    ];

    protected $dates = ['deleted_at'];

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
