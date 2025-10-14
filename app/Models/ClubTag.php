<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubTag extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    public function clubs()
    {
        return $this->belongsToMany(Club::class, 'club_tags_clubs', 'tag_id', 'club_id');
    }
}
