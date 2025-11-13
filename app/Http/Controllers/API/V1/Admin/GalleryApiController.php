<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryApiController extends Controller
{
    // 📸 Get all galleries
    public function index()
    {
        $galleries = Gallery::all()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'category' => $item->category ?? 'general',
                'date' => $item->date,
                'attendees' => $item->attendees,
                'image_url' => asset('storage/galleries/' . basename($item->image)), // ✅ Correct URL
            ];
        });

        return response()->json([
            'data' => $galleries
        ], 200);
    }

    // ➕ Create new gallery
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'nullable|string',
            'attendees' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery = Gallery::create($validated);
        $gallery->image = $gallery->image ? url('storage/' . $gallery->image) : null;

        return response()->json([
            'message' => 'Gallery item created successfully',
            'data' => $gallery
        ], 201);
    }

    // ✏️ Update gallery
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'nullable|string',
            'attendees' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($validated);
        $gallery->image = $gallery->image ? url('storage/' . $gallery->image) : null;

        return response()->json([
            'message' => 'Gallery item updated successfully',
            'data' => $gallery
        ]);
    }

    // ❌ Delete gallery
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return response()->json([
            'message' => 'Gallery item deleted successfully'
        ]);
    }
}
