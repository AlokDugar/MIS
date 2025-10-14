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
    ];

    protected $casts = [
        'established_date' => 'date',
    ];

    public function tags()
    {
        return $this->belongsToMany(ClubTag::class, 'club_tags_clubs', 'club_id', 'tag_id');
    }
}
