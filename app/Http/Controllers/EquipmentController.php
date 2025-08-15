<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Site;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::with('site')->paginate(10);
        $sites = Site::all();

        return view('equipment.index', compact('equipment','sites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'serial' => 'nullable|string|max:255',
            'status' => 'required|in:active,down,maintenance',
            'last_maintenance_at' => 'nullable|date',
            'hours_meter' => 'required|integer|min:0',
        ]);

        Equipment::create($validated);

        return redirect()->route('equipment.index')->with('success', 'Equipment added.');
    }

    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'serial' => 'nullable|string|max:255',
            'status' => 'required|in:active,down,maintenance',
            'last_maintenance_at' => 'nullable|date',
            'hours_meter' => 'required|integer|min:0',
        ]);

        $equipment->update($validated);

        return redirect()->route('equipment.index')->with('success', 'Equipment updated.');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return redirect()->route('equipment.index')->with('success', 'Equipment deleted.');
    }
}
