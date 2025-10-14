<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventApiController extends Controller
{
    // List all events
    public function index()
    {
        $events = Event::with('tags')->get();
        return response()->json($events, 200);
    }

    // Show single event
    public function show($id)
    {
        $event = Event::with('tags')->find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        return response()->json($event, 200);
    }
}
