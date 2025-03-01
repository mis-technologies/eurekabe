<?php

namespace Modules\Common\Models;;

use App\Models\User;
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
    // appends advocate
    public $appends = ['advocate', 'student_count'];

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role');
    }

    public function getAdvocateAttribute(){
        if(! $advocate = User::where('school_id', $this->id)->where('role', 'advocate')->first()){
            $advocate = User::where('email', 'advocate@eureka.live')->first();

        }
        return [
            'id' => $advocate->id,
            'firstname' => $advocate->firstname,
            'lastname' =>$advocate->lastname,
            'email' => $advocate->email
        ];

    }

    public function getStudentCountAttribute(){
        return User::where('school_id', $this->id)->where('role', 'student')->count();
    }
}


// Attaching a User with a Specific Role:
// $school->users()->attach($user->id, ['role' => 'advocate']);


// Updating a User's Role:
// $school->users()->updateExistingPivot($user->id, ['role' => 'follower']);


// You can filter users based on their role in a specific school:
//     $advocates = $school->users()->wherePivot('role', 'advocate')->get();
