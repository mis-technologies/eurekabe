<?php

namespace Modules\File\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;


class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'disk',
        'entity',
        'entity_id',
        'filename',
        'path',
        'extension',
        'mime',
        'identifier',
        'size',
    ];

    public $appends = ['url'];

    protected $hidden = [
        'disk',
        'entity',
        'entity_id',
        'path',
    ];

    public function getUrlAttribute(){
        $path = rawurlencode($this->path);
        $fileLink =  Storage::disk($this->disk)->url($path);
        return $fileLink;
    }


    // public function getUrlAttribute(){
    //     $path = rawurlencode($this->path);
    //     $fileLink =  Storage::disk($this->disk)->url($path);
    //     return $fileLink;
    // }
    
}
