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
                'email' => $c->email,
                'members' => $c->members,
                'responsibilities' => $c->responsibilities ?? [],
                'meetings' => $c->meetings,
                'achievements' => $c->achievements ?? [],
                'impact_score' => $c->impact_score,
                'chair' => $c->chair,
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
            'email' => $committee->email,
            'members' => $committee->members,
            'responsibilities' => $committee->responsibilities ?? [],
            'meetings' => $committee->meetings,
            'achievements' => $committee->achievements ?? [],
            'impact_score' => $committee->impact_score,
            'chair' => $committee->chair,
            'positions' => $committee->positions->map(fn($p) => [
                'position_name' => $p->position_name,
                'holder_name' => $p->holder_name,
            ]),
        ], 200);
    }
}
