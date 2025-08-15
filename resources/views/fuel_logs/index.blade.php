@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Fuel Logs</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createFuelModal">Add Fuel Log</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Equipment</th>
                <th>Filled At</th>
                <th>Liters</th>
                <th>Odometer / Hours</th>
                <th>Issuer</th>
                <th>Date Logged</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fuelLogs as $log)
            <tr>
                <td>{{ $log->equipment->name }}</td>
                <td>{{ $log->filled_at->format('d M Y H:i') }}</td>
                <td>{{ $log->liters }}</td>
                <td>{{ $log->odometer_or_hours ?? '-' }}</td>
                <td>{{ $log->issuer ?? '-' }}</td>
                <td>{{ $log->created_at->format('d M Y') }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editFuelModal{{ $log->id }}">Edit</button>
                    <form action="{{ route('fuel-logs.destroy', $log) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this log?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editFuelModal{{ $log->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('fuel-logs.update', $log) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Fuel Log</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Equipment</label>
                                <select name="equipment_id" class="form-select" required>
                                    @foreach($equipment as $eq)
                                        <option value="{{ $eq->id }}" {{ $log->equipment_id==$eq->id ? 'selected' : '' }}>{{ $eq->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Filled At</label>
                                <input type="datetime-local" name="filled_at" class="form-control" value="{{ $log->filled_at->format('Y-m-d\TH:i') }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Liters</label>
                                <input type="number" step="0.01" name="liters" class="form-control" value="{{ $log->liters }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Odometer / Hours</label>
                                <input type="number" step="0.01" name="odometer_or_hours" class="form-control" value="{{ $log->odometer_or_hours }}">
                            </div>
                            <div class="mb-3">
                                <label>Issuer</label>
                                <input type="text" name="issuer" class="form-control" value="{{ $log->issuer }}">
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

    {{ $fuelLogs->links() }}
</div>

<!-- Create Modal -->
<div class="modal fade" id="createFuelModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('fuel-logs.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Fuel Log</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Equipment</label>
                    <select name="equipment_id" class="form-select" required>
                        @foreach($equipment as $eq)
                            <option value="{{ $eq->id }}">{{ $eq->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Filled At</label>
                    <input type="datetime-local" name="filled_at" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Liters</label>
                    <input type="number" step="0.01" name="liters" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Odometer / Hours</label>
                    <input type="number" step="0.01" name="odometer_or_hours" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Issuer</label>
                    <input type="text" name="issuer" class="form-control">
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
