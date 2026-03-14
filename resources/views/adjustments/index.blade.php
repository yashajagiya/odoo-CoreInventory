@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0 text-gray-800 fw-bold">Inventory Adjustments</h2>
    <a href="{{ route('adjustments.create') }}" class="btn btn-primary fw-bold">New Adjustment</a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('adjustments.index') }}" class="row g-3">
            <div class="col-md-7">
                <label class="form-label text-muted small fw-bold">Search (SKU)</label>
                <input type="text" name="sku" class="form-control" placeholder="Product SKU..." value="{{ request('sku') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small fw-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                    <option value="Done" {{ request('status') == 'Done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <table class="table table-hover mb-0 align-middle">
        <thead class="table-light">
            <tr>
                <th class="ps-4">Reference</th>
                <th>Location</th>
                <th>Product</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adjustments as $adjustment)
            <tr>
                <td class="ps-4 fw-bold">{{ $adjustment->reference_no }}</td>
                <td>{{ $adjustment->location->name ?? 'N/A' }}</td>
                <td>{{ $adjustment->product->name ?? 'N/A' }}</td>
                <td><span class="badge badge-{{ strtolower($adjustment->status) }}">{{ $adjustment->status }}</span></td>
                <td><a href="{{ route('adjustments.show', $adjustment->id) }}" class="btn btn-sm btn-outline-primary">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
