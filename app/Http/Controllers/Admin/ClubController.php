<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\ClubTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClubController extends Controller
{
    /**
     * Display a listing of clubs.
     */
    public function index()
    {
        $clubs = Club::all();
        return view('dashboard.clubs.index', compact('clubs'));
    }

    /**
     * Show the form for creating a new club.
     */
    public function create()
    {
        $tags = ClubTag::all();
        return view('dashboard.clubs.create', compact('tags'));
    }

    /**
     * Store a newly created club in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'president' => 'required|string|max:255',
            'members' => 'nullable|integer|min:0',
            'established_date' => 'nullable|date|before_or_equal:today',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:club_tags,id',
        ]);

        // Create club
        $club = Club::create([
            'name' => $data['name'],
            'president' => $data['president'],
            'members' => $data['members'] ?? 0,
            'established_date' => $data['established_date'] ?? null,
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = 'club_logo_' . $club->id . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $club->update([
                'logo' => $file->storeAs('club_logos', $fileName, 'public')
            ]);
        }

        // Sync tags
        if (!empty($data['tag_ids'])) {
            $club->tags()->sync($data['tag_ids']);
        }

        return redirect()->route('clubs.index')->with('success', 'Club created successfully.');
    }

    /**
     * Show the form for editing a club.
     */
    public function edit($id)
    {
        $club = Club::findOrFail($id);
        $tags = ClubTag::all();
        return view('dashboard.clubs.edit', compact('club', 'tags'));
    }

    /**
     * Update the specified club.
     */
    public function update(Request $request, $id)
    {
        $club = Club::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'president' => 'required|string|max:255',
            'members' => 'nullable|integer|min:0',
            'established_date' => 'nullable|date|before_or_equal:today',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:club_tags,id',
            'remove_logo' => 'nullable|boolean',
        ]);

        // Handle logo removal or update
        if ($request->input('remove_logo') && $club->logo) {
            Storage::disk('public')->delete($club->logo);
            $data['logo'] = null;
        } elseif ($request->hasFile('logo')) {
            if ($club->logo) {
                Storage::disk('public')->delete($club->logo);
            }
            $file = $request->file('logo');
            $fileName = 'club_logo_' . $id . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $data['logo'] = $file->storeAs('club_logos', $fileName, 'public');
        } else {
            $data['logo'] = $club->logo;
        }

        $club->update([
            'name' => $data['name'],
            'president' => $data['president'],
            'members' => $data['members'] ?? 0,
            'established_date' => $data['established_date'] ?? null,
            'logo' => $data['logo'],
        ]);

        // Sync tags
        $club->tags()->sync($data['tag_ids'] ?? []);

        return redirect()->route('clubs.index')->with('success', 'Club updated successfully.');
    }

    /**
     * Remove the specified club.
     */
    public function destroy($id)
    {
        $club = Club::findOrFail($id);

        // Delete logo if exists
        if ($club->logo) {
            Storage::disk('public')->delete($club->logo);
        }

        $club->tags()->detach();
        $club->delete();

        return redirect()->back()->with('success', 'Club deleted successfully!');
    }
}
