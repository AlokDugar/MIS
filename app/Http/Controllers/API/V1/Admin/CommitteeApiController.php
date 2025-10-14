<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Committee;
use Illuminate\Http\Request;

class CommitteeApiController extends Controller
{
    // List all committees
    public function index()
    {
        $committees = Committee::with('positions')->get();
        return response()->json($committees, 200);
    }

    // Show single committee
    public function show($id)
    {
        $committee = Committee::with('positions')->find($id);
        if (!$committee) {
            return response()->json(['message' => 'Committee not found'], 404);
        }
        return response()->json($committee, 200);
    }
}
