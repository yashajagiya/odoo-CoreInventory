<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - CoreInventory IMS</title>
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
                        <p class="text-center text-muted mb-4 small">Enter the 6-digit OTP sent to your email to reset your password.</p>
                        
                        @if (session('status'))
                            <div class="alert alert-success small">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger small">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('otp.verify') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control form-control-lg" value="{{ session('otp_email') }}" readonly required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">6-Digit OTP</label>
                                <input type="text" name="otp" class="form-control form-control-lg text-center tracking-wide font-monospace" maxlength="6" placeholder="------" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">New Password</label>
                                <input type="password" name="password" class="form-control form-control-lg" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-lg" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">Reset Password</button>
                        </form>
                        
                        <div class="mt-4 text-center">
                            <span class="text-muted small">Didn't receive an OTP? <a href="{{ route('otp.request.form') }}" class="text-decoration-none">Request Again</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
