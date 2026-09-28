@extends('customer.master')
@section('main')

<section class="home-hero-full">
<video class="home-hero-video" autoplay muted loop playsinline poster="{{ asset('customers/Images/hero-clean.jpg') }}">
<source src="{{ asset('customers/Videos/background.mp4.mp4') }}" type="video/mp4">
</video>
<div class="hero-overlay">
<div class="container">
<div class="hero-overlay-inner">
<span class="hero-badge">Fresh From Local Farms</span>
<h1>Buy Fresh Products Directly From Local Farmers</h1>
<p>Discover local markets, browse fresh products, save your favorites and prepare pickup pre-orders in one place.</p>
<div class="d-flex gap-3 flex-wrap">
<a class="btn btn-success btn-lg px-4" href="{{ route('products') }}"><i class="fa-solid fa-basket-shopping me-2"></i>Browse Products</a>
<a class="btn btn-outline-light btn-lg px-4" href="{{ route('markets') }}"><i class="fa-solid fa-store me-2"></i>Find Markets</a>
</div>
<div class="hero-stats d-flex gap-4 mt-5">
<div><h3>500+</h3><p>Farmers</p></div>
<div><h3>1200+</h3><p>Products</p></div>
<div><h3>50+</h3><p>Markets</p></div>
</div>
</div>
</div>
</div>
</section>

<section class="feature-strip py-4">
<div class="container">
<div class="row g-3">
<div class="col-md-3 col-6">
<div class="feature-box">
<i class="fa-solid fa-truck-fast"></i>
<div>
<h6>Free Delivery</h6>
<small>On orders above Rs. 1000</small>
</div>
</div>
</div>
<div class="col-md-3 col-6">
<div class="feature-box">
<i class="fa-solid fa-leaf"></i>
<div>
<h6>100% Organic</h6>
<small>Fresh &amp; natural products</small>
</div>
</div>
</div>
<div class="col-md-3 col-6">
<div class="feature-box">
<i class="fa-solid fa-headset"></i>
<div>
<h6>24/7 Support</h6>
<small>Always here to help</small>
</div>
</div>
</div>
<div class="col-md-3 col-6">
<div class="feature-box">
<i class="fa-solid fa-shield-halved"></i>
<div>
<h6>Secure Payment</h6>
<small>100% safe checkout</small>
</div>
</div>
</div>
</div>
</div>
</section>

<section class="py-5 categories-section">
<div class="container">
<div class="section-heading">
<span>SHOP BY</span>
<h2>Popular Categories</h2>
<p>Browse our wide range of fresh categories</p>
</div>
<div class="row g-4">
<div class="col-lg-2 col-md-4 col-6">
<div class="category-card">
<div class="category-icon bg-success-subtle">
<i class="fa-solid fa-carrot text-success"></i>
</div>
<h6>Vegetables</h6>
<small>120+ items</small>
</div>
</div>
<div class="col-lg-2 col-md-4 col-6">
<div class="category-card">
<div class="category-icon bg-danger-subtle">
<i class="fa-solid fa-apple-whole text-danger"></i>
</div>
<h6>Fruits</h6>
<small>85+ items</small>
</div>
</div>
<div class="col-lg-2 col-md-4 col-6">
<div class="category-card">
<div class="category-icon bg-warning-subtle">
<i class="fa-solid fa-wheat-awn text-warning"></i>
</div>
<h6>Grains</h6>
<small>60+ items</small>
</div>
</div>
<div class="col-lg-2 col-md-4 col-6">
<div class="category-card">
<div class="category-icon bg-info-subtle">
<i class="fa-solid fa-cow text-info"></i>
</div>
<h6>Dairy</h6>
<small>45+ items</small>
</div>
</div>
<div class="col-lg-2 col-md-4 col-6">
<div class="category-card">
<div class="category-icon bg-primary-subtle">
<i class="fa-solid fa-jar text-primary"></i>
</div>
<h6>Organic</h6>
<small>70+ items</small>
</div>
</div>
<div class="col-lg-2 col-md-4 col-6">
<div class="category-card">
<div class="category-icon bg-secondary-subtle">
<i class="fa-solid fa-seedling text-secondary"></i>
</div>
<h6>Herbs</h6>
<small>30+ items</small>
</div>
</div>
</div>
</div>
</section>

