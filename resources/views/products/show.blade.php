@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary mb-3">&larr; Back to Products</a>
        <h2 class="h4 mb-0 text-gray-800 fw-bold">{{ $product->name }}</h2>
        <p class="text-muted small mb-0">SKU: {{ $product->sku }} | Category: {{ $product->category ?? 'Uncategorized' }}</p>
    </div>
    @if(auth()->check() && in_array(strtolower(auth()->user()->role), ['manager', 'admin']))
    <div class="d-flex gap-2">
        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary fw-bold">Edit Product</a>
        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product permanently?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger fw-bold">Delete</button>
        </form>
    </div>
    @endif
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3 border-bottom pb-2">Product Overview</h6>
                <div class="row mb-2">
                    <div class="col-sm-6 text-muted fw-bold small">Unit of Measure</div>
                    <div class="col-sm-6 text-end">{{ $product->unit_of_measure }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6 text-muted fw-bold small">Reorder Level</div>
                    <div class="col-sm-6 text-end">{{ $product->reorder_level }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6 text-muted fw-bold small">Total Stock (Aggregated)</div>
                    <div class="col-sm-6 text-end fw-bold {{ $product->total_stock < $product->reorder_level ? 'text-danger' : 'text-success' }}">
                        {{ $product->total_stock }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3 border-bottom pb-2">Stock By Location</h6>
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Location Name</th>
                            <th>Location Type</th>
                            <th class="text-end pe-3">Current Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stockByLocation as $stock)
                        <tr>
                            <td class="ps-3 fw-bold">{{ $stock->location->name }}</td>
                            <td><span class="badge bg-secondary">{{ ucfirst($stock->location->type) }}</span></td>
                            <td class="text-end pe-3 fw-bold">{{ $stock->total_stock }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">No stock available at any location.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
