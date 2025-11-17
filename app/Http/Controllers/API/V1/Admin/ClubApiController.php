<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubApiController extends Controller
{
    public function index()
    {
        $clubs = Club::with('tags')->get()->map(function ($club) {
            return [
                'id' => $club->id,
                'name' => $club->name,
                'logo' => $club->logo ? asset('storage/' . $club->logo) : null,
                'president' => $club->president,
                'established_date' => $club->established_date,
                'members' => $club->members,
                'description' => $club->description,
                'co_chair' => $club->co_chair,
                'tags' => $club->tags->map(fn($tag) => $tag->name),
            ];
        });

        return response()->json($clubs, 200);
    }

    public function show($id)
    {
        $club = Club::with('tags')->find($id);

        if (!$club) {
            return response()->json(['message' => 'Club not found'], 404);
        }

        return response()->json([
            'id' => $club->id,
            'name' => $club->name,
            'logo' => $club->logo ? asset('storage/' . $club->logo) : null,
            'president' => $club->president,
            'established_date' => $club->established_date,
            'members' => $club->members,
            'description' => $club->description,
            'co_chair' => $club->co_chair,
            'tags' => $club->tags->map(fn($tag) => $tag->name),
        ], 200);
    }
}
