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
