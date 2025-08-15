<!-- resources/views/staff/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Staff Management</h1>

    <!-- Add Staff Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addStaffModal">
        <i class="bi bi-plus-circle"></i> Add Staff
    </button>

    <!-- Staff Table -->

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Site</th>
                <th>Name</th>
                <th>Employee Code</th>
                <th>Role</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Hired At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($staffs as $staff)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $staff->site->name ?? 'N/A' }}</td>
                <td>{{ $staff->first_name }} {{ $staff->last_name }}</td>
                <td>{{ $staff->employee_code }}</td>
                <td>{{ ucfirst($staff->role) }}</td>
                <td>{{ $staff->email ?? '-' }}</td>
                <td>{{ $staff->phone ?? '-' }}</td>
                <td>{{ $staff->hired_at ? \Carbon\Carbon::parse($staff->hired_at)->format('Y-m-d') : '-' }}</td>
                <td>
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editStaffModal{{ $staff->id }}">
                        Edit
                    </button>
                    <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this staff?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="9" class="text-center">No staff found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@foreach( $staffs as $staff)
<!-- Edit Staff Modal -->
<div class="modal fade" id="editStaffModal{{ $staff->id }}" tabindex="-1" aria-labelledby="editStaffModalLabel{{ $staff->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('staff.update', $staff->id) }}" class="modal-content">
            @csrf @method('PUT')
           
                <div class="modal-header">
                    <h5 class="modal-title">Edit Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Site</label>
                        <select name="site_id" class="form-select" required>
                            @foreach($sites as $site)
                            <option value="{{ $site->id }}" {{ $site->id == $staff->site_id ? 'selected' : '' }}>
                                {{ $site->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $staff->first_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ $staff->last_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Employee Code</label>
                        <input type="text" name="employee_code" class="form-control" value="{{ $staff->employee_code }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            @foreach(['manager','operator','technician','laborer','admin'] as $role)
                            <option value="{{ $role }}" {{ $role == $staff->role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $staff->email }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ $staff->phone }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hired At</label>
                        <input type="date" name="hired_at" class="form-control" value="{{ $staff->hired_at }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Staff</button>
                </div>
            
        </form>
    </div>
</div>
@endforeach
<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('staff.store') }}" class="modal-content">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Site</label>
                        <select name="site_id" class="form-select" required>
                            @foreach($sites as $site)
                            <option value="{{ $site->id }}">{{ $site->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            @foreach(['manager','operator','technician','laborer','admin'] as $role)
                            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hired At</label>
                        <input type="date" name="hired_at" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Staff</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection