<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    /**
     * Display a listing of the contact infos.
     */
    public function index()
    {
        $contactInfos = ContactInfo::all();
        $contactCount = ContactInfo::count();
        return view('dashboard.contactUs.contactInfo.index', compact('contactInfos','contactCount'));
    }

    public function create()
    {
        return view('dashboard.contactUs.contactInfo.create');
    }

    /**
     * Store a newly created contact info in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'nullable|string|min:10|max:10',
        ]);

        ContactInfo::create($request->only('email', 'phone'));

        return redirect()->route('contact-infos.index')->with('success', 'Contact info added successfully!');
    }

    public function edit($id)
    {
        $contactInfo = ContactInfo::findOrFail($id);

        return view('dashboard.contactUs.contactInfo.edit', compact('contactInfo'));
    }

    /**
     * Update the specified contact info in storage.
     */
    public function update(Request $request, $id)
    {
        $contactInfo = ContactInfo::findOrFail($id);

        $request->validate([
            'email' => 'required|email',
            'phone' => 'nullable|string|min:10|max:10',
        ]);

        $contactInfo->update($request->only('email', 'phone'));

        return redirect()->route('contact-infos.index')->with('success', 'Contact info updated successfully!');
    }

    /**
     * Remove the specified contact info from storage.
     */
    public function destroy($id)
    {
        $contactInfo = ContactInfo::findOrFail($id);
        $contactInfo->delete();

        return redirect()->back()->with('success', 'Contact info deleted successfully!');
    }
}
