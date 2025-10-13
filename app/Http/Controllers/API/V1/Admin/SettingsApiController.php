<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;


class SettingsApiController extends Controller
{
    public function index()
    {
        $settings = Setting::first();

        return response()->json([
            'data' => $settings
        ], 200);
    }
}
