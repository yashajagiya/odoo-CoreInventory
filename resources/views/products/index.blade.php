@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0 text-gray-800 fw-bold">Products</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary fw-bold">Create Product</a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body bg-white rounded">
        <form method="GET" action="{{ route('products.index') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label text-muted small fw-bold">Search by SKU</label>
                <input type="text" name="sku" class="form-control" placeholder="SKU..." value="{{ request('sku') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small fw-bold">Category</label>
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    <option value="Raw Materials" {{ request('category') == 'Raw Materials' ? 'selected' : '' }}>Raw Materials</option>
                    <option value="Finished Goods" {{ request('category') == 'Finished Goods' ? 'selected' : '' }}>Finished Goods</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small fw-bold">Document Type</label>
                <select name="document_type" class="form-select">
                    <option value="">All Types</option>
                    <option value="Consumable" {{ request('document_type') == 'Consumable' ? 'selected' : '' }}>Consumable</option>
                    <option value="Storable" {{ request('document_type') == 'Storable' ? 'selected' : '' }}>Storable</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Archived" {{ request('status') == 'Archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">SKU</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>UoM</th>
                    <th>Total Stock</th>
                    <th>Reorder Level</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="{{ $product->total_stock < $product->reorder_level ? 'table-danger text-danger' : '' }}">
                    <td class="ps-4 fw-bold">{{ $product->sku }}</td>
                    <td>{{ $product->name }}</td>
                    <td><span class="badge bg-secondary">{{ $product->category }}</span></td>
                    <td>{{ $product->unit_of_measure }}</td>
                    <td class="fw-bold">{{ $product->total_stock }}</td>
                    <td>{{ $product->reorder_level }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
