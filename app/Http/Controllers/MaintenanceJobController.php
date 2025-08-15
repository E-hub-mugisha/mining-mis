<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceJob;
use App\Models\Equipment;

class MaintenanceJobController extends Controller
{
    public function index()
    {
        $jobs = MaintenanceJob::with('equipment')->latest()->paginate(10);
        $equipment = Equipment::all();
        return view('maintenance_jobs.index', compact('jobs','equipment'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:open,in_progress,done',
            'scheduled_for' => 'nullable|date',
            'completed_at' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        MaintenanceJob::create($validated);

        return redirect()->route('maintenance.index')->with('success','Maintenance job created.');
    }

    public function update(Request $request, MaintenanceJob $maintenanceJob)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:open,in_progress,done',
            'scheduled_for' => 'nullable|date',
            'completed_at' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $maintenanceJob->update($validated);

        return redirect()->route('maintenance.index')->with('success','Maintenance job updated.');
    }

    public function destroy(MaintenanceJob $maintenanceJob)
    {
        $maintenanceJob->delete();
        return redirect()->route('maintenance.index')->with('success','Maintenance job deleted.');
    }
}
