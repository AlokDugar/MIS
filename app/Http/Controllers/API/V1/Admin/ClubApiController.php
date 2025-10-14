<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubApiController extends Controller
{
    public function index()
    {
        $clubs = Club::with('tags')->get();
        return response()->json($clubs, 200);
    }

    // Show single club
    public function show($id)
    {
        $club = Club::with('tags')->find($id);
        if (!$club) {
            return response()->json(['message' => 'Club not found'], 404);
        }
        return response()->json($club, 200);
    }
}
