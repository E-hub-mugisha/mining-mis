@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Resource Items</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createResourceModal">
        Add Resource Item
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Site</th>
                <th>Name</th>
                <th>Category</th>
                <th>Unit</th>
                <th>Current Stock</th>
                <th>Min Stock</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resourceItems as $item)
            <tr>
                <td>{{ $item->site->name }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->unit }}</td>
                <td>{{ $item->current_stock }}</td>
                <td>{{ $item->min_stock }}</td>
                <td>{{ Str::limit($item->notes, 30) }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editResourceModal{{ $item->id }}">Edit</button>
                    <form action="{{ route('resource_items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this item?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editResourceModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('resource_items.update', $item) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Resource Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Site</label>
                                <select name="site_id" class="form-select" required>
                                    @foreach($sites as $site)
                                    <option value="{{ $site->id }}" {{ $item->site_id == $site->id ? 'selected' : '' }}>{{ $site->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Category</label>
                                <input type="text" name="category" class="form-control" value="{{ $item->category }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Unit</label>
                                <input type="text" name="unit" class="form-control" value="{{ $item->unit }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Current Stock</label>
                                <input type="number" name="current_stock" class="form-control" value="{{ $item->current_stock }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Min Stock</label>
                                <input type="number" name="min_stock" class="form-control" value="{{ $item->min_stock }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Notes</label>
                                <textarea name="notes" class="form-control">{{ $item->notes }}</textarea>
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

    {{ $resourceItems->links() }}
</div>

<!-- Create Modal -->
<div class="modal fade" id="createResourceModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('resource_items.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Resource Item</h5>
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
                    <label>Category</label>
                    <input type="text" name="category" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Unit</label>
                    <input type="text" name="unit" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Current Stock</label>
                    <input type="number" name="current_stock" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Min Stock</label>
                    <input type="number" name="min_stock" class="form-control" required>
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