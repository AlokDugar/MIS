<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $fillable = [
        'id',
        'name',
        'image_path',
        'date',
        'description'
    ];
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(EventTag::class, 'event_tags_events');
    }
}
