@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Maintenance Jobs</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createJobModal">Add Maintenance Job</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Equipment</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Scheduled For</th>
                <th>Completed At</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->equipment->name }}</td>
                <td>
                    <span class="badge 
                        @if($job->priority=='high') bg-danger 
                        @elseif($job->priority=='medium') bg-warning 
                        @else bg-secondary @endif">
                        {{ ucfirst($job->priority) }}
                    </span>
                </td>
                <td>
                    <span class="badge 
                        @if($job->status=='open') bg-secondary 
                        @elseif($job->status=='in_progress') bg-info 
                        @else bg-success @endif">
                        {{ str_replace('_',' ', ucfirst($job->status)) }}
                    </span>
                </td>
                <td>{{ $job->scheduled_for?->format('d M Y') ?? '-' }}</td>
                <td>{{ $job->completed_at?->format('d M Y') ?? '-' }}</td>
                <td>{{ Str::limit($job->description,40) }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editJobModal{{ $job->id }}">Edit</button>
                    <form action="{{ route('maintenance.destroy', $job) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this job?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editJobModal{{ $job->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('maintenance.update', $job) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Maintenance Job</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Equipment</label>
                                <select name="equipment_id" class="form-select" required>
                                    @foreach($equipment as $eq)
                                        <option value="{{ $eq->id }}" {{ $job->equipment_id==$eq->id ? 'selected' : '' }}>{{ $eq->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Priority</label>
                                <select name="priority" class="form-select" required>
                                    <option value="low" {{ $job->priority=='low'? 'selected':'' }}>Low</option>
                                    <option value="medium" {{ $job->priority=='medium'? 'selected':'' }}>Medium</option>
                                    <option value="high" {{ $job->priority=='high'? 'selected':'' }}>High</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="open" {{ $job->status=='open'? 'selected':'' }}>Open</option>
                                    <option value="in_progress" {{ $job->status=='in_progress'? 'selected':'' }}>In Progress</option>
                                    <option value="done" {{ $job->status=='done'? 'selected':'' }}>Done</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Scheduled For</label>
                                <input type="date" name="scheduled_for" class="form-control" value="{{ $job->scheduled_for?->format('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <label>Completed At</label>
                                <input type="date" name="completed_at" class="form-control" value="{{ $job->completed_at?->format('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{ $job->description }}</textarea>
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

    {{ $jobs->links() }}
</div>

<!-- Create Modal -->
<div class="modal fade" id="createJobModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('maintenance.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Maintenance Job</h5>
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
                    <label>Priority</label>
                    <select name="priority" class="form-select" required>
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select" required>
                        <option value="open" selected>Open</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Scheduled For</label>
                    <input type="date" name="scheduled_for" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Completed At</label>
                    <input type="date" name="completed_at" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
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
