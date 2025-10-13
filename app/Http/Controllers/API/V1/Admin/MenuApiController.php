<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuApiController extends Controller
{
    // GET /api/v1/menus
    public function index()
    {
        $menus = Menu::all();
        return response()->json([
            'data' => $menus
        ], 200);
    }

    // GET /api/v1/menus/{menu}
    public function show(Menu $menu)
    {
        return response()->json([
            'data' => $menu
        ], 200);
    }

    public function activeMenus()
    {
        $activeMenus = Menu::where('status', 'Active')->get();

        return response()->json([
            'data' => $activeMenus
        ], 200);
    }
}
