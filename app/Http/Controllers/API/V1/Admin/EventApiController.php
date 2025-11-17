<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventApiController extends Controller
{
    // List all events
    public function index()
    {
        $events = Event::with('tags')
            ->orderBy('date', 'desc') // Order by date descending
            ->get()
            ->map(function ($event) {
                $status = 'Upcoming';
                if ($event->date && Carbon::parse($event->date)->isPast()) {
                    $status = 'Expired';
                }

                return [
                    'id' => $event->id,
                    'title' => $event->name,
                    'description' => $event->description,
                    'date' => $event->date ? Carbon::parse($event->date)->format('F d, Y') : 'TBA',
                    'time' => $event->time,
                    'location' => $event->location,
                    'image' => $event->image_path ? asset('storage/' . $event->image_path) : null,
                    'status' => $status,
                    'tags' => $event->tags->map(fn($tag) => $tag->name),
                ];
            });

        return response()->json($events, 200);
    }


    // Show single event
    public function show($id)
    {
        $event = Event::with('tags')->find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $status = 'upcoming';
        if ($event->date && Carbon::parse($event->date)->isPast()) {
            $status = 'expired';
        }

        return response()->json([
            'id' => $event->id,
            'title' => $event->name,
            'description' => $event->description,
            'date' => $event->date ? Carbon::parse($event->date)->format('F d, Y') : 'TBA',
            'time' => $event->time,
            'location' => $event->location,
            'image' => $event->image_path ? asset('storage/' . $event->image_path) : null,
            'status' => $status,
            'category' => $event->tags->map(fn($tag) => $tag->name),
        ], 200);
    }
}
