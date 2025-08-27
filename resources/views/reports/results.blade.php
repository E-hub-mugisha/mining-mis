@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Report: {{ ucfirst(str_replace('_',' ',$reportType)) }}</h3>
    <p><strong>Filters:</strong> {{ json_encode($filters) }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                @if($reportType == 'staff_attendance')
                    <th>Staff</th><th>Check In</th><th>Check Out</th>
                @elseif($reportType == 'safety_incidents')
                    <th>Date</th><th>Severity</th><th>Description</th><th>Status</th>
                @elseif($reportType == 'equipment_usage')
                    <th>Equipment</th><th>Used At</th><th>Notes</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
                <tr>
                    @if($reportType == 'staff_attendance')
                        <td>{{ $row->staff->first_name }} {{ $row->staff->last_name }}</td>
                        <td>{{ $row->check_in }}</td>
                        <td>{{ $row->check_out }}</td>
                    @elseif($reportType == 'safety_incidents')
                        <td>{{ $row->occurred_at }}</td>
                        <td>{{ ucfirst($row->severity) }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->is_resolved ? 'Resolved' : 'Pending' }}</td>
                    @elseif($reportType == 'equipment_usage')
                        <td>{{ $row->equipment->name }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->notes }}</td>
                    @endif
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No records found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
