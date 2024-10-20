<?php

namespace Modules\File\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\File\Entities\File;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'entity',
        'entity_id',
        'is_kyc',
        'reference',
        'active',
        'status',
        'is_verified',
        'is_verified_by',
        'verified_at',
    ];

    public $with = ['file', 'meta'];

    public function file(){
        return $this->hasOne(File::class, 'entity_id')->where('entity', get_class($this) );
    }
    public function meta(){
        return $this->hasMany(DocumentMeta::class);
    }
    
    protected static function newFactory()
    {
        // return \Modules\Project\Database\factories\DocumentFactory::new();
    }
}
