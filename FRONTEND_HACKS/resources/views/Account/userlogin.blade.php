<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketLink - Choose Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="role.css">
</head>

<body>
    <main class="page">
        <div class="container">
            <div class="brand"><img src="customer/Images/logo.png" alt="MarketLink logo"
                    onerror="this.style.display='none'"><span>MarketLink</span></div>
            <div class="hero">
                <p class="tag">WELCOME TO MARKETLINK</p>
                <h1>Choose your account</h1>
                <p class="sub">Select how you want to use MarketLink.</p>
            </div>
            <div class="row g-4 justify-content-center">

    <div class="col-md-4">
        <div class="role-card">
            <div class="icon">🛒</div>
            <h2>Customer</h2>
            <p>Browse products, markets and place pre-orders.</p>

            @auth
    @if(auth()->user()->role === 'customer')
        <a href="{{ route('customer.dashboard') }}">
            <span>Go to Customer Dashboard →</span>
        </a>
    @else
        <a href="{{ route('register.form', ['type' => 'customer']) }}">
            <span>Select Customer →</span>
        </a>
    @endif
@else
    <a href="{{ route('register.form', ['type' => 'customer']) }}">
        <span>Select Customer →</span>
    </a>
@endauth
        </div>
    </div>

    <div class="col-md-4">
        <div class="role-card">
            <div class="icon">🌾</div>
            <h2>FarmHub</h2>
            <p>Manage your farm products, stock and orders.</p>

            <a href="{{ route('register.form', ['type' => 'farmhub']) }}">
                <span>Select FarmHub →</span>
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="role-card">
            <div class="icon">⚙️</div>
            <h2>Admin</h2>
            <p>Manage customers, farmers, markets and products.</p>

            <a href="{{ route('admin.register') }}">
                <span>Select Admin →</span>
            </a>
        </div>
    </div>

</div>

        </div>
    </main>
</body>

</html>