<section class="py-5 markets-section"><div class="container"><div class="section-heading"><span>EXPLORE</span><h2>Featured Markets</h2><p>Discover local markets and find fresh products near you.</p></div><div class="row g-4">@forelse($markets as $market)<div class="col-md-4"><div class="market-card"><div class="market-image"><img alt="{{ $market->market_name }}" class="img-fluid" src="{{ asset('customers/Images/markets/local-farmers.jpg') }}"/><span class="market-badge">{{ ucfirst($market->status) }}</span></div><div class="market-body"><h5>{{ $market->market_name }}</h5><p class="market-location"><i class="fa-solid fa-location-dot me-1"></i>{{ $market->address }}</p><p>{{ $market->day }} · {{ $market->timing }}</p><div class="market-footer"><div class="market-rating"><i class="fa-solid fa-store text-success"></i> {{ $market->products_count ?? $market->products()->count() }} products</div><a class="btn btn-sm btn-success" href="{{ route('market.details',$market->market_id) }}">Visit <i class="fa-solid fa-arrow-right ms-1"></i></a></div></div></div></div>@empty<div class="col-12"><p class="text-center text-muted">No markets available yet.</p></div>@endforelse</div><div class="text-center mt-4"><a class="btn btn-outline-success px-4" href="{{ route('markets') }}">View All Markets <i class="fa-solid fa-arrow-right ms-2"></i></a></div></div></section>

<section class="products-section py-5"><div class="container"><div class="section-heading"><span>OUR PRODUCTS</span><h2>Featured Products</h2><p>Fresh and quality products from approved local farmers.</p></div><div class="row g-4">@forelse($products as $product)<div class="col-lg-3 col-md-6"><div class="product-card"><div class="product-image"><img alt="{{ $product->name }}" class="img-fluid" src="{{ $product->image ? asset('storage/'.$product->image) : asset('customers/Images/tomatoes.jpg') }}"/><span class="product-tag">Fresh</span><a href="{{ route('product.details',$product->product_id) }}" class="wishlist-btn" aria-label="View product"><i class="fa-solid fa-arrow-right"></i></a></div><div class="product-info"><small class="product-cat">{{ $product->category->name ?? 'Produce' }}</small><h5>{{ $product->name }}</h5><p>{{ Str::limit($product->description ?? 'Fresh quality produce from a local farmer.',70) }}</p><div class="product-footer"><strong>Rs. {{ number_format($product->price,2) }}</strong><a class="btn btn-success btn-sm" href="{{ route('product.details',$product->product_id) }}"><i class="fa-solid fa-cart-plus"></i></a></div></div></div></div>@empty<div class="col-12"><p class="text-center text-muted">No products available yet.</p></div>@endforelse</div><div class="text-center mt-4"><a class="btn btn-outline-success px-4" href="{{ route('products') }}">View All Products <i class="fa-solid fa-arrow-right ms-2"></i></a></div></div></section>
<div class="container">
<div class="section-heading">
<span>OUR PRODUCTS</span>
<h2>Featured Products</h2>
<p>Fresh and quality products from trusted farmers.</p>
</div>
<div class="row g-4">
<div class="col-lg-3 col-md-6">
<div class="product-card">
<div class="product-image">
<img alt="Tomatoes" class="img-fluid" src="{{ asset('customers/Images/tomatoes.jpg') }}"/>
<span class="product-tag">Fresh</span>
<a href="{{ route('favorites') }}" class="wishlist-btn" aria-label="Open favorites"><i class="fa-regular fa-heart"></i></a>
</div>
<div class="product-info">
<small class="product-cat">Vegetables</small>
<h5>Fresh Tomatoes</h5>
<div class="product-rating">
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star-half-stroke"></i>
<small>(45)</small>
</div>
<p>Fresh local tomatoes from farmers.</p>
<div class="product-footer">
<strong>Rs. 180 <small>/ kg</small></strong>
<a class="btn btn-success btn-sm" href="{{ route('products') }}">
<i class="fa-solid fa-cart-plus"></i>
</a>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="product-card">
<div class="product-image">
<img alt="Apples" class="img-fluid" src="{{ asset('customers/Images/apples.jpg') }}"/>
<span class="product-tag bg-danger">Hot</span>
<a href="{{ route('favorites') }}" class="wishlist-btn" aria-label="Open favorites"><i class="fa-regular fa-heart"></i></a>
</div>
<div class="product-info">
<small class="product-cat">Fruits</small>
<h5>Fresh Apples</h5>
<div class="product-rating">
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<small>(62)</small>
</div>
<p>Fresh and delicious apples from local farms.</p>
<div class="product-footer">
<strong>Rs. 350 <small>/ kg</small></strong>
<a class="btn btn-success btn-sm" href="{{ route('products') }}">
<i class="fa-solid fa-cart-plus"></i>
</a>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="product-card">
<div class="product-image">
<img alt="Carrots" class="img-fluid" src="{{ asset('customers/Images/carrots.jpg') }}"/>
<span class="product-tag">Fresh</span>
<a href="{{ route('favorites') }}" class="wishlist-btn" aria-label="Open favorites"><i class="fa-regular fa-heart"></i></a>
</div>
<div class="product-info">
<small class="product-cat">Vegetables</small>
<h5>Fresh Carrots</h5>
<div class="product-rating">
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-regular fa-star"></i>
<small>(38)</small>
</div>
<p>Fresh carrots supplied by local farmers.</p>
<div class="product-footer">
<strong>Rs. 120 <small>/ kg</small></strong>
<a class="btn btn-success btn-sm" href="{{ route('products') }}">
<i class="fa-solid fa-cart-plus"></i>
</a>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="product-card">
<div class="product-image">
<img alt="Mangoes" class="img-fluid" src="{{ asset('customers/Images/mangoes.jpg') }}"/>
<span class="product-tag bg-warning text-dark">Sale</span>
<a href="{{ route('favorites') }}" class="wishlist-btn" aria-label="Open favorites"><i class="fa-regular fa-heart"></i></a>
</div>
<div class="product-info">
<small class="product-cat">Fruits</small>
<h5>Sweet Mangoes</h5>
<div class="product-rating">
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<small>(75)</small>
</div>
<p>Sweet and juicy mangoes from local orchards.</p>
<div class="product-footer">
<strong>Rs. 280 <small>/ kg</small></strong>
<a class="btn btn-success btn-sm" href="{{ route('products') }}">
<i class="fa-solid fa-cart-plus"></i>
</a>
</div>
</div>
</div>
</div>
</div>
<div class="text-center mt-4">
<a class="btn btn-outline-success px-4" href="{{ route('products') }}">View All Products <i class="fa-solid fa-arrow-right ms-2"></i></a>
</div>
</div>
</section>

