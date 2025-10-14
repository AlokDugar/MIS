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
            'logo' => 'nullable|image|max:2048',
            'positions.*.position_name' => 'required_with:positions.*.holder_name|string|max:255',
            'positions.*.holder_name' => 'required_with:positions.*.position_name|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $committee = new Committee();
            $committee->name = $request->name;
            $committee->established_date = $request->established_date;
            $committee->description = $request->description;

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $committee->logo = $request->file('logo')->store('committee_logos', 'public');
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
            'logo' => 'nullable|image|max:2048',
            'positions.*.position_name' => 'required_with:positions.*.holder_name|string|max:255',
            'positions.*.holder_name' => 'required_with:positions.*.position_name|string|max:255',
        ]);

        DB::transaction(function () use ($request, $committee) {
            $committee->name = $request->name;
            $committee->established_date = $request->established_date;
            $committee->description = $request->description;

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

            // Handle positions
            $existingIds = $committee->positions->pluck('id')->toArray();
            $submittedIds = [];

            if ($request->positions) {
                foreach ($request->positions as $index => $pos) {
                    // Skip empty positions
                    if (empty($pos['position_name']) || empty($pos['holder_name'])) continue;

                    // Update existing position or create new
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
        // Delete logo
        if ($committee->logo) {
            Storage::disk('public')->delete($committee->logo);
        }

        // Delete positions
        $committee->positions()->delete();

        $committee->delete();

        return redirect()->route('committees.index')->with('success', 'Committee deleted successfully.');
    }
}
