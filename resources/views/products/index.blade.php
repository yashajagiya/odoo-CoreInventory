@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0 text-gray-800 fw-bold">Products</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary fw-bold">Create Product</a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body bg-white rounded">
        <form method="GET" action="{{ route('products.index') }}" class="row g-3">
            <div class="col-md-6">
                <label class="form-label text-muted small fw-bold">Search (Name / SKU)</label>
                <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label text-muted small fw-bold">Category</label>
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
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
                    <td class="ps-4 fw-bold"><a href="{{ route('products.show', $product->id) }}">{{ $product->sku }}</a></td>
                    <td><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></td>
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
