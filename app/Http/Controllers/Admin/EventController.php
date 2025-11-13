<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index()
    {
        $events = Event::all();
        return view('dashboard.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        $tags = EventTag::all();
        return view('dashboard.events.create', compact('tags'));
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'date' => 'nullable|date|after_or_equal:today',
            'time' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'attendees' => 'nullable|integer|min:0',
            'status' => 'nullable|string|in:upcoming,ongoing,completed',
            'category' => 'nullable|string|max:255',
            'description' => 'required|string',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:event_tags,id',
            'remove_image' => 'nullable|boolean',
        ]);

        $eventData = [
            'name' => $data['name'],
            'date' => $data['date'] ?? null,
            'time' => $data['time'] ?? null,
            'location' => $data['location'] ?? null,
            'attendees' => $data['attendees'] ?? null,
            'status' => $data['status'] ?? 'upcoming',
            'category' => $data['category'] ?? null,
            'description' => $data['description'],
        ];

        // Update event if it exists
        if (isset($event)) {
            // Handle image for update
            if ($request->hasFile('image_path')) {
                if (!empty($event->image_path)) {
                    Storage::disk('public')->delete($event->image_path);
                }
                $file = $request->file('image_path');
                $fileName = 'event_image_' . $event->id . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                $eventData['image_path'] = $file->storeAs('event_images', $fileName, 'public');
            } elseif ($request->input('remove_image')) {
                $eventData['image_path'] = null;
            }

            $event->update($eventData);
        } else {
            // Handle image for creation
            if ($request->hasFile('image_path')) {
                $file = $request->file('image_path');
                $fileName = 'event_image_' . time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                $eventData['image_path'] = $file->storeAs('event_images', $fileName, 'public');
            }

            $event = Event::create($eventData);
        }

        // Sync tags
        $event->categories()->sync($data['tag_ids'] ?? []);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Show the form for editing an event.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $tags = EventTag::all();
        return view('dashboard.events.edit', compact('event', 'tags'));
    }

    /**
     * Update the specified event.
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'date' => 'nullable|date|after_or_equal:today',
            'description' => 'required|string',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:event_tags,id',
            'remove_image' => 'nullable|boolean',
        ]);

        // Handle image
        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($event->image_path) {
                Storage::disk('public')->delete($event->image_path);
            }

            $file = $request->file('image_path');
            $fileName = 'event_image_' . $event->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $data['image_path'] = $file->storeAs('event_images', $fileName, 'public');
        } elseif ($request->input('remove_image')) {
            // Remove existing image if requested
            if ($event->image_path) {
                Storage::disk('public')->delete($event->image_path);
            }
            $data['image_path'] = null;
        } else {
            // Keep existing image if nothing changes
            $data['image_path'] = $event->image_path;
        }

        // Update event
        $event->update([
            'name' => $data['name'],
            'date' => $data['date'] ?? null,
            'description' => $data['description'],
            'image_path' => $data['image_path'],
        ]);

        // Sync tags
        $event->categories()->sync($data['tag_ids'] ?? []);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }


    /**
     * Remove the specified event.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Delete image if exists
        if ($event->image_path) {
            Storage::disk('public')->delete($event->image_path);
        }

        $event->categories()->detach();
        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully!');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            // Original file name
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();

            // Create unique file name
            $fileName = $fileName . '_' . time() . '.' . $extension;

            // Move the uploaded file to public/event_media
            $request->file('upload')->move(public_path('event_media'), $fileName);

            // Get the URL to return to CKEditor
            $url = asset('event_media/' . $fileName);

            // Return JSON response
            return response()->json([
                'fileName' => $fileName,
                'uploaded' => 1,
                'url' => $url
            ]);
        }
    }
}
