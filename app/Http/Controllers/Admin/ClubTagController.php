<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClubTag;
use Illuminate\Http\Request;

class ClubTagController extends Controller
{
    /**
     * Display a listing of the tags.
     */
    public function index()
    {
        $tags = ClubTag::latest()->get();
        return view('dashboard.club_tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new tag.
     */
    public function create()
    {
        return view('dashboard.club_tags.create');
    }

    /**
     * Store a newly created tag.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:club_tags,name',
        ]);

        ClubTag::create($request->all());

        return redirect()->route('club-tags.index')
            ->with('success', 'Club Tag created successfully.');
    }

    /**
     * Show the form for editing the specified tag.
     */
    public function edit($id)
    {
        $tag = ClubTag::findOrFail($id);
        return view('dashboard.club_tags.edit', compact('tag'));
    }

    /**
     * Update the specified tag.
     */
    public function update(Request $request, ClubTag $clubTag)
    {
        $request->validate([
            'name' => 'required|unique:club_tags,name,' . $clubTag->id,
        ]);

        $clubTag->update($request->all());

        return redirect()->route('club-tags.index')
            ->with('success', 'Club Tag updated successfully.');
    }

    /**
     * Remove the specified tag.
     */
    public function destroy(ClubTag $clubTag)
    {
        $clubTag->delete();

        return redirect()->route('club-tags.index')
            ->with('success', 'Club Tag deleted successfully.');
    }
}
