<?php

namespace App\Http\Controllers;

use App\Models\EmergencyContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmergencyContactController extends Controller
{
    // Fetch all emergency contacts for the logged-in user
    public function index()
    {
        $contacts = EmergencyContact::where('user_id', Auth::id())->get();
        return view('contacts.index', compact('contacts'));
    }

    // Show the form to create a new emergency contact
    public function create()
    {
        return view('contacts.create');
    }

    // Store the new emergency contact
    public function store(Request $request)
    {
        // Validate the contact details
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'relationship' => 'required|string|max:255',
        ]);

        // Store the new emergency contact
        EmergencyContact::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'relationship' => $request->relationship,
        ]);

        // Redirect to contacts index with success message
        return redirect()->route('contacts.index')->with('success', 'Emergency contact added successfully.');
    }

    // Show the form to edit an existing emergency contact
    public function edit($id)
    {
        $contact = EmergencyContact::where('user_id', Auth::id())->findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    // Update the emergency contact
    public function update(Request $request, $id)
    {
        // Validate the contact details
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'relationship' => 'required|string|max:255',
        ]);

        // Find the contact to update
        $contact = EmergencyContact::where('user_id', Auth::id())->findOrFail($id);
        
        // Update the contact information
        $contact->update($request->all());

        // Redirect to contacts index with success message
        return redirect()->route('contacts.index')->with('success', 'Emergency contact updated successfully.');
    }

    // Delete an emergency contact
    public function destroy($id)
    {
        // Find and delete the contact
        $contact = EmergencyContact::where('user_id', Auth::id())->findOrFail($id);
        $contact->delete();

        // Redirect to contacts index with success message
        return redirect()->route('contacts.index')->with('success', 'Emergency contact deleted successfully.');
    }
}