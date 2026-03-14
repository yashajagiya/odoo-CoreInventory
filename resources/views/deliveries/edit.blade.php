@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('deliveries.show', $delivery) }}" class="btn btn-sm btn-outline-secondary mb-3">&larr; Back to Delivery</a>
        <h2 class="h4 mb-0 text-gray-800 fw-bold">Edit Delivery {{ $delivery->reference_no }}</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('deliveries.update', $delivery) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h6 class="fw-bold mb-3 border-bottom pb-2">General Details</h6>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name', $delivery->customer_name) }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">Scheduled Date</label>
                        <input type="date" name="scheduled_date" class="form-control" value="{{ old('scheduled_date', $delivery->scheduled_date ? \Carbon\Carbon::parse($delivery->scheduled_date)->format('Y-m-d') : '') }}">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
