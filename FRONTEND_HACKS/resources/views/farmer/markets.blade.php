@extends('farmer.master')
@section('title', 'Markets')
@section('main')
<div class="mb-4">
    <h1 class="fw-bold mb-1">Markets</h1>
    <p class="text-muted">Active markets and where your products are listed.</p>
</div>
<div class="row g-3">
    @forelse($markets as $market)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 {{ $market->market_id === $myMarketId ? 'border border-success' : '' }}">
                <div class="card-body">
                    <h5 class="fw-bold">{{ $market->market_name }} @if($market->market_id === $myMarketId)<span class="badge bg-success ms-1">Your market</span>@endif</h5>
                    <p class="mb-1"><i class="bi bi-geo-alt text-success"></i> {{ $market->address }}</p>
                    <p class="mb-1"><i class="bi bi-calendar-event text-success"></i> {{ $market->day }} · {{ $market->timing }}</p>
                    <span class="badge bg-light text-dark border mt-2">{{ $market->my_products_count }} of your products</span>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info">No active markets yet.</div></div>
    @endforelse
</div>
@endsection
