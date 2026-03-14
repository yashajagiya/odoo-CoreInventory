@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0 text-gray-800 fw-bold">Internal Transfers</h2>
    <a href="{{ route('transfers.create') }}" class="btn btn-primary fw-bold">New Transfer</a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('transfers.index') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label text-muted small fw-bold">Search SKU / Ref</label>
                <input type="text" name="sku" class="form-control" value="{{ request('sku') }}">
            </div>
            <div class="col-md-3"><label class="form-label text-muted small fw-bold">Document Type</label><select name="document_type" class="form-select"><option value="">All</option></select></div>
            <div class="col-md-3"><label class="form-label text-muted small fw-bold">Category</label><select name="category" class="form-select"><option value="">All</option></select></div>
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                    <option value="Ready" {{ request('status') == 'Ready' ? 'selected' : '' }}>Ready</option>
                    <option value="Done" {{ request('status') == 'Done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>
            <div class="col-md-1 d-flex align-items-end"><button type="submit" class="btn btn-secondary w-100">Filter</button></div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <table class="table table-hover mb-0 align-middle">
        <thead class="table-light">
            <tr>
                <th class="ps-4">Reference</th>
                <th>Source Location</th>
                <th>Destination Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transfers as $transfer)
            <tr>
                <td class="ps-4 fw-bold">{{ $transfer->reference }}</td>
                <td>{{ $transfer->source_location->name ?? 'N/A' }}</td>
                <td>{{ $transfer->destination_location->name ?? 'N/A' }}</td>
                <td><span class="badge badge-{{ strtolower($transfer->status) }}">{{ $transfer->status }}</span></td>
                <td><a href="{{ route('transfers.show', $transfer->id) }}" class="btn btn-sm btn-outline-primary">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
