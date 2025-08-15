@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Attendance Logs</h1>

    <!-- Add Attendance Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createAttendanceModal">Add Attendance</button>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Staff</th>
                    <th>Site</th>
                    <th>Shift Date</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $log->staff->first_name }} {{ $log->staff->last_name }}</td>
                    <td>{{ $log->staff->site->name }}</td>
                    <td>{{ $log->shift_date->format('d M Y') }}</td>
                    <td>{{ $log->clock_in?->format('H:i') }}</td>
                    <td>{{ $log->clock_out?->format('H:i') }}</td>
                    <td>{{ ucfirst($log->status) }}</td>
                    <td>{{ Str::limit($log->remarks,30) }}</td>
                    <td>
                        <!-- Edit -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAttendanceModal{{ $log->id }}">Edit</button>
                        <!-- Delete -->
                        <form action="{{ route('attendance_logs.destroy', $log) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this log?')">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editAttendanceModal{{ $log->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('attendance_logs.update', $log) }}" class="modal-content">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Attendance</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Staff</label>
                                    <select name="staff_id" class="form-select" required>
                                        <option value="">Select Staff</option>
                                        @foreach($staffs as $staff)
                                        <option value="{{ $staff->id }}" {{ isset($log) && $log->staff_id==$staff->id ? 'selected' : '' }}>
                                            {{ $staff->first_name }} {{ $staff->last_name }} ({{ $staff->site->name }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Shift Date</label>
                                    <input type="date" name="shift_date" class="form-control" value="{{ $log->shift_date?->format('Y-m-d') ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Clock In</label>
                                    <input type="time" name="clock_in" class="form-control" value="{{ $log->clock_in?->format('H:i') ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Clock Out</label>
                                    <input type="time" name="clock_out" class="form-control" value="{{ $log->clock_out?->format('H:i') ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        @foreach(['present','absent','leave','sick'] as $status)
                                        <option value="{{ $status }}" {{ isset($log) && $log->status==$status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Remarks</label>
                                    <textarea name="remarks" class="form-control">{{ $log->remarks ?? '' }}</textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createAttendanceModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('attendance_logs.store') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Staff</label>
                        <select name="staff_id" class="form-select" required>
                            <option value="">Select Staff</option>
                            @foreach($staffs as $staff)
                            <option value="{{ $staff->id }}">
                                {{ $staff->first_name }} {{ $staff->last_name }} ({{ $staff->site->name }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Shift Date</label>
                        <input type="date" name="shift_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Clock In</label>
                        <input type="time" name="clock_in" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Clock Out</label>
                        <input type="time" name="clock_out" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            @foreach(['present','absent','leave','sick'] as $status)
                            <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Attendance</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection