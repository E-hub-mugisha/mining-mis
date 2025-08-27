@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>📊 Reports</h2>
    <form action="{{ route('reports.generate') }}" method="POST" class="card p-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Select Report Type</label>
            <select class="form-select" name="report_type" required>
                <option value="">-- Choose Report --</option>
                <option value="staff_attendance">Staff Attendance</option>
                <option value="safety_incidents">Safety Incidents</option>
                <!-- <option value="equipment_usage">Equipment Usage</option> -->
            </select>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Date From</label>
                <input type="date" name="date_from" class="form-control">
            </div>
            <div class="col">
                <label class="form-label">Date To</label>
                <input type="date" name="date_to" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Site</label>
                <select class="form-select" name="site_id">
                    <option value="">All Sites</option>
                    @foreach($sites as $site)
                        <option value="{{ $site->id }}">{{ $site->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <label class="form-label">Staff</label>
                <select class="form-select" name="staff_id">
                    <option value="">All Staff</option>
                    @foreach($staff as $s)
                        <option value="{{ $s->id }}">{{ $s->first_name }} {{ $s->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <label class="form-label">Equipment</label>
                <select class="form-select" name="equipment_id">
                    <option value="">All Equipment</option>
                    @foreach($equipment as $e)
                        <option value="{{ $e->id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Export Format</label>
            <select class="form-select" name="export">
                <option value="html">View in Browser</option>
                <option value="pdf">Download PDF</option>
            </select>
        </div>

        <button class="btn btn-primary">Generate Report</button>
    </form>
</div>
@endsection
