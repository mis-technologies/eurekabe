<?php

namespace Modules\Common\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Common\Database\Factories\ExamFeedbackFactory;

class ExamFeedback extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'exam_id',
        'rating',
        'feedback',
    ];

    public $appends = [ 'user', 'date' ];

    public function getUserAttribute()
    {
        $user = User::find($this->user_id);
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image' => $user->image,
        ];
    }

    public function getDateAttribute()
    {
        return $this->created_at->format('d M Y');
    }

    // protected static function newFactory(): ExamFeedbackFactory
    // {
    //     // return ExamFeedbackFactory::new();
    // }
}
