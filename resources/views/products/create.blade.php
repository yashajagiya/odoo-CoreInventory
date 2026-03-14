@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary mb-3">&larr; Back to List</a>
    <h2 class="h4 mb-0 text-gray-800 fw-bold">New Product Registration</h2>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="Product full name">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">SKU <span class="text-danger">*</span></label>
                    <input type="text" name="sku" class="form-control" required placeholder="Unique Code">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                    <select name="category" class="form-select" required>
                        <option value="">Select Category...</option>
                        <option value="Raw Materials">Raw Materials</option>
                        <option value="Finished Goods">Finished Goods</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Unit of Measure <span class="text-danger">*</span></label>
                    <select name="unit_of_measure" class="form-select" required>
                        <option value="Units">Units</option>
                        <option value="Kg">Kilograms (Kg)</option>
                        <option value="Liters">Liters (L)</option>
                        <option value="Boxes">Boxes</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Reorder Level <span class="text-danger">*</span></label>
                    <input type="number" name="reorder_level" class="form-control" min="0" value="10" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Initial Stock <span class="text-muted fw-normal">(Optional)</span></label>
                    <input type="number" name="initial_stock" class="form-control" min="0" value="0">
                </div>
            </div>
            <hr class="my-4 text-muted">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4 fw-bold">Save Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
