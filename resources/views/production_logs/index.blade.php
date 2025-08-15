@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Production Logs</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createLogModal">Add Production Log</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Site</th>
                <th>Date</th>
                <th>Ore (t)</th>
                <th>Waste (t)</th>
                <th>Avg Grade (g/t)</th>
                <th>Truck Trips</th>
                <th>Downtime (min)</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->site->name }}</td>
                <td>{{ $log->date?->format('d M Y') }}</td>
                <td>{{ $log->ore_tonnage }}</td>
                <td>{{ $log->waste_tonnage }}</td>
                <td>{{ $log->avg_grade ?? '-' }}</td>
                <td>{{ $log->truck_trips }}</td>
                <td>{{ $log->downtime_minutes }}</td>
                <td>{{ Str::limit($log->notes,40) }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editLogModal{{ $log->id }}">Edit</button>
                    <form action="{{ route('production-logs.destroy', $log) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this log?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editLogModal{{ $log->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('production-logs.update', $log) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Production Log</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Site</label>
                                <select name="site_id" class="form-select" required>
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id }}" {{ $log->site_id==$site->id ? 'selected':'' }}>{{ $site->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" value="{{ $log->date?->format('Y-m-d') }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Ore Tonnage</label>
                                <input type="number" step="0.01" name="ore_tonnage" class="form-control" value="{{ $log->ore_tonnage }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Waste Tonnage</label>
                                <input type="number" step="0.01" name="waste_tonnage" class="form-control" value="{{ $log->waste_tonnage }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Avg Grade (g/t)</label>
                                <input type="number" step="0.0001" name="avg_grade" class="form-control" value="{{ $log->avg_grade }}">
                            </div>
                            <div class="mb-3">
                                <label>Truck Trips</label>
                                <input type="number" name="truck_trips" class="form-control" value="{{ $log->truck_trips }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Downtime Minutes</label>
                                <input type="number" name="downtime_minutes" class="form-control" value="{{ $log->downtime_minutes }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Notes</label>
                                <textarea name="notes" class="form-control">{{ $log->notes }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>

    {{ $logs->links() }}
</div>

<!-- Create Modal -->
<div class="modal fade" id="createLogModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('production-logs.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Production Log</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Site</label>
                    <select name="site_id" class="form-select" required>
                        @foreach($sites as $site)
                            <option value="{{ $site->id }}">{{ $site->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Ore Tonnage</label>
                    <input type="number" step="0.01" name="ore_tonnage" class="form-control" value="0" required>
                </div>
                <div class="mb-3">
                    <label>Waste Tonnage</label>
                    <input type="number" step="0.01" name="waste_tonnage" class="form-control" value="0" required>
                </div>
                <div class="mb-3">
                    <label>Avg Grade (g/t)</label>
                    <input type="number" step="0.0001" name="avg_grade" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Truck Trips</label>
                    <input type="number" name="truck_trips" class="form-control" value="0" required>
                </div>
                <div class="mb-3">
                    <label>Downtime Minutes</label>
                    <input type="number" name="downtime_minutes" class="form-control" value="0" required>
                </div>
                <div class="mb-3">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection
