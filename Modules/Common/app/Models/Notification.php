<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    use HasFactory;

    protected $fillable = [];

    public $appends = ['payload'];
    public $hidden  = ['data'];

    public function getPayloadAttribute(): array
    {
        $data = $this->getAttribute('data') ?? [];

        return [
            'title'     => $data['title']     ?? null,
            'text'      => $data['text']      ?? null,
            'entity'    => $data['entity']    ?? null,
            'entity_id' => $data['entity_id'] ?? null,
            'meta'      => $data['meta']      ?? null,
        ];
    }

    public function getCreatedAtAttribute(): string
    {
        return \Illuminate\Support\Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }
}
