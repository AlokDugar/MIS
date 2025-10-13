<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'date',
        'description',
    ];

    /**
     * Relationship: An event can have multiple tags.
     */
    public function tags()
    {
        return $this->belongsToMany(EventTag::class, 'event_event_tag', 'event_id', 'event_tag_id')
            ->withTimestamps();
    }
}
