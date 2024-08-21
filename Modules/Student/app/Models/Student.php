<?php

namespace Modules\Student\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Student\Database\Factories\StudentFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'school_id', 'status', 'is_verified', 'approver_id', 'verified_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}

