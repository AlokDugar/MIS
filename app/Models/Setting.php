<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['website_name', 'site_logo', 'dashboard_logo', 'favicon'];
    protected $hidden = ['created_at', 'updated_at'];
}
