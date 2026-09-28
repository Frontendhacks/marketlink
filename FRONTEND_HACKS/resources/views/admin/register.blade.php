<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketLink - Admin Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{margin:0;background:#f5f7f9;font-family:Arial,sans-serif;color:#333;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:30px}
        .register-box{width:100%;max-width:620px;background:#fff;border:1px solid #e5e5e5;border-radius:14px;padding:35px;box-shadow:0 10px 35px rgba(0,0,0,.06)}
        .logo{text-align:center;margin-bottom:25px}.logo h1{font-size:30px;margin:0;color:#333}.logo span{color:#4caf50}.logo p{color:#888;margin:6px 0 0}
        h2{text-align:center;margin-bottom:8px}.subtitle{text-align:center;color:#777;margin-bottom:25px}
        label{font-weight:600;font-size:14px;margin-bottom:7px}.form-control{padding:11px 12px}.btn-admin{width:100%;background:#4caf50;color:#fff;border:0;padding:12px;border-radius:7px;font-weight:600}.btn-admin:hover{background:#43a047;color:#fff}
        .login-link{text-align:center;margin-top:18px}.login-link a{color:#388e3c;text-decoration:none;font-weight:600}
        .alert{font-size:14px}
    </style>
</head>
<body>
<div class="register-box">
    <div class="logo"><h1>Market<span>Link</span></h1><p>Admin Registration</p></div>
    <h2>Create Admin Account</h2>
    <p class="subtitle">Register your administrator account to manage the MarketLink system.</p>

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form method="POST" action="{{ route('admin.register.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="name">Full Name</label>
                <input class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-6">
                <label for="contact">Contact</label>
                <input class="form-control" id="contact" name="contact" value="{{ old('contact') }}" required>
            </div>
            <div class="col-12">
                <label for="email">Admin Email</label>
                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="col-12">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="2" required>{{ old('address') }}</textarea>
            </div>
            <div class="col-md-6">
                <label for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" required>
            </div>
            <div class="col-md-6">
                <label for="password_confirmation">Confirm Password</label>
                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="col-12 mt-4"><button class="btn btn-admin" type="submit">Create Admin Account</button></div>
        </div>
    </form>

    <div class="login-link">Already have an admin account? <a href="{{ route('admin.login') }}">Login here</a></div>
    <div class="login-link"><a href="{{ route('userlogin') }}">← Choose another account</a></div>
</div>
</body>
</html>
