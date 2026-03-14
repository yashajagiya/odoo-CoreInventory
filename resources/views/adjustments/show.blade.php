@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('adjustments.index') }}" class="btn btn-sm btn-outline-secondary mb-2">&larr; Back</a>
        <h2 class="h4 mb-0 text-gray-800 fw-bold">{{ $adjustment->reference }}</h2>
    </div>
    @if($adjustment->status !== 'Done')
        <form action="{{ route('adjustments.validate', $adjustment->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success fw-bold px-4">Validate Adjustment</button>
        </form>
    @endif
</div>

<div class="card border-0 shadow-sm p-4">
    <div class="row mb-4">
        <div class="col-md-6"><strong>Location:</strong> {{ $adjustment->location->name ?? 'N/A' }}</div>
        <div class="col-md-6 text-end">
            <strong>Status:</strong> <span class="badge badge-{{ strtolower($adjustment->status) }}">{{ $adjustment->status }}</span>
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="table-light"><tr><th>Product</th><th>Counted Quantity</th><th>Difference</th></tr></thead>
        <tbody>
            @foreach($adjustment->lines as $line)
            <tr>
                <td>{{ $line->product->name }}</td>
                <td>{{ $line->counted_qty }}</td>
                <td class="{{ $line->difference < 0 ? 'text-danger' : 'text-success' }} fw-bold">{{ $line->difference }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
