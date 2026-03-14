@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-secondary mb-3">&larr; Back to Product</a>
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Edit Product: {{ $product->name }}</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h6 class="fw-bold mb-3 border-bottom pb-2">Product Details</h6>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Product SKU</label>
                            <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Category</label>
                            <input type="text" name="category" class="form-control" value="{{ old('category', $product->category) }}">
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Unit of Measure</label>
                            <select name="unit_of_measure" class="form-select" required>
                                <option value="pcs" {{ old('unit_of_measure', $product->unit_of_measure) == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                                <option value="kg" {{ old('unit_of_measure', $product->unit_of_measure) == 'kg' ? 'selected' : '' }}>Kilograms (kg)</option>
                                <option value="liters" {{ old('unit_of_measure', $product->unit_of_measure) == 'liters' ? 'selected' : '' }}>Liters (L)</option>
                                <option value="boxes" {{ old('unit_of_measure', $product->unit_of_measure) == 'boxes' ? 'selected' : '' }}>Boxes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">Reorder Level</label>
                            <input type="number" name="reorder_level" class="form-control" value="{{ old('reorder_level', $product->reorder_level) }}" required min="0">
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
