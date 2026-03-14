<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoreInventory IMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fc; }
        .sidebar { min-height: 100vh; background-color: #2c3e50; color: #ecf0f1; padding-top: 20px; }
        .sidebar a { color: #bdc3c7; text-decoration: none; display: block; padding: 12px 20px; transition: 0.3s; font-size: 0.95rem; }
        .sidebar a:hover, .sidebar a.active { background-color: #34495e; color: #ffffff; border-left: 4px solid #3498db; }
        .main-content { padding: 30px; }
        .card { box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15); border: none; border-radius: 0.5rem; }
        .badge-draft { background-color: #6c757d; color: white; } 
        .badge-waiting { background-color: #ffc107; color: #212529; } 
        .badge-ready { background-color: #0d6efd; color: white; } 
        .badge-done { background-color: #198754; color: white; } 
        .badge-canceled { background-color: #dc3545; color: white; } 
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Left Sidebar -->
        <nav class="sidebar flex-shrink-0" style="width: 250px;">
            <h5 class="text-center mb-4 text-white fw-bold px-3">CoreInventory</h5>
            <div class="d-flex flex-column">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('products.index') }}">Products</a>
                <a href="{{ route('receipts.index') }}">Receipts</a>
                <a href="{{ route('deliveries.index') }}">Delivery Orders</a>
                <a href="{{ route('transfers.index') }}">Internal Transfers</a>
                <a href="{{ route('adjustments.index') }}">Inventory Adjustment</a>
                <a href="{{ route('ledger.index') }}">Move History</a>
                @if(auth()->check() && in_array(strtolower(auth()->user()->role), ['manager', 'admin']))
                    <a href="{{ route('settings.index') }}">Warehouse Settings</a>
                @endif
                <a href="{{ route('profile.index') }}">My Profile</a>
                <hr class="text-secondary mx-3">
                <form action="{{ route('logout') }}" method="POST" class="d-inline m-0 p-0">
                    @csrf
                    <button type="submit" class="btn btn-link shadow-none" style="color:#bdc3c7; text-decoration:none; padding:12px 20px; width:100%; text-align:left; font-size:0.95rem;">Logout</button>
                </form>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main class="main-content flex-grow-1">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.sidebar a').forEach(link => {
                const linkPath = new URL(link.getAttribute('href'), window.location.origin).pathname;
                if (linkPath === '/' && (currentPath === '/' || currentPath === '/dashboard')) {
                    link.classList.add('active');
                } else if (linkPath !== '/' && currentPath.startsWith(linkPath)) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
