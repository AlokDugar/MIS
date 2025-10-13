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

    protected $casts = [
        'date' => 'datetime',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(EventTag::class, 'event_tags_events');
    }

    // Event.php
    public function tags()
    {
        return $this->belongsToMany(EventTag::class, 'event_event_tag', 'event_id', 'event_tag_id');
    }
}
