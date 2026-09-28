@extends('customer.master')
@section('main')
<div class="container py-5">
    <div class="hero p-4 p-md-5 mb-4">
        <h1 class="fw-bold">Product Reviews</h1>
        <p class="mb-0">Share your experience and help other customers.</p>
    </div>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <div class="card review-card shadow-sm mb-4">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-3">Write a Review</h4>
            @if($orderedProducts->isEmpty())
                <p class="text-muted mb-0">Once one of your orders is confirmed or completed you can review the product here.</p>
            @else
                <form method="POST" action="{{ route('reviews.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Product</label>
                        <select class="form-select" name="product_id" required>
                            <option value="">Select a product</option>
                            @foreach($orderedProducts as $product)
                                <option value="{{ $product->product_id }}" @selected(old('product_id') == $product->product_id)>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select class="form-select" name="rating" required>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" @selected(old('rating', 5) == $i)>{{ str_repeat('★', $i) }}{{ str_repeat('☆', 5 - $i) }} ({{ $i }})</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Your Review</label>
                        <textarea class="form-control" name="comment" rows="5" maxlength="1000" placeholder="Write your experience..." required>{{ old('comment') }}</textarea>
                    </div>
                    <button class="btn btn-main px-4" type="submit">Submit Review</button>
                </form>
            @endif
        </div>
    </div>

    <div class="card review-card shadow-sm">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4">My Reviews</h4>
            @forelse($reviews as $review)
                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $review->product->name ?? 'Product' }}</strong>
                        <span class="text-warning">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                    </div>
                    <p class="mb-1">{{ $review->comment }}</p>
                    <small class="text-muted">{{ optional($review->review_date)->format('d M Y') }}</small>
                    @if($review->farmer_reply)
                        <div class="bg-light rounded p-2 mt-2"><small><b>Farmer reply:</b> {{ $review->farmer_reply }}</small></div>
                    @endif
                </div>
            @empty
                <div class="text-center text-muted">You have not written any reviews yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
