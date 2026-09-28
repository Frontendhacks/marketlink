@extends('customer.master')
@section('main')
<link rel="stylesheet" href="{{ asset('customers/assets/css/products.css') }}">

<section class="products-hero">
<div class="container">
<div class="hero-content">
<div class="hero-text">
<span class="hero-badge">
<i class="fa-solid fa-leaf"></i>
                    Fresh From Local Farmers
                </span>
<h1>
                    Fresh Products,
                    <span>Directly From Farmers</span>
</h1>
<p>
                    Explore fresh fruits, vegetables and farm products
                    available from trusted local farmers on MarketLink.
                </p>
<div class="hero-stats">
<div class="hero-stat">
<strong>12+</strong>
<small>Products</small>
</div>
<div class="hero-stat">
<strong>100%</strong>
<small>Fresh</small>
</div>
<div class="hero-stat">
<strong>Local</strong>
<small>Farmers</small>
</div>
</div>
</div>
<div class="hero-icon">
<i class="fa-solid fa-basket-shopping"></i>
</div>
</div>
</div>
</section>

<div class="container py-5">
<div class="section-heading text-center mb-4">
<span class="section-label">OUR PRODUCTS</span>
<h2>Explore Fresh Products</h2>
<p>
            Find fresh and quality products available from local farmers.
        </p>
</div>

<div class="filter-box mb-5">
<div class="row g-3">
<div class="col-lg-8">
<div class="search-wrapper">
<i class="fa-solid fa-magnifying-glass"></i>
<input class="form-control" id="searchInput" placeholder="Search products..." type="text"/>
</div>
</div>
<div class="col-lg-4">
<select class="form-select" id="categoryFilter">
    <option value="all">All Categories</option>

    @foreach($products->pluck('category.name')->filter()->unique()->sort() as $category)
        <option value="{{ strtolower(str_replace(' ', '-', $category)) }}">
            {{ $category }}
        </option>
    @endforeach
</select>
</div>
</div>
</div>

@php
    $productImages = [
        'fresh tomatoes' => 'customers/Images/tomatoes.jpg',
        'tomatoes' => 'customers/Images/tomatoes.jpg',

        'fresh apples' => 'customers/Images/apples.jpg',
        'apples' => 'customers/Images/apples.jpg',

        'fresh carrots' => 'customers/Images/carrots.jpg',
        'carrots' => 'customers/Images/carrots.jpg',

        'fresh kiwi' => 'customers/Images/kiwis.jpg',
        'kiwi' => 'customers/Images/kiwis.jpg',

        'fresh bananas' => 'customers/Images/bannanas.jpg',
        'bananas' => 'customers/Images/bannanas.jpg',

        'fresh pineapples' => 'customers/Images/pineapples.jpg',
        'pineapples' => 'customers/Images/pineapples.jpg',

        'fresh almonds' => 'customers/Images/almonds.jpg',
        'almonds' => 'customers/Images/almonds.jpg',

        'fresh strawberries' => 'customers/Images/strawberrys.jpg',
        'strawberries' => 'customers/Images/strawberrys.jpg',

        'fresh walnuts' => 'customers/Images/walnuts.jpg',
        'walnuts' => 'customers/Images/walnuts.jpg',

        'fresh peaches' => 'customers/Images/peaches.jpg',
        'peaches' => 'customers/Images/peaches.jpg',

        'fresh blueberries' => 'customers/Images/blueberrys.jpg',
        'blueberries' => 'customers/Images/blueberrys.jpg',

        'fresh mangoes' => 'customers/Images/mangoes.jpg',
        'mangoes' => 'customers/Images/mangoes.jpg',
    ];
@endphp

<div class="row g-4" id="productList">

    @forelse($products as $product)

        <div
            class="col-12 col-sm-6 col-lg-4 product-card-wrapper"
            data-name="{{ strtolower($product->name) }}"
data-description="{{ strtolower($product->description ?? '') }}"
data-category="{{ strtolower($product->category->name ?? '') }}"
        >

            <div class="product-card h-100">

                <div class="product-image-wrapper">

                    @php
    $imageKey = strtolower(trim($product->name));
@endphp

<img
    src="{{ $product->image_url }}"
    class="product-img"
    alt="{{ $product->name }}"
>
                    <button
                        type="button"
                        class="favorite-btn"
                        data-product-id="{{ $product->product_id }}"
                    >
                        <i class="fa-regular fa-heart"></i>
                    </button>

                </div>

                <div class="card-body">

                    <span class="product-category">
                        {{ $product->category->name ?? 'Fresh Produce' }}
                    </span>

                    <h4>
                        {{ $product->name }}
                    </h4>

                    <p>
                        {{ $product->description ?? 'Fresh quality product from local farmers.' }}
                    </p>

                    <div class="product-bottom">

                        <div class="price">
                            Rs. {{ number_format($product->price, 2) }}
                        </div>

                        <a
                            href="{{ route('product.details', $product->product_id) }}"
                            class="view-btn"
                        >
                            View Product
                        </a>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">
            <div class="no-results">

                <i class="fa-solid fa-box-open"></i>

                <h4>No Products Found</h4>

                <p>
                    There are currently no active products available.
                </p>

            </div>
        </div>

    @endforelse


    <div id="noResults" class="col-12 d-none">
    <div class="no-results">
        <i class="fa-solid fa-box-open"></i>
        <h4>No Products Found</h4>
        <p>No products match your search or selected category.</p>
    </div>
</div>

</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const productCards = document.querySelectorAll('.product-card-wrapper');
    const noResults = document.getElementById('noResults');

    function filterProducts() {

        const searchValue = searchInput.value.toLowerCase().trim();
        const categoryValue = categoryFilter.value.toLowerCase();

        let visibleProducts = 0;

        productCards.forEach(function (card) {

            const productName = card.dataset.name.toLowerCase();
const productDescription = card.dataset.description.toLowerCase();
const productCategory = card.dataset.category.toLowerCase();

const matchesSearch =
    productName.includes(searchValue) ||
    productDescription.includes(searchValue);   

           const normalizedCategory = productCategory
    .trim()
    .replace(/\s+/g, '-');

const matchesCategory =
    categoryValue === 'all' ||
    normalizedCategory === categoryValue; 

            if (matchesSearch && matchesCategory) {
                card.style.display = '';
                visibleProducts++;
            } else {
                card.style.display = 'none';
            }
        });

       if (noResults) {
    noResults.classList.toggle(
        'd-none',
        visibleProducts !== 0 || productCards.length === 0
    );
}
    }

    if (searchInput) {
    searchInput.addEventListener('input', filterProducts);
}

if (categoryFilter) {
    categoryFilter.addEventListener('change', filterProducts);
}

});
</script>

@endsection