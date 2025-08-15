<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductionLog;
use App\Models\Site;

class ProductionLogController extends Controller
{
    public function index()
    {
        $logs = ProductionLog::with('site')->latest()->paginate(10);
        $sites = Site::all();
        return view('production_logs.index', compact('logs', 'sites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'date' => 'required|date',
            'ore_tonnage' => 'required|numeric|min:0',
            'waste_tonnage' => 'required|numeric|min:0',
            'avg_grade' => 'nullable|numeric|min:0',
            'truck_trips' => 'required|integer|min:0',
            'downtime_minutes' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        ProductionLog::create($validated);

        return redirect()->route('production-logs.index')->with('success', 'Production log created.');
    }

    public function update(Request $request, ProductionLog $productionLog)
    {
        $validated = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'date' => 'required|date',
            'ore_tonnage' => 'required|numeric|min:0',
            'waste_tonnage' => 'required|numeric|min:0',
            'avg_grade' => 'nullable|numeric|min:0',
            'truck_trips' => 'required|integer|min:0',
            'downtime_minutes' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $productionLog->update($validated);

        return redirect()->route('production-logs.index')->with('success', 'Production log updated.');
    }

    public function destroy(ProductionLog $productionLog)
    {
        $productionLog->delete();
        return redirect()->route('production-logs.index')->with('success', 'Production log deleted.');
    }
}
