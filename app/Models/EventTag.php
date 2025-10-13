<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EventTag extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_tags_events');
    }
}
