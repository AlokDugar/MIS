<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('dashboard.events.index', compact('events'));
    }

    public function create()
    {
        $tags = EventTag::all();
        return view('dashboard.events.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tags' => 'nullable|array',
            'status' => 'nullable|string|in:Published,Unpublished',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event = Event::create($validated);
        $event->tags()->sync($request->tags ?? []);

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        $tags = EventTag::all();
        $selectedTags = $event->tags->pluck('id')->toArray();
        return view('dashboard.events.edit', compact('event', 'tags', 'selectedTags'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tags' => 'nullable|array',
            'status' => 'nullable|string|in:Published,Unpublished',
            'remove_image' => 'nullable|boolean',
        ]);

        // Handle remove image
        if ($request->remove_image) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);
        $event->tags()->sync($request->tags ?? []);

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
