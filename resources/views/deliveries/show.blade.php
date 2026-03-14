@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('deliveries.index') }}" class="btn btn-sm btn-outline-secondary mb-2">&larr; Back</a>
        <h2 class="h4 mb-0 text-gray-800 fw-bold">{{ $delivery->reference }}</h2>
    </div>
    @if($delivery->status !== 'Done' && $delivery->status !== 'Canceled')
        <form action="{{ route('deliveries.validate', $delivery->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success fw-bold px-4">Validate Delivery</button>
        </form>
    @endif
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="row mb-4">
            <div class="col-md-6"><strong>Customer:</strong> {{ $delivery->partner_name }}</div>
            <div class="col-md-6 text-end">
                <strong>Status:</strong> 
                <span class="badge badge-{{ strtolower($delivery->status) }}">{{ $delivery->status }}</span>
            </div>
        </div>
        <table class="table table-bordered">
            <thead class="table-light"><tr><th>Product</th><th>Demand</th><th>Reserved</th><th>Done</th></tr></thead>
            <tbody>
                @foreach($delivery->lines as $line)
                <tr>
                    <td>{{ $line->product->name }}</td>
                    <td>{{ $line->demand_qty }}</td>
                    <td>{{ $line->reserved_qty }}</td>
                    <td>{{ $line->done_qty }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
