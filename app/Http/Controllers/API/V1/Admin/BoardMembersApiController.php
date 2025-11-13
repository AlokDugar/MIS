<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BoardMember;

class BoardMembersApiController extends Controller
{
    public function index()
    {
        $members = BoardMember::all()->map(function ($member) {
            // Extract only the filename from existing path
            $filename = basename($member->image);

            // Ensure the path is always /storage/board_members/filename
            $imagePath = 'storage/board_members/' . $filename;

            return [
                'id' => $member->id,
                'name' => $member->name,
                'position' => $member->position,
                'image' => asset($imagePath), // full URL
                'bio' => $member->bio,
                'created_at' => $member->created_at,
                'updated_at' => $member->updated_at,
            ];
        });

        return response()->json([
            'data' => $members
        ], 200);
    }
}
