<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;

class SocialController extends Controller
{
    public function index()
    {
        $social = Social::first();

        return view('dashboard.socials.index', compact('social'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'X' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        $social = Social::first();

        if (!$social) {
            $social = Social::create($request->all());
        } else {
            $social->update($request->all());
        }

        return redirect()->back()->with('success', 'Social links updated successfully.');
    }
}
