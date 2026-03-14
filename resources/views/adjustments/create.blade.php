@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('adjustments.index') }}" class="btn btn-sm btn-outline-secondary mb-3">&larr; Back to Adjustments</a>
    <h2 class="h4 mb-0 text-gray-800 fw-bold">New Inventory Adjustment</h2>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('adjustments.store') }}" method="POST">
            @csrf
            
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Location <span class="text-danger">*</span></label>
                    <select name="location_id" class="form-select" required>
                        <option value="">Select Location...</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Product <span class="text-danger">*</span></label>
                    <select name="product_id" class="form-select" required>
                        <option value="">Select Product...</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (SKU: {{ $product->sku }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Actual Physical Count <span class="text-danger">*</span></label>
                    <input type="number" name="physical_count" class="form-control" required min="0" placeholder="e.g. 50">
                    <small class="text-muted">Enter the exact stock quantity counted on shelves today.</small>
                </div>
            </div>

            <hr class="my-4 text-muted">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4 fw-bold">Save Adjustment</button>
            </div>
        </form>
    </div>
</div>
@endsection
