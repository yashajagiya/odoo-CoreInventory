@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0 text-gray-800 fw-bold">Dashboard Overview</h2>
    <form method="GET" action="{{ route('dashboard') }}" class="d-flex gap-2">
        <select name="location_id" class="form-select" onchange="this.form.submit()">
            <option value="">All Locations</option>
            @foreach($locations as $loc)
                <option value="{{ $loc->id }}" {{ isset($locationId) && $locationId == $loc->id ? 'selected' : '' }}>
                    {{ $loc->name }}
                </option>
            @endforeach
        </select>
    </form>
</div>

<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 border-start border-primary border-4 shadow-sm h-100 py-2">
            <div class="card-body">
                <div class="text-xs fw-bold text-primary text-uppercase mb-1 small">Total Products</div>
                <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalProducts }}</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 border-start border-danger border-4 shadow-sm h-100 py-2">
            <div class="card-body">
                <div class="text-xs fw-bold text-danger text-uppercase mb-1 small">Low Stock Alerts</div>
                <div class="h5 mb-0 fw-bold text-gray-800">{{ $lowStockCount }}</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 border-start border-info border-4 shadow-sm h-100 py-2">
            <div class="card-body">
                <div class="text-xs fw-bold text-info text-uppercase mb-1 small">Pending Receipts</div>
                <div class="h5 mb-0 fw-bold text-gray-800">{{ $pendingReceipts }}</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 border-start border-warning border-4 shadow-sm h-100 py-2">
            <div class="card-body">
                <div class="text-xs fw-bold text-warning text-uppercase mb-1 small">Pending Deliveries</div>
                <div class="h5 mb-0 fw-bold text-gray-800">{{ $pendingDeliveries }}</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 border-start border-success border-4 shadow-sm h-100 py-2">
            <div class="card-body">
                <div class="text-xs fw-bold text-success text-uppercase mb-1 small">Scheduled Transfers</div>
                <div class="h5 mb-0 fw-bold text-gray-800">{{ $scheduledTransfers }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
