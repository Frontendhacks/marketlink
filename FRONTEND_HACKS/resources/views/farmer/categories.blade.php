@extends('farmer.master')
@section('title', 'Categories')
@section('main')
<div class="mb-4">
    <h1 class="fw-bold mb-1">Categories</h1>
    <p class="text-muted">Product categories and how many of your products are in each.</p>
</div>
<div class="row g-3">
    @forelse($categories as $category)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold">{{ $category->name }}</h5>
                    <p class="text-muted small">{{ $category->description ?: 'No description.' }}</p>
                    <span class="badge bg-success">{{ $category->my_products_count }} of your products</span>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info">No categories are available yet.</div></div>
    @endforelse
</div>
@endsection
