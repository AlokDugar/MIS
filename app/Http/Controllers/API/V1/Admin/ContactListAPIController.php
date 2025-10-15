<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactList;
use Illuminate\Support\Facades\Validator;

class ContactListAPIController extends Controller
{

    public function index()
    {
        $contacts = ContactList::all();

        return response()->json([
            'data' => $contacts
        ], 200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|min:10|max:10',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $contact = ContactList::create($request->only('name', 'email', 'phone', 'subject', 'message'));

        return response()->json([
            'message' => 'Contact created successfully',
            'data' => $contact
        ], 201);
    }
}
