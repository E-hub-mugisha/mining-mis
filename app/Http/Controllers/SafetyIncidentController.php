<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SafetyIncident;
use App\Models\Site;

class SafetyIncidentController extends Controller
{
    public function index()
    {
        $incidents = SafetyIncident::with('site')->latest()->paginate(10);
        $sites = Site::all();
        return view('safety_incidents.index', compact('incidents', 'sites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'occurred_at' => 'required|date',
            'severity' => 'required|in:minor,moderate,major,critical',
            'description' => 'required|string',
            'is_resolved' => 'sometimes|boolean',
        ]);

        SafetyIncident::create($validated);

        return redirect()->route('safety-incidents.index')->with('success','Incident created.');
    }

    public function update(Request $request, SafetyIncident $safetyIncident)
    {
        $validated = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'occurred_at' => 'required|date',
            'severity' => 'required|in:minor,moderate,major,critical',
            'description' => 'required|string',
            'is_resolved' => 'sometimes|boolean',
        ]);

        $safetyIncident->update($validated);

        return redirect()->route('safety-incidents.index')->with('success','Incident updated.');
    }

    public function destroy(SafetyIncident $safetyIncident)
    {
        $safetyIncident->delete();
        return redirect()->route('safety-incidents.index')->with('success','Incident deleted.');
    }
}
