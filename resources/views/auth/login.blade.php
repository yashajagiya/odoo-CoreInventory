<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CoreInventory IMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body { background-color: #f8f9fc; }</style>
</head>
<body class="d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm border-0 root-card">
                    <div class="card-body p-5">
                        <h4 class="text-center mb-4 fw-bold text-primary">CoreInventory IMS</h4>
                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control form-control-lg" required autofocus>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Password</label>
                                <input type="password" name="password" class="form-control form-control-lg" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
