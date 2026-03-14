@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2 class="h4 mb-0 text-gray-800 fw-bold">Move History (Ledger)</h2>
    <p class="text-muted small">Tracking all stock movements across locations.</p>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body bg-white rounded">
        <form method="GET" action="{{ route('ledger.index') }}" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by Product or Location..." value="{{ request('search') }}">
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
                    <th class="ps-4">Date</th>
                    <th>Product</th>
                    <th>Location</th>
                    <th>Quantity Change</th>
                    <th>Reference Type</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ledgers as $ledger)
                <tr>
                    <td class="ps-4 text-muted small">{{ $ledger->created_at }}</td>
                    <td class="fw-bold">{{ $ledger->product->name }}</td>
                    <td><span class="badge bg-secondary">{{ $ledger->location->name }}</span></td>
                    <td>
                        @if($ledger->quantity_change > 0)
                            <span class="text-success fw-bold">+{{ $ledger->quantity_change }}</span>
                        @elseif($ledger->quantity_change < 0)
                            <span class="text-danger fw-bold">{{ $ledger->quantity_change }}</span>
                        @else
                            <span class="text-muted">{{ $ledger->quantity_change }}</span>
                        @endif
                    </td>
                    <td><span class="badge bg-light text-dark border">{{ class_basename($ledger->reference_type) }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No move history found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
