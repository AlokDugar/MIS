<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClubTag;

class ClubTagApiController extends Controller
{
    public function index()
    {
        $tags = ClubTag::all();
        return response()->json($tags, 200);
    }

    public function show($id)
    {
        $tag = ClubTag::find($id);
        if (!$tag) {
            return response()->json(['message' => 'Tag not found'], 404);
        }
        return response()->json($tag, 200);
    }
}
