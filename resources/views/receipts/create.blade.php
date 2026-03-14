@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('receipts.index') }}" class="btn btn-sm btn-outline-secondary mb-3">&larr; Back to Receipts</a>
    <h2 class="h4 mb-0 text-gray-800 fw-bold">Register New Receipt</h2>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('receipts.store') }}" method="POST">
            @csrf
            
            <h6 class="fw-bold mb-3 border-bottom pb-2">Receipt Details</h6>
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Vendor Name</label>
                    <input type="text" name="vendor_name" class="form-control" placeholder="e.g. Global Supplies">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Expected Date</label>
                    <input type="date" name="expected_date" class="form-control">
                </div>
            </div>

            <h6 class="fw-bold mb-3 border-bottom pb-2">Products Received</h6>
            <div id="receipt-items">
                <div class="row g-3 mb-3 receipt-item">
                    <div class="col-md-8">
                        <label class="form-label text-muted small fw-bold">Product</label>
                        <select name="items[0][product_id]" class="form-select" required>
                            <option value="">Select Product...</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} (SKU: {{ $product->sku }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-muted small fw-bold">Quantity Received</label>
                        <input type="number" name="items[0][quantity]" class="form-control" required min="1">
                    </div>
                </div>
            </div>
            
            <button type="button" class="btn btn-sm btn-outline-primary mb-4" onclick="addReceiptItem()">
                + Add Another Product
            </button>

            <hr class="my-4 text-muted">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4 fw-bold">Save Receipt</button>
            </div>
        </form>
    </div>
</div>

<script>
    let itemIndex = 1;
    function addReceiptItem() {
        const container = document.getElementById('receipt-items');
        const firstItem = container.querySelector('.receipt-item');
        const newItem = firstItem.cloneNode(true);
        
        newItem.querySelector('select').name = `items[${itemIndex}][product_id]`;
        newItem.querySelector('select').value = '';
        newItem.querySelector('input').name = `items[${itemIndex}][quantity]`;
        newItem.querySelector('input').value = '';
        
        container.appendChild(newItem);
        itemIndex++;
    }
</script>
@endsection
