<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        return view('dashboard.about.index', compact('about'));
    }

    public function create()
    {
        return view('dashboard.about.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'our_story' => 'nullable|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'values' => 'nullable|string',
            'impact' => 'nullable|string',
        ]);

        AboutUs::create($validated);
        return redirect()->route('about.index')->with('success', 'About Us created successfully.');
    }

    public function edit(AboutUs $about)
    {
        return view('dashboard.about.edit', compact('about'));
    }

    public function update(Request $request, AboutUs $about)
    {
        $validated = $request->validate([
            'our_story' => 'nullable|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'values' => 'nullable|string',
            'impact' => 'nullable|string',
        ]);

        $about->update($validated);
        return redirect()->route('about.index')->with('success', 'About Us updated successfully.');
    }
}
