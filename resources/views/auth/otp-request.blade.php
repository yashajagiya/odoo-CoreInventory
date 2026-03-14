<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - CoreInventory IMS</title>
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
                        <p class="text-center text-muted mb-4 small">Enter your email address to receive a One-Time Password (OTP) for password reset.</p>
                        
                        @if (session('status'))
                            <div class="alert alert-success small">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger small">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('otp.request') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control form-control-lg" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">Send OTP</button>
                        </form>
                        
                        <div class="mt-4 text-center">
                            <span class="text-muted small">Remembered your password? <a href="{{ route('login') }}" class="text-decoration-none">Sign In</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
