<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
           'phone' => 'nullable|string',
           'address' => 'nullable|string',
           'gender' => 'nullable|in:male,female,other',
           'dob' => 'nullable|date',
           'nid' => 'nullable|string|max:20',
           'emergency_contact_1' => 'nullable|string',
           'emergency_contact_2' => 'nullable|string',
           'emergency_contact_3' => 'nullable|string',
        ]);

        $user = Auth::user();

       

        $user->update($request->all());

        // 🔁 Redirect to home with success message
        return redirect('/home')->with('success', 'Profile updated successfully!');
    }
}