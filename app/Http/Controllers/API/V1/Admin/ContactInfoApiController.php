<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;

class ContactInfoApiController extends Controller
{
    public function index()
    {
        $info = ContactInfo::first();

        return response()->json([
            'data' => $info
        ], 200);
    }
}
