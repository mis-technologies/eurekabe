<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Models\Category;
use Modules\Common\Database\Factories\SubjectFactory;

class Subject extends Model
{
    protected $fillable = ['name', 'category_id', 'description', 'image', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class,'subject_id');
    }
}
