@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Equipment</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createEquipmentModal">Add Equipment</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Site</th>
                <th>Name</th>
                <th>Type</th>
                <th>Serial</th>
                <th>Status</th>
                <th>Last Maintenance</th>
                <th>Hours Meter</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipment as $eq)
            <tr>
                <td>{{ $eq->site->name }}</td>
                <td>{{ $eq->name }}</td>
                <td>{{ $eq->type }}</td>
                <td>{{ $eq->serial }}</td>
                <td>
                    @if($eq->status=='active')
                        <span class="badge bg-success">Active</span>
                    @elseif($eq->status=='down')
                        <span class="badge bg-danger">Down</span>
                    @else
                        <span class="badge bg-warning text-dark">Maintenance</span>
                    @endif
                </td>
                <td>{{ $eq->last_maintenance_at?->format('d M Y') ?? '-' }}</td>
                <td>{{ $eq->hours_meter }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editEquipmentModal{{ $eq->id }}">Edit</button>
                    <form action="{{ route('equipment.destroy', $eq) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this equipment?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editEquipmentModal{{ $eq->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('equipment.update', $eq) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Equipment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Site</label>
                                <select name="site_id" class="form-select" required>
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id }}" {{ $eq->site_id == $site->id ? 'selected' : '' }}>{{ $site->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $eq->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Type</label>
                                <input type="text" name="type" class="form-control" value="{{ $eq->type }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Serial</label>
                                <input type="text" name="serial" class="form-control" value="{{ $eq->serial }}">
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="active" {{ $eq->status=='active' ? 'selected' : '' }}>Active</option>
                                    <option value="down" {{ $eq->status=='down' ? 'selected' : '' }}>Down</option>
                                    <option value="maintenance" {{ $eq->status=='maintenance' ? 'selected' : '' }}>Maintenance</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Last Maintenance Date</label>
                                <input type="date" name="last_maintenance_at" class="form-control" value="{{ $eq->last_maintenance_at?->format('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <label>Hours Meter</label>
                                <input type="number" name="hours_meter" class="form-control" value="{{ $eq->hours_meter }}" required>
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

    {{ $equipment->links() }}
</div>

<!-- Create Modal -->
<div class="modal fade" id="createEquipmentModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('equipment.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Equipment</h5>
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
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Type</label>
                    <input type="text" name="type" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Serial</label>
                    <input type="text" name="serial" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active">Active</option>
                        <option value="down">Down</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Last Maintenance Date</label>
                    <input type="date" name="last_maintenance_at" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Hours Meter</label>
                    <input type="number" name="hours_meter" class="form-control" value="0" required>
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
