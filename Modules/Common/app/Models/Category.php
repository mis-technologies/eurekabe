<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Database\Factories\CategoryFactory;
use Modules\Exam\Models\Subject;

class Category extends Model
{
    protected $guarded = [];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
