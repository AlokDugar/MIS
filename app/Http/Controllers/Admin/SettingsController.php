<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SettingsController extends Controller
{
    public function index(){
        $settings = Setting::first();
        return view('dashboard.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'website_name' => 'nullable|string|max:255',
            'dashboard_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:512',
        ]);

        $settings = Setting::firstOrCreate([]);

        $websiteNameChanged = $request->website_name && $request->website_name !== $settings->website_name;

        if (!$websiteNameChanged && !$request->hasFile('dashboard_logo') && !$request->hasFile('site_logo') && !$request->hasFile('favicon')) {
            return redirect()->back()->with('error', 'No changes were made.');
        }

        if ($websiteNameChanged) {
            $settings->website_name = $request->website_name;
        }

        if ($request->hasFile('dashboard_logo')) {
            if ($settings->dashboard_logo && Storage::disk('public')->exists($settings->dashboard_logo)) {
                Storage::disk('public')->delete($settings->dashboard_logo);
            }
            $random = rand(1000, 9999);
            $imageName = 'dashboard_logo_' . $random . '.' . $request->file('dashboard_logo')->getClientOriginalExtension();
            $imagePath = $request->file('dashboard_logo')->storeAs('dashboard_logo', $imageName, 'public');
            $settings->dashboard_logo = $imagePath;
        }

        if ($request->hasFile('site_logo')) {
            if ($settings->site_logo && Storage::disk('public')->exists($settings->site_logo)) {
                Storage::disk('public')->delete($settings->site_logo);
            }
            $random = rand(1000, 9999);
            $imageName = 'site_logo_' . $random . '.' . $request->file('site_logo')->getClientOriginalExtension();
            $imagePath = $request->file('site_logo')->storeAs('site_logo', $imageName, 'public');
            $settings->site_logo = $imagePath;
        }

        if ($request->hasFile('favicon')) {
            if ($settings->favicon && Storage::disk('public')->exists($settings->favicon)) {
                Storage::disk('public')->delete($settings->favicon);
            }
            $random = rand(1000, 9999);
            $imageName = 'favicon_' . $random . '.' . $request->file('favicon')->getClientOriginalExtension();
            $settings->favicon = $request->file('favicon')->storeAs('favicon', $imageName, 'public');
        }

        $settings->save();

        return redirect()->back()->with('success', 'Settings Updated Successfully!');

    }
}

