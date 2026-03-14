@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2 class="h4 mb-0 text-gray-800 fw-bold">Warehouse & Location Settings</h2>
    <p class="text-muted small">Manage organizational facilities and operational designated zones.</p>
</div>

@if(session('success'))
    <div class="alert alert-success fw-bold">{{ session('success') }}</div>
@endif

<div class="row">
    <!-- WAREHOUSES COLUMN -->
    <div class="col-md-5">
        <div class="card border-0 shadow-sm mb-4 bg-light">
            <div class="card-body">
                <h6 class="fw-bold mb-3 border-bottom pb-2">➕ Add New Warehouse</h6>
                <form action="{{ route('settings.warehouse.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Warehouse Name</label>
                        <input type="text" name="name" class="form-control form-control-sm" required placeholder="e.g. North Hub">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Code / Abbr.</label>
                        <input type="text" name="code" class="form-control form-control-sm" required placeholder="e.g. NHTB">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Address (Optional)</label>
                        <textarea name="location_address" class="form-control form-control-sm" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-dark w-100 fw-bold">Save Warehouse</button>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0 text-sm">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-3">Code</th>
                            <th>Warehouse Name</th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warehouses as $wh)
                            <tr>
                                <td class="ps-3 fw-bold text-muted">{{ $wh->code }}</td>
                                <td class="fw-bold">{{ $wh->name }}</td>
                                <td class="text-end pe-3">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('settings.warehouse.edit', $wh) }}" class="btn btn-sm btn-outline-primary" style="padding: 0.1rem 0.4rem; font-size: 0.75rem;">Edit</a>
                                        <form action="{{ route('settings.warehouse.destroy', $wh) }}" method="POST" onsubmit="return confirm('Delete this warehouse permanently?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" style="padding: 0.1rem 0.4rem; font-size: 0.75rem;">Del</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center py-3">No Warehouses configured.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- LOCATIONS COLUMN -->
    <div class="col-md-7">
        <div class="card border-0 shadow-sm mb-4 bg-light">
            <div class="card-body">
                <h6 class="fw-bold mb-3 border-bottom pb-2">➕ Add Sub-Location</h6>
                <form action="{{ route('settings.location.store') }}" method="POST" class="row g-2">
                    @csrf
                    <div class="col-md-4">
                        <label class="form-label text-muted small fw-bold">Parent Warehouse</label>
                        <select name="warehouse_id" class="form-select form-select-sm" required>
                            <option value="">Select...</option>
                            @foreach($warehouses as $wh)
                                <option value="{{ $wh->id }}">{{ $wh->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small fw-bold">Location Name</label>
                        <input type="text" name="name" class="form-control form-control-sm" required placeholder="e.g. Aisle 5">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small fw-bold">Type</label>
                        <select name="type" class="form-select form-select-sm" required>
                            <option value="internal">Internal (Storage)</option>
                            <option value="vendor">Vendor (Supplier)</option>
                            <option value="customer">Customer (Delivery)</option>
                            <option value="inventory_loss">Inventory Loss (Shrinkage)</option>
                        </select>
                    </div>
                    <div class="col-12 mt-3 text-end">
                        <button type="submit" class="btn btn-sm btn-primary px-4 fw-bold">Save Location</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0 text-sm">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Warehouse Parent</th>
                            <th>Location Name</th>
                            <th>Type Focus</th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($warehouses as $wh)
                            @foreach($wh->locations as $loc)
                            <tr>
                                <td class="ps-3"><span class="badge bg-secondary">{{ $wh->code }}</span></td>
                                <td class="fw-bold">{{ $loc->name }}</td>
                                <td><span class="badge border bg-white text-dark">{{ ucfirst($loc->type) }}</span></td>
                                <td class="text-end pe-3">
                                    <form action="{{ route('settings.location.destroy', $loc) }}" method="POST" onsubmit="return confirm('Delete this location permanently?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="padding: 0.1rem 0.4rem; font-size: 0.75rem;">Del</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
