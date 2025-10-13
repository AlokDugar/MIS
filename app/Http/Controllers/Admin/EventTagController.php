<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventTag;
use Illuminate\Http\Request;

class EventTagController extends Controller
{
    /**
     * Display a listing of the tags.
     */
    public function index()
    {
        $tags = EventTag::latest()->get();
        return view('dashboard.eventTags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new tag.
     */
    public function create()
    {
        return view('dashboard.eventTags.create');
    }

    /**
     * Store a newly created tag.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:event_tags,name',
        ]);

        EventTag::create($request->all());

        return redirect()->route('event-tags.index')
            ->with('success', 'Event Tag created successfully.');
    }

    /**
     * Show the form for editing the specified tag.
     */
    public function edit($id)
    {
        $tag = EventTag::findOrFail($id);
        return view('dashboard.eventTags.edit', compact('tag'));
    }

    /**
     * Update the specified tag.
     */
    public function update(Request $request, EventTag $eventTag)
    {
        $request->validate([
            'name' => 'required|unique:event_tags,name,' . $eventTag->id,
        ]);

        $eventTag->update($request->all());

        return redirect()->route('event-tags.index')
            ->with('success', 'Event Tag updated successfully.');
    }

    /**
     * Remove the specified tag.
     */
    public function destroy(EventTag $eventTag)
    {
        $eventTag->delete();

        return redirect()->route('event-tags.index')
            ->with('success', 'Event Tag deleted successfully.');
    }
}
