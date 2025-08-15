<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceLog;
use App\Models\Staff;

class AttendanceLogController extends Controller
{
    public function index()
    {
        $logs = AttendanceLog::with('staff.site')->latest()->paginate(15);
        $staffs = Staff::all();
        return view('attendance_logs.index', compact('logs','staffs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id'=>'required|exists:staff,id',
            'shift_date'=>'required|date',
            'clock_in'=>'nullable|date_format:H:i',
            'clock_out'=>'nullable|date_format:H:i|after_or_equal:clock_in',
            'status'=>'required|in:present,absent,leave,sick',
            'remarks'=>'nullable|string'
        ]);

        AttendanceLog::create($validated);
        return redirect()->route('attendance_logs.index')->with('success','Attendance logged.');
    }

    public function update(Request $request, AttendanceLog $attendanceLog)
    {
        $validated = $request->validate([
            'staff_id'=>'required|exists:staff,id',
            'shift_date'=>'required|date',
            'clock_in'=>'nullable|date_format:H:i',
            'clock_out'=>'nullable|date_format:H:i|after_or_equal:clock_in',
            'status'=>'required|in:present,absent,leave,sick',
            'remarks'=>'nullable|string'
        ]);

        $attendanceLog->update($validated);
        return redirect()->route('attendance_logs.index')->with('success','Attendance updated.');
    }

    public function destroy(AttendanceLog $attendanceLog)
    {
        $attendanceLog->delete();
        return redirect()->route('attendance_logs.index')->with('success','Attendance deleted.');
    }
}
