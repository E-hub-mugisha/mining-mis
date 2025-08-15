<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuelLog;
use App\Models\Equipment;

class FuelLogController extends Controller
{
    public function index()
    {
        $fuelLogs = FuelLog::with('equipment')->latest()->paginate(10);
        $equipment = Equipment::all(); // For dropdown
        return view('fuel_logs.index', compact('fuelLogs','equipment'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'filled_at' => 'required|date',
            'liters' => 'required|numeric|min:0.01',
            'odometer_or_hours' => 'nullable|numeric|min:0',
            'issuer' => 'nullable|string|max:255',
        ]);

        FuelLog::create($validated);

        return redirect()->route('fuel-logs.index')->with('success','Fuel log added.');
    }

    public function update(Request $request, FuelLog $fuelLog)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'filled_at' => 'required|date',
            'liters' => 'required|numeric|min:0.01',
            'odometer_or_hours' => 'nullable|numeric|min:0',
            'issuer' => 'nullable|string|max:255',
        ]);

        $fuelLog->update($validated);

        return redirect()->route('fuel-logs.index')->with('success','Fuel log updated.');
    }

    public function destroy(FuelLog $fuelLog)
    {
        $fuelLog->delete();
        return redirect()->route('fuel-logs.index')->with('success','Fuel log deleted.');
    }
}
