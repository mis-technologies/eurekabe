<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialResource extends Model
{
    protected $fillable = ['material_id', 'title', 'type', 'description', 'author'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
