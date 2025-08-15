@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Sites</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Site Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSiteModal">
        Add New Site
    </button>

    <!-- Sites Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Location</th>
                <th>Manager</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sites as $site)
            <tr>
                <td>{{ $site->name }}</td>
                <td>{{ $site->code }}</td>
                <td>{{ $site->location }}</td>
                <td>{{ $site->manager?->name ?? '-' }}</td>
                <td>
                    <!-- Edit Button triggers the modal for this site -->
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editSiteModal{{ $site->id }}">
                        Edit
                    </button>

                    <form action="{{ route('sites.destroy', $site) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this site?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>


            @endforeach
        </tbody>
    </table>

    {{ $sites->links() }}

</div>

<!-- Edit Modal for each site -->
@foreach( $sites as $site)
<!-- Edit Modal -->
<div class="modal fade" id="editSiteModal{{ $site->id }}" tabindex="-1" aria-labelledby="editSiteLabel{{ $site->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('sites.update', $site) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="editSiteLabel{{ $site->id }}">Edit Site</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Site Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $site->name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Code</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code', $site->code) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location', $site->location) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Manager</label>
                    <select name="manager_id" class="form-select">
                        <option value="">-- Select Manager --</option>
                        @foreach($managers as $manager)
                        <option value="{{ $manager->id }}" {{ old('manager_id', $site->manager_id) == $manager->id ? 'selected' : '' }}>
                            {{ $manager->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control">{{ old('notes', $site->notes) }}</textarea>
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
<!-- Create Modal -->
<div class="modal fade" id="createSiteModal" tabindex="-1" aria-labelledby="createSiteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('sites.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="createSiteLabel">Add New Site</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Site Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Code</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Manager</label>
                    <select name="manager_id" class="form-select">
                        <option value="">-- Select Manager --</option>
                        @foreach($managers as $manager)
                        <option value="{{ $manager->id }}" {{ old('manager_id') == $manager->id ? 'selected' : '' }}>
                            {{ $manager->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

@endsection