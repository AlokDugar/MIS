<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Models\AboutUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsApiController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();

        return response()->json([
            'data' => $about
        ], 200);
    }
}
