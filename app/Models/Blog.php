<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Blog extends Model
{
    //
    protected $table = 'blogs';
    protected $fillable = ['title', 'content','image',  'slug', 'category_id',  'status'];



    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
