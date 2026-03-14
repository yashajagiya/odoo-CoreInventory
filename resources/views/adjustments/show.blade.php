@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('adjustments.index') }}" class="btn btn-sm btn-outline-secondary mb-3">&larr; Back to List</a>
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Adjustment {{ $adjustment->reference_no }}</h2>
        <span class="badge badge-{{ strtolower($adjustment->status) }} mt-2">{{ $adjustment->status }}</span>
    </div>
    @if($adjustment->status !== 'Done')
    <div>
        <form action="{{ route('adjustments.validate', $adjustment) }}" method="POST" onsubmit="return confirm('Validate this adjustment? This will permanently write to the stock ledger.');">
            @csrf
            <button type="submit" class="btn btn-primary fw-bold">Validate Adjustment</button>
        </form>
    </div>
    @endif
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="fw-bold border-bottom pb-2 mb-3">General Details</h6>
                <table class="table table-sm table-borderless mb-0">
                    <tr><td class="text-muted fw-bold" width="40%">Location</td><td>{{ $adjustment->location->name ?? 'N/A' }}</td></tr>
                    <tr><td class="text-muted fw-bold">Product Name</td><td>{{ $adjustment->product->name ?? 'N/A' }}</td></tr>
                    <tr><td class="text-muted fw-bold">Product SKU</td><td>{{ $adjustment->product->sku ?? 'N/A' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100 bg-light">
            <div class="card-body">
                <h6 class="fw-bold border-bottom pb-2 mb-3">Stock Discrepancy</h6>
                <div class="row text-center mt-4">
                    <div class="col-4 border-end">
                        <div class="text-muted small fw-bold text-uppercase mb-1">Recorded</div>
                        <h4 class="fw-bold">{{ $adjustment->recorded_quantity }}</h4>
                    </div>
                    <div class="col-4 border-end">
                        <div class="text-muted small fw-bold text-uppercase mb-1">Physical</div>
                        <h4 class="fw-bold">{{ $adjustment->physical_quantity }}</h4>
                    </div>
                    <div class="col-4">
                        <div class="text-muted small fw-bold text-uppercase mb-1">Difference</div>
                        <h4 class="fw-bold {{ $adjustment->difference_quantity < 0 ? 'text-danger' : ($adjustment->difference_quantity > 0 ? 'text-success' : 'text-muted') }}">
                            {{ $adjustment->difference_quantity > 0 ? '+' : '' }}{{ $adjustment->difference_quantity }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
