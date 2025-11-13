<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardMemberController extends Controller
{
    /**
     * Display a listing of board members.
     */
    public function index()
    {
        $members = BoardMember::latest()->get();
        return view('dashboard.boardmembers.index', compact('members'));
    }

    /**
     * Show the form for creating a new board member.
     */
    public function create()
    {
        return view('dashboard.boardmembers.create');
    }

    /**
     * Store a newly created board member.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'board_' . time() . '.' . $file->getClientOriginalExtension();
            $data['image'] = $file->storeAs('board_members', $fileName, 'public');
        }

        BoardMember::create($data);

        return redirect()->route('board.index')->with('success', 'Board Member created successfully.');
    }

    /**
     * Show the form for editing a board member.
     */
    public function edit($id)
    {
        $member = BoardMember::findOrFail($id);
        return view('dashboard.boardmembers.edit', compact('member'));
    }

    /**
     * Update a board member.
     */
    public function update(Request $request, $id)
    {
        $member = BoardMember::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        if ($request->input('remove_image') && $member->image) {
            Storage::disk('public')->delete($member->image);
            $data['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($member->image) {
                Storage::disk('public')->delete($member->image);
            }
            $file = $request->file('image');
            $fileName = 'board_' . time() . '.' . $file->getClientOriginalExtension();
            $data['image'] = $file->storeAs('board_members', $fileName, 'public');
        } else {
            $data['image'] = $member->image;
        }

        $member->update($data);

        return redirect()->route('board.index')->with('success', 'Board Member updated successfully.');
    }

    /**
     * Remove a board member.
     */
    public function destroy($id)
    {
        $member = BoardMember::findOrFail($id);

        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }

        $member->delete();

        return redirect()->route('board.index')->with('success', 'Board Member deleted successfully.');
    }
}
