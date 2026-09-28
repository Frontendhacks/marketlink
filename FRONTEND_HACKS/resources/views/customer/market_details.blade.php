@extends('customer.master')

<style>
body {
    background: #f7f5ef;
    color: #1f2937;
}

.market-box {
    background: white;
    border-radius: 15px;
}

.hero {
    background: #1f4d2e;
    color: white;
    border-radius: 15px;
}

.info-card {
    border: 0;
    border-radius: 12px;
}

.btn-main {
    background: #2f6b3f;
    color: white;
}

.btn-main:hover {
    background: #1f4d2e;
    color: white;
}
</style>

@section('main')

<div class="container py-5">

    <a class="text-decoration-none" href="{{ route('markets') }}">
        ← Back to Markets
    </a>

    <div class="hero p-4 p-md-5 mt-3 mb-4">

        <span class="badge bg-light text-dark mb-2">
            Active Market
        </span>

        <h1 class="fw-bold">
            {{ $market->market_name }}
        </h1>

        <p class="mb-0">
            Fresh local products from farmers at {{ $market->market_name }}.
        </p>

    </div>

    <div class="row g-4">

        <div class="col-md-6">

            <div class="card info-card shadow-sm h-100">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-3">
                        Market Information
                    </h4>

                    <p>
                        <b>Location:</b>
                        {{ $market->address }}
                    </p>

                    <p>
                        <b>Days:</b>
                        {{ $market->day }}
                    </p>

                    <p>
                        <b>Opening Time:</b>
                        {{ $market->timing }}
                    </p>

                    <p>
                        <b>Pickup:</b>
                        Available
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card info-card shadow-sm h-100">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-3">
                        Available Farmers
                    </h4>

                    <p class="text-muted">
                        Explore farmers and their products available at this market.
                    </p>

                    <a class="btn btn-main" href="{{ route('farmers') }}">
                        View Farmers
                    </a>

                </div>

            </div>

        </div>

    </div>

    <div class="card info-card shadow-sm mt-4">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-3">
                Available Products
            </h4>

            <p class="text-muted">
                Browse products available from local farmers at this market.
            </p>

            <a class="btn btn-main" href="{{ route('products') }}">
                Browse Products
            </a>

        </div>

    </div>

</div>

@endsection