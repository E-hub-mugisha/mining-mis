<div class="mb-3">
    <label for="site_id" class="form-label">Site</label>
    <select name="site_id" class="form-select" required>
        <option value="">Select Site</option>
        @foreach($sites as $site)
            <option value="{{ $site->id }}" {{ isset($staff) && $staff->site_id==$site->id ? 'selected' : '' }}>{{ $site->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">First Name</label>
    <input type="text" name="first_name" class="form-control" value="{{ $staff->first_name ?? '' }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Last Name</label>
    <input type="text" name="last_name" class="form-control" value="{{ $staff->last_name ?? '' }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Employee Code</label>
    <input type="text" name="employee_code" class="form-control" value="{{ $staff->employee_code ?? '' }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role" class="form-select" required>
        @foreach(['manager','operator','technician','laborer','admin'] as $role)
            <option value="{{ $role }}" {{ isset($staff) && $staff->role==$role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ $staff->email ?? '' }}">
</div>

<div class="mb-3">
    <label class="form-label">Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ $staff->phone ?? '' }}">
</div>

<div class="mb-3">
    <label class="form-label">Date of Birth</label>
    <input type="date" name="date_of_birth" class="form-control" value="{{ $staff->date_of_birth?->format('Y-m-d') ?? '' }}">
</div>

<div class="mb-3">
    <label class="form-label">Hired At</label>
    <input type="date" name="hired_at" class="form-control" value="{{ $staff->hired_at?->format('Y-m-d') ?? '' }}">
</div>
