@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0 text-gray-800 fw-bold">Delivery Orders</h2>
    <a href="{{ route('deliveries.create') }}" class="btn btn-primary fw-bold">Create Delivery</a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body bg-white rounded">
        <form method="GET" action="{{ route('deliveries.index') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label text-muted small fw-bold">Search (SKU)</label>
                <input type="text" name="sku" class="form-control" placeholder="Product SKU..." value="{{ request('sku') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small fw-bold">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" placeholder="Search customer..." value="{{ request('customer_name') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                    <option value="Waiting" {{ request('status') == 'Waiting' ? 'selected' : '' }}>Waiting</option>
                    <option value="Ready" {{ request('status') == 'Ready' ? 'selected' : '' }}>Ready</option>
                    <option value="Done" {{ request('status') == 'Done' ? 'selected' : '' }}>Done</option>
                    <option value="Canceled" {{ request('status') == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <table class="table table-hover mb-0 align-middle">
        <thead class="table-light">
                <th class="ps-4">Reference</th>
                <th>Customer</th>
                <th>Scheduled Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deliveries as $delivery)
            <tr>
                <td class="ps-4 fw-bold">{{ $delivery->reference_no }}</td>
                <td>{{ $delivery->customer_name ?? 'N/A' }}</td>
                <td>{{ $delivery->scheduled_date ? \Carbon\Carbon::parse($delivery->scheduled_date)->format('Y-m-d') : 'N/A' }}</td>
                <td><span class="badge badge-{{ strtolower($delivery->status) }}">{{ $delivery->status }}</span></td>
                <td><a href="{{ route('deliveries.show', $delivery->id) }}" class="btn btn-sm btn-outline-primary">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
