<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\IncidentReport;

class IncidentReportController extends Controller
{
    public function create()
    {
        return view('incident.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'incident_time' => 'required|date',
            'description' => 'required|string',
        ]);

        IncidentReport::create([
            'user_id' => Auth::id(),
            'location' => $request->location,
            'incident_time' => $request->incident_time,
            'description' => $request->description,
            'is_anonymous' => $request->has('is_anonymous'),
        ]);

        return redirect('/home')->with('success', 'Incident reported successfully.');
    }
}