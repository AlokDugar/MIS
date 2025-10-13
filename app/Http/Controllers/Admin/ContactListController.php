<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactList;
use Illuminate\Http\Request;

class ContactListController extends Controller
{
    public function index()
    {
        $contactLists = ContactList::all();
        return view('dashboard.contactUs.contactList', compact('contactLists'));
    }
}
