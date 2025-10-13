<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = ['email', 'phone'];
    protected $hidden = ['created_at', 'updated_at'];
}
