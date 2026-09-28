@extends('farmer.master')
@section('title', 'Customer Reviews')
@section('main')
<div class="mb-4">
    <h1 class="fw-bold mb-1">Customer Reviews</h1>
    <p class="text-muted">What customers say about your products.</p>
</div>

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="card border-0 shadow-sm"><div class="card-body"><small class="text-muted">Total Reviews</small><h2 class="fw-bold">{{ $reviews->total() }}</h2></div></div></div>
    <div class="col-md-4"><div class="card border-0 shadow-sm"><div class="card-body"><small class="text-muted">Average Rating (this page)</small><h2 class="fw-bold">{{ $reviews->count() ? number_format($reviews->avg('rating'), 1) : '—' }}</h2></div></div></div>
</div>

@forelse($reviews as $review)
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <div>
                    <h5 class="mb-0">{{ $review->product->name ?? 'Product' }}</h5>
                    <small class="text-muted">by {{ $review->customer->name ?? 'Customer' }} · {{ optional($review->review_date)->format('d M Y') }}</small>
                </div>
                <div class="text-warning fs-5">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</div>
            </div>
            <p class="mt-2 mb-3">{{ $review->comment }}</p>

            <form method="POST" action="{{ route('farmer.reviews.reply', $review->review_id) }}" class="d-flex gap-2">
                @csrf @method('PUT')
                <input type="text" name="farmer_reply" class="form-control" maxlength="1000" placeholder="Write a reply..." value="{{ $review->farmer_reply }}" required>
                <button class="btn btn-success">{{ $review->farmer_reply ? 'Update' : 'Reply' }}</button>
            </form>
        </div>
    </div>
@empty
    <div class="card border-0 shadow-sm"><div class="card-body text-center text-muted py-5">No reviews yet.</div></div>
@endforelse

{{ $reviews->links('pagination::bootstrap-5') }}
@endsection
