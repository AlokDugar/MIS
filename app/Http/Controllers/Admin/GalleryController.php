<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of galleries.
     */
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('dashboard.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new gallery.
     */
    public function create()
    {
        return view('dashboard.galleries.create');
    }

    /**
     * Store a newly created gallery.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'nullable|string|max:255',
            'attendees' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'gallery_' . time() . '.' . $file->getClientOriginalExtension();
            $data['image'] = $file->storeAs('galleries', $fileName, 'public');
        }

        Gallery::create($data);

        return redirect()->route('galleries.index')->with('success', 'Gallery created successfully.');
    }

    /**
     * Show the form for editing a gallery.
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('dashboard.galleries.edit', compact('gallery'));
    }

    /**
     * Update a gallery.
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'nullable|string|max:255',
            'attendees' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        if ($request->input('remove_image') && $gallery->image) {
            Storage::disk('public')->delete($gallery->image);
            $data['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $file = $request->file('image');
            $fileName = 'gallery_' . time() . '.' . $file->getClientOriginalExtension();
            $data['image'] = $file->storeAs('galleries', $fileName, 'public');
        } else {
            $data['image'] = $gallery->image;
        }

        $gallery->update($data);

        return redirect()->route('galleries.index')->with('success', 'Gallery updated successfully.');
    }

    /**
     * Remove a gallery.
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('galleries.index')->with('success', 'Gallery deleted successfully.');
    }
}
