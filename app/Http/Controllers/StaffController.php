<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Site;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::with('site')->paginate(10);
        $sites = Site::all();
        return view('staff.index', compact('staffs','sites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_id'=>'required|exists:sites,id',
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'role'=>'required|in:manager,operator,technician,laborer,admin',
            'email'=>'nullable|email|unique:staff,email',
            'phone'=>'nullable|string',
            'date_of_birth'=>'nullable|date',
            'hired_at'=>'nullable|date',
        ]);

        // auto generate employee_code
        $validated['employee_code'] = 'EMP-' . strtoupper(uniqid());

        Staff::create($validated);
        return redirect()->route('staff.index')->with('success','Staff added.');
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'site_id'=>'required|exists:sites,id',
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'employee_code'=>"required|unique:staff,employee_code,{$staff->id}",
            'role'=>'required|in:manager,operator,technician,laborer,admin',
            'email'=>"nullable|email|unique:staff,email,{$staff->id}",
            'phone'=>'nullable|string',
            'date_of_birth'=>'nullable|date',
            'hired_at'=>'nullable|date',
        ]);

        $staff->update($validated);
        return redirect()->route('staff.index')->with('success','Staff updated.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success','Staff deleted.');
    }
}
