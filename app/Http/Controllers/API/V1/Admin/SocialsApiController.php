<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialsApiController extends Controller
{
    /**
     * Display the socials.
     */
    public function index()
    {
        $social = Social::first();

        return response()->json([
            'status' => true,
            'message' => 'Social links fetched successfully.',
            'data' => $social,
        ]);
    }
}