<section class="fresh-vegetables py-5"><div class="container"><div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3"><div><span class="text-success fw-bold text-uppercase" style="letter-spacing:2px;font-size:13px;">Approved Farmers</span><h2 class="fw-bold mb-0">Meet Local Farmers</h2><p class="text-muted mb-0">Discover approved farmers and their fresh products.</p></div><a class="btn btn-outline-success px-4" href="{{ route('farmers') }}">View All <i class="fa-solid fa-arrow-right ms-2"></i></a></div><div class="row g-4">@forelse($farmers as $profile)<div class="col-lg-4 col-md-6"><div class="veg-card"><div class="veg-img"><img alt="{{ $profile->stall_name }}" src="{{ asset('customers/Images/farmers/farmer.jpg') }}"/><span class="veg-tag bg-success">Approved</span></div><div class="veg-body"><h5>{{ $profile->stall_name }}</h5><p class="text-muted mb-2">{{ $profile->farmer->name }} · {{ $profile->market->market_name ?? 'Local Market' }}</p><p>{{ $profile->stall_description ?: 'Fresh products supplied by a verified MarketLink farmer.' }}</p><a href="{{ route('farmer.details',$profile->farmer_id) }}" class="btn btn-success btn-sm">View Farmer</a></div></div></div>@empty<div class="col-12"><p class="text-center text-muted">No approved farmers available yet.</p></div>@endforelse</div></div></section>

