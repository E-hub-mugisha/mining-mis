@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Safety Incidents</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createIncidentModal">Add Incident</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Site</th>
                <th>Occurred At</th>
                <th>Severity</th>
                <th>Description</th>
                <th>Resolved</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incidents as $incident)
            <tr>
                <td>{{ $incident->site->name }}</td>
                <td>{{ $incident->occurred_at?->format('d M Y H:i') }}</td>
                <td>{{ ucfirst($incident->severity) }}</td>
                <td>{{ Str::limit($incident->description, 40) }}</td>
                <td>
                    @if($incident->is_resolved)
                        <span class="badge bg-success">Yes</span>
                    @else
                        <span class="badge bg-danger">No</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editIncidentModal{{ $incident->id }}">Edit</button>
                    <form action="{{ route('safety-incidents.destroy', $incident) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this incident?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editIncidentModal{{ $incident->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('safety-incidents.update', $incident) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Incident</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Site</label>
                                <select name="site_id" class="form-select" required>
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id }}" {{ $incident->site_id==$site->id?'selected':'' }}>{{ $site->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Occurred At</label>
                                <input type="datetime-local" name="occurred_at" class="form-control" value="{{ $incident->occurred_at?->format('Y-m-d\TH:i') }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Severity</label>
                                <select name="severity" class="form-select" required>
                                    @foreach(['minor','moderate','major','critical'] as $sev)
                                        <option value="{{ $sev }}" {{ $incident->severity==$sev?'selected':'' }}>{{ ucfirst($sev) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" required>{{ $incident->description }}</textarea>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="is_resolved" value="1" class="form-check-input" {{ $incident->is_resolved?'checked':'' }}>
                                <label class="form-check-label">Resolved</label>
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

    {{ $incidents->links() }}
</div>

<!-- Create Modal -->
<div class="modal fade" id="createIncidentModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('safety-incidents.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Safety Incident</h5>
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
                    <label>Occurred At</label>
                    <input type="datetime-local" name="occurred_at" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Severity</label>
                    <select name="severity" class="form-select" required>
                        @foreach(['minor','moderate','major','critical'] as $sev)
                            <option value="{{ $sev }}">{{ ucfirst($sev) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_resolved" value="1" class="form-check-input">
                    <label class="form-check-label">Resolved</label>
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
