<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Mining Site Report: {{ ucfirst(str_replace('_',' ',$reportType)) }}</h2>
    <p>Generated on: {{ now()->format('d M Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                @if($reportType === 'staff_attendance')
                    <th>Staff</th>
                    <th>Site</th>
                    <th>Role</th>
                    <th>Hired At</th>
                @elseif($reportType === 'equipment_usage')
                    <th>Equipment</th>
                    <th>Site</th>
                    <th>Hours Used</th>
                    <th>Date</th>
                @elseif($reportType === 'safety_incidents')
                    <th>Site</th>
                    <th>Occurred At</th>
                    <th>Severity</th>
                    <th>Description</th>
                    <th>Resolved</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($data as $r)
                <tr>
                    @if($reportType === 'staff_attendance')
                        <td>{{ $r->staff->first_name ?? '' }} {{ $r->staff->last_name ?? '' }}</td>
                        <td>{{ $r->staff->site->name ?? 'N/A' }}</td>
                        <td>{{ ucfirst($r->staff->role ?? '') }}</td>
                        <td>{{ $r->staff->hired_at?->format('d M Y') }}</td>
                    @elseif($reportType === 'equipment_usage')
                        <td>{{ $r->equipment->name ?? '' }}</td>
                        <td>{{ $r->equipment->site->name ?? '' }}</td>
                        <td>{{ $r->hours_used ?? 0 }}</td>
                        <td>{{ $r->used_at?->format('d M Y') }}</td>
                    @elseif($reportType === 'safety_incidents')
                        <td>{{ $r->site->name ?? '' }}</td>
                        <td>{{ $r->occurred_at?->format('d M Y H:i') }}</td>
                        <td>{{ ucfirst($r->severity) }}</td>
                        <td>{{ $r->description }}</td>
                        <td>{{ $r->is_resolved ? 'Yes' : 'No' }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