<section class="py-5 farmers-section">
<div class="container">
<div class="section-heading">
<span>MEET OUR</span>
<h2>Top Farmers</h2>
<p>Trusted farmers bringing fresh products to your table</p>
</div>
<div class="row g-4">
<div class="col-lg-3 col-md-6">
<div class="farmer-card">
<div class="farmer-img">
<img alt="Farmer" class="img-fluid" src="{{ asset('customers/Images/farmers/farmer1.jpg') }}"/>
<div class="farmer-social">
<a href="./index.html"><i class="fa-brands fa-facebook-f"></i></a>
<a href="./index.html"><i class="fa-brands fa-twitter"></i></a>
<a href="./index.html"><i class="fa-brands fa-instagram"></i></a>
</div>
</div>
<div class="farmer-info">
<h5>Ahmed Khan</h5>
<small><i class="fa-solid fa-location-dot me-1"></i>Punjab</small>
<p>Organic vegetable farmer with 15+ years experience.</p>
<div class="farmer-stats">
<span><i class="fa-solid fa-box"></i> 45 Products</span>
<span><i class="fa-solid fa-star text-warning"></i> 4.9</span>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="farmer-card">
<div class="farmer-img">
<img alt="Farmer" class="img-fluid" src="{{ asset('customers/Images/farmers/farmer2.jpg') }}"/>
<div class="farmer-social">
<a href="./index.html"><i class="fa-brands fa-facebook-f"></i></a>
<a href="./index.html"><i class="fa-brands fa-twitter"></i></a>
<a href="./index.html"><i class="fa-brands fa-instagram"></i></a>
</div>
</div>
<div class="farmer-info">
<h5>Bilal Ahmed</h5>
<small><i class="fa-solid fa-location-dot me-1"></i>Sindh</small>
<p>Fresh fruit grower specializing in mangoes and citrus.</p>
<div class="farmer-stats">
<span><i class="fa-solid fa-box"></i> 32 Products</span>
<span><i class="fa-solid fa-star text-warning"></i> 4.8</span>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="farmer-card">
<div class="farmer-img">
<img alt="Farmer" class="img-fluid" src="{{ asset('customers/Images/farmers/farmer3.jpg') }}"/>
<div class="farmer-social">
<a href="./index.html"><i class="fa-brands fa-facebook-f"></i></a>
<a href="./index.html"><i class="fa-brands fa-twitter"></i></a>
<a href="./index.html"><i class="fa-brands fa-instagram"></i></a>
</div>
</div>
<div class="farmer-info">
<h5>Sara Malik</h5>
<small><i class="fa-solid fa-location-dot me-1"></i>KPK</small>
<p>Herbal and organic products specialist.</p>
<div class="farmer-stats">
<span><i class="fa-solid fa-box"></i> 28 Products</span>
<span><i class="fa-solid fa-star text-warning"></i> 4.9</span>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="farmer-card">
<div class="farmer-img">
<img alt="Farmer" class="img-fluid" src="{{ asset('customers/Images/farmers/farmer4.jpg') }}"/>
<div class="farmer-social">
<a href="./index.html"><i class="fa-brands fa-facebook-f"></i></a>
<a href="./index.html"><i class="fa-brands fa-twitter"></i></a>
<a href="./index.html"><i class="fa-brands fa-instagram"></i></a>
</div>
</div>
<div class="farmer-info">
<h5>Hassan Ali</h5>
<small><i class="fa-solid fa-location-dot me-1"></i>Balochistan</small>
<p>Dairy and livestock farming expert.</p>
<div class="farmer-stats">
<span><i class="fa-solid fa-box"></i> 38 Products</span>
<span><i class="fa-solid fa-star text-warning"></i> 4.7</span>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<section class="py-5 how-section">
<div class="container">
<div class="section-heading">
<span>HOW IT WORKS</span>
<h2>Shopping Made Simple</h2>
<p>Find what you need and connect with trusted local sellers</p>
</div>
<div class="row g-4 text-center">
<div class="col-md-4">
<div class="step-card">
<div class="step-number">01</div>
<div class="step-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
<h5>Browse</h5>
<p>Explore fresh products, farmers and local markets.</p>
</div>
</div>
<div class="col-md-4">
<div class="step-card">
<div class="step-number">02</div>
<div class="step-icon"><i class="fa-solid fa-cart-shopping"></i></div>
<h5>Choose</h5>
<p>Select the products you want from trusted sellers.</p>
</div>
</div>
<div class="col-md-4">
<div class="step-card">
<div class="step-number">03</div>
<div class="step-icon"><i class="fa-solid fa-circle-check"></i></div>
<h5>Order</h5>
<p>Place your order and get your fresh products.</p>
</div>
</div>
</div>
</div>
</section>

<section class="py-5 testimonials-section">
<div class="container">
<div class="section-heading">
<span>TESTIMONIALS</span>
<h2>What Our Customers Say</h2>
<p>Real reviews from real customers</p>
</div>
<div class="row g-4">
<div class="col-md-4">
<div class="testimonial-card">
<div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
<p>"MarketLink has completely changed how I buy groceries. Fresh products delivered right to my door!"</p>
<div class="testimonial-user">
<img alt="User" src="{{ asset('customers/Images/users/user1.jpg') }}"/>
<div>
<h6>Fatima Noor</h6>
<small>Karachi</small>
<div class="stars">
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="testimonial-card">
<div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
<p>"I love supporting local farmers. The quality is unmatched and prices are very reasonable."</p>
<div class="testimonial-user">
<img alt="User" src="{{ asset('customers/Images/users/user2.jpg') }}"/>
<div>
<h6>Usman Tariq</h6>
<small>Lahore</small>
<div class="stars">
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="testimonial-card">
<div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
<p>"Excellent service and fresh produce. MarketLink is now my go-to for all grocery needs."</p>
<div class="testimonial-user">
<img alt="User" src="{{ asset('customers/Images/users/user3.jpg') }}"/>
<div>
<h6>Ayesha Khan</h6>
<small>Islamabad</small>
<div class="stars">
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star-half-stroke"></i>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<section class="newsletter-section py-5">
<div class="container">
<div class="newsletter-box">
<div class="row align-items-center">
<div class="col-lg-7">
<h3>Subscribe to Our Newsletter</h3>
<p>Get updates on fresh arrivals, seasonal offers and exclusive discounts.</p>
</div>
<div class="col-lg-5">
<form class="newsletter-form d-flex gap-2">
<input class="form-control" placeholder="Enter your email" required="" type="email"/>
<button class="btn btn-success px-4" type="submit">Subscribe</button>
</form>
</div>
</div>
</div>
</div>
</section>


@endsection