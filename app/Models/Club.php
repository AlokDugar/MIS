<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'president',
        'members',
        'established_date',
        'description',
        'full_description',
        'activities',
        'color',
        'chair',
        'co_chair',
    ];

    protected $casts = [
        'established_date' => 'date',
        'activities' => 'array',
    ];

    public function tags()
    {
        return $this->belongsToMany(ClubTag::class, 'club_tags_clubs', 'club_id', 'tag_id');
    }
}
