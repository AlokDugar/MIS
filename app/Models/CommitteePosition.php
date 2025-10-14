<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteePosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_id',
        'position_name',
        'holder_name',
    ];

    /**
     * Get the committee that this position belongs to
     */
    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }
}
