<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentUsage;
use App\Models\Report;
use App\Models\Site;
use App\Models\Staff;
use App\Models\AttendanceLog;
use App\Models\SafetyIncident;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index', [
            'sites'     => Site::all(),
            'staff'     => Staff::all(),
            'equipment' => Equipment::all(),
        ]);
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'report_type'  => 'required|string|in:staff_attendance,equipment_usage,safety_incidents',
            'date_from'    => 'nullable|date',
            'date_to'      => 'nullable|date',
            'site_id'      => 'nullable|exists:sites,id',
            'staff_id'     => 'nullable|exists:staff,id',
            'equipment_id' => 'nullable|exists:equipment,id',
            'export'       => 'nullable|string|in:pdf,excel',
        ]);

        // ✅ fetch data based on report type
        switch ($validated['report_type']) {
            case 'staff_attendance':
                $data = AttendanceLog::query()
                    ->when($validated['date_from'], fn($q) => $q->whereDate('clock_in', '>=', $validated['date_from']))
                    ->when($validated['date_to'], fn($q) => $q->whereDate('clock_in', '<=', $validated['date_to']))
                    ->when($validated['staff_id'], fn($q) => $q->where('staff_id', $validated['staff_id']))
                    ->with('staff')
                    ->get();
                break;

            case 'safety_incidents':
                $data = SafetyIncident::query()
                    ->when($validated['site_id'], fn($q) => $q->where('site_id', $validated['site_id']))
                    ->when($validated['date_from'], fn($q) => $q->whereDate('occurred_at', '>=', $validated['date_from']))
                    ->when($validated['date_to'], fn($q) => $q->whereDate('occurred_at', '<=', $validated['date_to']))
                    ->with('site')
                    ->get();
                break;

            case 'equipment_usage':
                $data = EquipmentUsage::query()
                    ->when($validated['equipment_id'], fn($q) => $q->where('equipment_id', $validated['equipment_id']))
                    ->when($validated['date_from'], fn($q) => $q->whereDate('used_at', '>=', $validated['date_from']))
                    ->when($validated['date_to'], fn($q) => $q->whereDate('used_at', '<=', $validated['date_to']))
                    ->with('equipment')
                    ->get();
                break;

            default:
                return back()->with('error', 'Invalid report type selected');
        }

        // ✅ Save report request to DB
        $report = Report::create([
            'report_type' => $validated['report_type'],
            'user_id'     => Auth::id(),
            'filters'     => json_encode($validated),
        ]);

        // ✅ Export to PDF
        if ($validated['export'] === 'pdf') {
            $pdf = Pdf::loadView('reports.pdf', [
                'reportType' => $validated['report_type'],
                'data'       => $data,
                'filters'    => $validated
            ]);
            return $pdf->download('report_' . $validated['report_type'] . '.pdf');
        }

        // ✅ fallback to HTML view
        return view('reports.result', [
            'reportType' => $validated['report_type'],
            'data'       => $data,
            'filters'    => $validated,
            'report'     => $report
        ]);
    }
}
