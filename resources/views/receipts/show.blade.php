@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('receipts.index') }}" class="btn btn-sm btn-outline-secondary mb-2">&larr; Back</a>
        <h2 class="h4 mb-0 text-gray-800 fw-bold">{{ $receipt->reference }}</h2>
    </div>
    @if($receipt->status !== 'Done' && $receipt->status !== 'Canceled')
        <form action="{{ route('receipts.validate', $receipt->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success fw-bold px-4">Validate Receipt</button>
        </form>
    @endif
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="row mb-4">
            <div class="col-md-6"><strong>Partner:</strong> {{ $receipt->partner_name }}</div>
            <div class="col-md-6 text-end">
                <strong>Status:</strong> 
                <span class="badge badge-{{ strtolower($receipt->status) }}">{{ $receipt->status }}</span>
            </div>
        </div>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr><th>Product</th><th>Demand</th><th>Done</th></tr>
            </thead>
            <tbody>
                @foreach($receipt->lines as $line)
                <tr>
                    <td>{{ $line->product->name }}</td>
                    <td>{{ $line->demand_qty }}</td>
                    <td>{{ $line->done_qty }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
