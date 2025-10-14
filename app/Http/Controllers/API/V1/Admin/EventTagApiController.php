<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventTag;
use Illuminate\Http\Request;

class EventTagApiController extends Controller
{
    public function index()
    {
        $tags = EventTag::all();
        return response()->json($tags, 200);
    }

    // Show a single tag
    public function show($id)
    {
        $tag = EventTag::find($id);
        if (!$tag) {
            return response()->json(['message' => 'Tag not found'], 404);
        }
        return response()->json($tag, 200);
    }
}
