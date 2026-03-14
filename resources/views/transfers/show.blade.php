@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('transfers.index') }}" class="btn btn-sm btn-outline-secondary mb-2">&larr; Back</a>
        <h2 class="h4 mb-0 text-gray-800 fw-bold">{{ $transfer->reference }}</h2>
    </div>
    @if($transfer->status !== 'Done')
        <form action="{{ route('transfers.validate', $transfer->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success fw-bold px-4">Validate Transfer</button>
        </form>
    @endif
</div>

<div class="card border-0 shadow-sm p-4">
    <div class="row mb-4">
        <div class="col-md-4"><strong>Source:</strong> {{ $transfer->source_location->name ?? 'N/A' }}</div>
        <div class="col-md-4"><strong>Destination:</strong> {{ $transfer->destination_location->name ?? 'N/A' }}</div>
        <div class="col-md-4 text-end">
            <strong>Status:</strong> <span class="badge badge-{{ strtolower($transfer->status) }}">{{ $transfer->status }}</span>
        </div>
    </div>
    <table class="table table-bordered table-sm">
        <thead class="table-light"><tr><th>Product</th><th>Qty</th></tr></thead>
        <tbody>
            @foreach($transfer->lines as $line)
            <tr><td>{{ $line->product->name }}</td><td>{{ $line->qty }}</td></tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
