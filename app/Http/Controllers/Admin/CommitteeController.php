<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Committee;
use App\Models\CommitteePosition;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the committees.
     */
    public function index()
    {
        $committees = Committee::with('positions')->get();
        return view('dashboard.committees.index', compact('committees'));
    }

    /**
     * Show the form for creating a new committee.
     */
    public function create()
    {
        return view('dashboard.committees.create');
    }

    /**
     * Store a newly created committee in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'established_date' => 'required|date',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'members' => 'nullable|integer|min:0',
            'responsibilities' => 'nullable|array',
            'responsibilities.*' => 'string',
            'meetings' => 'nullable|string',
            'achievements' => 'nullable|array',
            'achievements.*' => 'string',
            'impact_score' => 'nullable|numeric|min:0|max:9.9',
            'chair' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $committee = new Committee();
            $committee->name = $request->name;
            $committee->established_date = $request->established_date;
            $committee->description = $request->description;
            $committee->email = $request->email;
            $committee->members = $request->members ?? 0;
            $committee->responsibilities = $request->responsibilities ? json_encode($request->responsibilities) : null;
            $committee->meetings = $request->meetings;
            $committee->achievements = $request->achievements ? json_encode($request->achievements) : null;
            $committee->impact_score = $request->impact_score;
            $committee->chair = $request->chair;

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $committee->logo = $request->file('logo')->store('committee_logos', 'public');
            }

            $committee->save();
        });

        return redirect()->route('committees.index')->with('success', 'Committee created successfully.');
    }

    /**
     * Show the form for editing the specified committee.
     */
    public function edit(Committee $committee)
    {
        $committee->load('positions');
        return view('dashboard.committees.edit', compact('committee'));
    }

    /**
     * Update the specified committee in storage.
     */
    public function update(Request $request, Committee $committee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'established_date' => 'required|date',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'members' => 'nullable|integer|min:0',
            'responsibilities' => 'nullable|array',
            'responsibilities.*' => 'string',
            'meetings' => 'nullable|string',
            'achievements' => 'nullable|array',
            'achievements.*' => 'string',
            'impact_score' => 'nullable|numeric|min:0|max:9.9',
            'chair' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'remove_logo' => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($request, $committee) {
            $committee->name = $request->name;
            $committee->established_date = $request->established_date;
            $committee->description = $request->description;
            $committee->email = $request->email;
            $committee->members = $request->members ?? 0;
            $committee->responsibilities = $request->responsibilities ? json_encode($request->responsibilities) : null;
            $committee->meetings = $request->meetings;
            $committee->achievements = $request->achievements ? json_encode($request->achievements) : null;
            $committee->impact_score = $request->impact_score;
            $committee->chair = $request->chair;

            // Handle logo removal
            if ($request->remove_logo == '1' && $committee->logo) {
                Storage::disk('public')->delete($committee->logo);
                $committee->logo = null;
            }

            // Handle new logo upload
            if ($request->hasFile('logo')) {
                if ($committee->logo) {
                    Storage::disk('public')->delete($committee->logo);
                }
                $committee->logo = $request->file('logo')->store('committee_logos', 'public');
            }

            $committee->save();
        });

        return redirect()->route('committees.index')->with('success', 'Committee updated successfully.');
    }

    /**
     * Remove the specified committee from storage.
     */
    public function destroy(Committee $committee)
    {
        if ($committee->logo) {
            Storage::disk('public')->delete($committee->logo);
        }

        $committee->positions()->delete();
        $committee->delete();

        return redirect()->route('committees.index')->with('success', 'Committee deleted successfully.');
    }
}
