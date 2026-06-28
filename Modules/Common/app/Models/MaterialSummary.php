<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialSummary extends Model
{
    protected $fillable = ['material_id', 'length_type', 'content'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
