<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('dashboard.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('dashboard.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'status' => 'required|in:Active,Inactive',
        ]);

        try {
            // Create menu
            Menu::create([
                'name' => $request->name,
                'url' => $request->url,
                'status' => $request->status,
            ]);

            // Redirect with success
            return redirect()->route('menus.index')
                ->with('success', 'Menu created successfully.');
        } catch (\Exception $e) {
            // Log the error with details
            Log::error('Menu creation failed', [
                'title' => $request->name,
                'url' => $request->url,
                'status' => $request->status,
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with input and user-friendly error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Menu could not be created. Please check the logs.');
        }
    }

    public function edit(Menu $menu)
    {
        return view('dashboard.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        try {
            // Update the menu
            $menu->update([
                'name' => $request->name,
                'url' => $request->url,
                'status' => $request->status,
            ]);

            return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
        } catch (\Exception $e) {
            // Log any error
            Log::error('Menu update failed', [
                'menu_id' => $menu->id,
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with('error', 'Menu could not be updated. Check logs.');
        }
    }


    public function destroy(Menu $menu)
    {
        $menu->delete();
        return back()->with('success', 'Menu deleted successfully.');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'status' => 'required|in:Active,Inactive',
        ]);

        $menu = Menu::find($request->menu_id);
        $menu->status = $request->status;
        $menu->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}
