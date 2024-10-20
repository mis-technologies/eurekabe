<?php

namespace Modules\File\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'name',
        'value',
    ];
    
    protected static function newFactory()
    {
        // return \Modules\File\Database\factories\DocumentMetaFactory::new();
    }
}
