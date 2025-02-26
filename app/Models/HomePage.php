<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    //
    protected $table = 'home_pages';
    protected $fillable = [
        'herosection', 
        'whoarewe', 
        'socialsection', 
        'whatweoffer', 
        'teamsection', 
        'downloadsection', 
        'engagementsection',
       
    ];
}
