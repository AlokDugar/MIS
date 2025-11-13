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
            'long_description' => 'nullable|string',
            'responsibilities' => 'nullable|array',
            'responsibilities.*' => 'string',
            'meetings' => 'nullable|string',
            'achievements' => 'nullable|array',
            'achievements.*' => 'string',
            'impact_score' => 'nullable|numeric|min:0|max:9.9',
            'image' => 'nullable|image|max:2048',
            'positions.*.position_name' => 'required_with:positions.*.holder_name|string|max:255',
            'positions.*.holder_name' => 'required_with:positions.*.position_name|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $committee = new Committee();
            $committee->name = $request->name;
            $committee->established_date = $request->established_date;
            $committee->description = $request->description;
            $committee->email = $request->email;
            $committee->members = $request->members ?? 0;
            $committee->long_description = $request->long_description;
            $committee->responsibilities = $request->responsibilities ? json_encode($request->responsibilities) : null;
            $committee->meetings = $request->meetings;
            $committee->achievements = $request->achievements ? json_encode($request->achievements) : null;
            $committee->impact_score = $request->impact_score;

            // Handle image upload
            if ($request->hasFile('image')) {
                $committee->image = $request->file('image')->store('committee_images', 'public');
            }

            $committee->save();

            // Save positions
            if ($request->positions) {
                foreach ($request->positions as $pos) {
                    if (!empty($pos['position_name']) && !empty($pos['holder_name'])) {
                        $committee->positions()->create([
                            'position_name' => $pos['position_name'],
                            'holder_name' => $pos['holder_name'],
                        ]);
                    }
                }
            }
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
            'long_description' => 'nullable|string',
            'responsibilities' => 'nullable|array',
            'responsibilities.*' => 'string',
            'meetings' => 'nullable|string',
            'achievements' => 'nullable|array',
            'achievements.*' => 'string',
            'impact_score' => 'nullable|numeric|min:0|max:9.9',
            'image' => 'nullable|image|max:2048',
            'remove_image' => 'nullable|boolean',
            'positions.*.position_name' => 'required_with:positions.*.holder_name|string|max:255',
            'positions.*.holder_name' => 'required_with:positions.*.position_name|string|max:255',
        ]);

        DB::transaction(function () use ($request, $committee) {
            $committee->name = $request->name;
            $committee->established_date = $request->established_date;
            $committee->description = $request->description;
            $committee->email = $request->email;
            $committee->members = $request->members ?? 0;
            $committee->long_description = $request->long_description;
            $committee->responsibilities = $request->responsibilities ? json_encode($request->responsibilities) : null;
            $committee->meetings = $request->meetings;
            $committee->achievements = $request->achievements ? json_encode($request->achievements) : null;
            $committee->impact_score = $request->impact_score;

            // Handle image removal
            if ($request->remove_image == '1' && $committee->image) {
                Storage::disk('public')->delete($committee->image);
                $committee->image = null;
            }

            // Handle new image upload
            if ($request->hasFile('image')) {
                if ($committee->image) {
                    Storage::disk('public')->delete($committee->image);
                }
                $committee->image = $request->file('image')->store('committee_images', 'public');
            }

            $committee->save();

            // Handle positions
            $existingIds = $committee->positions->pluck('id')->toArray();
            $submittedIds = [];

            if ($request->positions) {
                foreach ($request->positions as $pos) {
                    if (empty($pos['position_name']) || empty($pos['holder_name'])) continue;

                    if (isset($pos['id']) && in_array($pos['id'], $existingIds)) {
                        $position = CommitteePosition::find($pos['id']);
                        $position->update([
                            'position_name' => $pos['position_name'],
                            'holder_name' => $pos['holder_name'],
                        ]);
                        $submittedIds[] = $pos['id'];
                    } else {
                        $newPosition = $committee->positions()->create([
                            'position_name' => $pos['position_name'],
                            'holder_name' => $pos['holder_name'],
                        ]);
                        $submittedIds[] = $newPosition->id;
                    }
                }
            }

            // Delete removed positions
            $toDelete = array_diff($existingIds, $submittedIds);
            CommitteePosition::whereIn('id', $toDelete)->delete();
        });

        return redirect()->route('committees.index')->with('success', 'Committee updated successfully.');
    }

    /**
     * Remove the specified committee from storage.
     */
    public function destroy(Committee $committee)
    {
        if ($committee->image) {
            Storage::disk('public')->delete($committee->image);
        }

        $committee->positions()->delete();
        $committee->delete();

        return redirect()->route('committees.index')->with('success', 'Committee deleted successfully.');
    }
}
