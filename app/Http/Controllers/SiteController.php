<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\User;

class SiteController extends Controller
{
    /**
     * Display a listing of the sites.
     */
    public function index()
    {
        $sites = Site::with('manager')->paginate(10);
        $managers = User::role('OperationsManager')->get(); // Users with manager role

        return view('sites.index', compact('sites', 'managers'));
    }

    /**
     * Store a newly created site in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sites,code',
            'location' => 'nullable|string|max:255',
            'manager_id' => 'nullable|exists:users,id',
            'notes' => 'nullable|string',
        ]);

        Site::create($validated);

        return redirect()->route('sites.index')->with('success', 'Site created successfully.');
    }

    /**
     * Update the specified site in storage.
     */
    public function update(Request $request, Site $site)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sites,code,' . $site->id,
            'location' => 'nullable|string|max:255',
            'manager_id' => 'nullable|exists:users,id',
            'notes' => 'nullable|string',
        ]);

        $site->update($validated);

        return redirect()->route('sites.index')->with('success', 'Site updated successfully.');
    }

    /**
     * Remove the specified site from storage.
     */
    public function destroy(Site $site)
    {
        $site->delete();
        return redirect()->route('sites.index')->with('success', 'Site deleted successfully.');
    }
}
