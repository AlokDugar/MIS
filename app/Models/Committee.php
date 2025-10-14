<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'established_date',
        'description',
    ];

    protected $dates = ['established_date'];

    /**
     * Get all positions for this committee
     */
    public function positions()
    {
        return $this->hasMany(CommitteePosition::class);
    }
}
