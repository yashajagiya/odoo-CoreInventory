@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('receipts.index') }}" class="btn btn-sm btn-outline-secondary mb-3">&larr; Back to List</a>
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Receipt {{ $receipt->reference_no }}</h2>
        <span class="badge badge-{{ strtolower($receipt->status) }} mt-2">{{ $receipt->status }}</span>
    </div>
    @if($receipt->status !== 'Done')
    <div class="d-flex gap-2">
        @if(auth()->check() && in_array(strtolower(auth()->user()->role), ['manager', 'admin']))
        <a href="{{ route('receipts.edit', $receipt) }}" class="btn btn-outline-primary fw-bold">Edit</a>
        <form action="{{ route('receipts.destroy', $receipt) }}" method="POST" onsubmit="return confirm('Delete this receipt permanently?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger fw-bold">Delete</button>
        </form>
        @endif
        <form action="{{ route('receipts.validate', $receipt) }}" method="POST" onsubmit="return confirm('Validate receipt and update stock?');">
            @csrf
            <button type="submit" class="btn btn-success fw-bold">Validate Receipt</button>
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
                    <tr><td class="text-muted fw-bold" width="40%">Vendor Name</td><td>{{ $receipt->vendor_name ?? 'N/A' }}</td></tr>
                    <tr><td class="text-muted fw-bold">Expected Date</td><td>{{ $receipt->expected_date ? \Carbon\Carbon::parse($receipt->expected_date)->format('Y-m-d') : 'N/A' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Product Name</th>
                    <th>SKU</th>
                    <th class="text-end pe-4">Quantity Received</th>
                </tr>
            </thead>
            <tbody>
                @foreach($receipt->receiptItems as $item)
                <tr>
                    <td class="ps-4 fw-bold">{{ $item->product->name }}</td>
                    <td class="text-muted">{{ $item->product->sku }}</td>
                    <td class="text-end pe-4 fw-bold text-success">+{{ $item->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
