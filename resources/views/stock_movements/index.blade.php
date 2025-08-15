@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Stock Movements</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createStockModal">Add Stock Movement</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Resource Item</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Reference</th>
                <th>Remarks</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stockMovements as $sm)
            <tr>
                <td>{{ $sm->resourceItem->name }}</td>
                <td>
                    @if($sm->type=='in')
                        <span class="badge bg-success">In</span>
                    @else
                        <span class="badge bg-danger">Out</span>
                    @endif
                </td>
                <td>{{ $sm->quantity }}</td>
                <td>{{ $sm->reference }}</td>
                <td>{{ Str::limit($sm->remarks,30) }}</td>
                <td>{{ $sm->created_at->format('d M Y') }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editStockModal{{ $sm->id }}">Edit</button>
                    <form action="{{ route('stock-movements.destroy', $sm) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this record?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editStockModal{{ $sm->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('stock-movements.update', $sm) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Stock Movement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Resource Item</label>
                                <select name="resource_item_id" class="form-select" required>
                                    @foreach($resourceItems as $item)
                                        <option value="{{ $item->id }}" {{ $sm->resource_item_id==$item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Type</label>
                                <select name="type" class="form-select" required>
                                    <option value="in" {{ $sm->type=='in' ? 'selected' : '' }}>In</option>
                                    <option value="out" {{ $sm->type=='out' ? 'selected' : '' }}>Out</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Quantity</label>
                                <input type="number" step="0.01" name="quantity" class="form-control" value="{{ $sm->quantity }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Reference</label>
                                <input type="text" name="reference" class="form-control" value="{{ $sm->reference }}">
                            </div>
                            <div class="mb-3">
                                <label>Remarks</label>
                                <textarea name="remarks" class="form-control">{{ $sm->remarks }}</textarea>
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

    {{ $stockMovements->links() }}
</div>

<!-- Create Modal -->
<div class="modal fade" id="createStockModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('stock-movements.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Stock Movement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Resource Item</label>
                    <select name="resource_item_id" class="form-select" required>
                        @foreach($resourceItems as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Type</label>
                    <select name="type" class="form-select" required>
                        <option value="in">In</option>
                        <option value="out">Out</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="number" step="0.01" name="quantity" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Reference</label>
                    <input type="text" name="reference" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Remarks</label>
                    <textarea name="remarks" class="form-control"></textarea>
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
