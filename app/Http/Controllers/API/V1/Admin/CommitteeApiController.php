<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Committee;
use Illuminate\Http\Request;

class CommitteeApiController extends Controller
{
    public function index()
    {
        $committees = Committee::with('positions')->get()->map(function ($c) {
            return [
                'id' => $c->id,
                'name' => $c->name,
                'logo' => $c->logo ? asset('storage/' . $c->logo) : null,
                'established_date' => $c->established_date,
                'description' => $c->description,
                'long_description' => $c->long_description,
                'email' => $c->email,
                'members' => $c->members,
                'responsibilities' => $c->responsibilities ?? [],
                'meetings' => $c->meetings,
                'achievements' => $c->achievements ?? [],
                'image' => $c->image ? asset('storage/' . $c->image) : null,
                'impact_score' => $c->impact_score,
                'positions' => $c->positions->map(fn($p) => [
                    'position_name' => $p->position_name,
                    'holder_name' => $p->holder_name,
                ]),
            ];
        });

        return response()->json($committees, 200);
    }

    public function show($id)
    {
        $committee = Committee::with('positions')->find($id);
        if (!$committee) return response()->json(['message' => 'Committee not found'], 404);

        return response()->json([
            'id' => $committee->id,
            'name' => $committee->name,
            'logo' => $committee->logo ? asset('storage/' . $committee->logo) : null,
            'established_date' => $committee->established_date,
            'description' => $committee->description,
            'long_description' => $committee->long_description,
            'email' => $committee->email,
            'members' => $committee->members,
            'responsibilities' => $committee->responsibilities ?? [],
            'meetings' => $committee->meetings,
            'achievements' => $committee->achievements ?? [],
            'image' => $committee->image ? asset('storage/' . $committee->image) : null,
            'impact_score' => $committee->impact_score,
            'positions' => $committee->positions->map(fn($p) => [
                'position_name' => $p->position_name,
                'holder_name' => $p->holder_name,
            ]),
        ], 200);
    }
}
