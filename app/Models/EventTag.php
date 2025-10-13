<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Relationship: A tag can belong to multiple events.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_event_tag', 'event_tag_id', 'event_id')
            ->withTimestamps();
    }
}
