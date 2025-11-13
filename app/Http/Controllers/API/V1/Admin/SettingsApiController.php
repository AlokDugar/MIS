<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;


class SettingsApiController extends Controller
{
    public function index()
    {
        $settings = Setting::first();

        if (!$settings) {
            return response()->json([
                'status' => 'error',
                'message' => 'Settings not found',
                'data' => null
            ], 404);
        }

        // Prepend full URL to image fields
        $settings->site_logo = $settings->site_logo ? asset('storage/' . $settings->site_logo) : null;
        $settings->dashboard_logo = $settings->dashboard_logo ? asset('storage/' . $settings->dashboard_logo) : null;
        $settings->favicon = $settings->favicon ? asset('storage/' . $settings->favicon) : null;

        return response()->json([
            'status' => 'success',
            'message' => 'Settings retrieved successfully',
            'data' => $settings
        ], 200);
    }
}
