@extends('customer.master')

@section('main')

<!-- Hero Section -->
<section class="farmers-hero">

    <div class="hero-shape shape-one"></div>
    <div class="hero-shape shape-two"></div>

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-7">

                <div class="hero-content">

                    <span class="hero-label">
                        <i class="fa-solid fa-seedling"></i>
                        MEET • CONNECT • SUPPORT
                    </span>

                    <h1>
                        Meet the Farmers
                        <br>
                        <em>Behind Your Food.</em>
                    </h1>

                    <p>
                        Discover local farmers, learn about their farms
                        and explore fresh products grown with care.
                    </p>

                    <div class="hero-buttons">

                        <a class="btn hero-btn" href="#farmers">
                            Meet Our Farmers
                            <i class="fa-solid fa-arrow-down ms-2"></i>
                        </a>

                        <a class="hero-link" href="{{ route('products') }}">
                            Explore Products
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </div>

            <div class="col-lg-5">

                <div class="hero-visual">

                    <div class="hero-image">

                        <img
                            alt="Local Farmer"
                            src="{{ asset('customers/Images/farmers/farmer.jpg') }}"
                        >

                    </div>

                    <div class="hero-card hero-card-top">

                        <div class="hero-card-icon">
                            <i class="fa-solid fa-tractor"></i>
                        </div>

                        <div>
                            <strong>Local Farmers</strong>
                            <small>Growing with care</small>
                        </div>

                    </div>

                    <div class="hero-card hero-card-bottom">

                        <div class="hero-card-icon">
                            <i class="fa-solid fa-leaf"></i>
                        </div>

                        <div>
                            <strong>Fresh Produce</strong>
                            <small>From local farms</small>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Farmers Section -->
<section class="farmers-section" id="farmers">

    <div class="container">

        <div class="section-heading">

            <span>OUR FARMERS</span>

            <h2>Meet Local Farmers</h2>

            <p>
                Get to know the farmers who grow and supply fresh
                products through MarketLink.
            </p>

        </div>


        <!-- Farmer Info Bar -->

        <div class="farmer-info-bar">

            <div class="farmer-info-item">

                <div class="info-icon">
                    <i class="fa-solid fa-user-check"></i>
                </div>

                <div>
                    <strong>Trusted Farmers</strong>
                    <span>Connect with local sellers</span>
                </div>

            </div>


            <div class="farmer-info-item">

                <div class="info-icon">
                    <i class="fa-solid fa-seedling"></i>
                </div>

                <div>
                    <strong>Fresh Produce</strong>
                    <span>Farm-fresh products</span>
                </div>

            </div>


            <div class="farmer-info-item">

                <div class="info-icon">
                    <i class="fa-solid fa-handshake"></i>
                </div>

                <div>
                    <strong>Direct Connection</strong>
                    <span>Support local farming</span>
                </div>

            </div>

        </div>


        <!-- Database Farmers -->

        <div class="row g-4">

            @forelse($farmers as $farmerProfile)

                <div class="col-md-6 col-lg-4">

                    <div class="farmer-card h-100">

                        <div class="farmer-image">

                            <img
                                alt="{{ $farmerProfile->farmer->name }}"
                                src="{{ asset('customers/Images/farmers/farmer.jpg') }}"
                            >

                            <span class="farmer-badge">

                                <i class="fa-solid fa-circle-check"></i>

                                Verified Farmer

                            </span>

                        </div>


                        <div class="farmer-content">

                            <span class="farmer-type">
                                Local Farmer
                            </span>


                            <h4>
                                {{ $farmerProfile->stall_name ?: $farmerProfile->farmer->name }}
                            </h4>


                            <p class="farmer-location">

                                <i class="fa-solid fa-location-dot"></i>

                                {{ $farmerProfile->market->market_name ?? 'Local Market' }}

                            </p>


                            <p class="farmer-description">

                                {{ $farmerProfile->stall_description ?: 'Fresh products supplied by a local farmer through MarketLink.' }}

                            </p>


                            <div class="farmer-meta">

                                <span>

                                    <i class="fa-solid fa-leaf"></i>

                                    Fresh Produce

                                </span>


                                <span>

                                    <i class="fa-solid fa-store"></i>

                                    Local Market

                                </span>

                            </div>


                            <a
                                class="farmer-btn"
                                href="{{ route('farmer.details', ['id' => $farmerProfile->farmer_id]) }}"
                            >

                                View Farmer

                                <i class="fa-solid fa-arrow-right"></i>

                            </a>

                        </div>

                    </div>

                </div>


            @empty

                <div class="col-12">

                    <div class="text-center py-5">

                        <i
                            class="fa-solid fa-tractor"
                            style="font-size:45px;"
                        ></i>

                        <h4 class="mt-3">
                            No Farmers Available
                        </h4>

                        <p class="text-muted">
                            There are currently no active farmers available.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>


<!-- CTA -->

<section class="farmer-cta">

    <div class="container">

        <div class="cta-content">

            <div>

                <span>
                    FRESH • LOCAL • DIRECT
                </span>

                <h2>
                    Explore products from local farmers.
                </h2>

                <p>
                    Discover fresh produce and support farmers
                    through MarketLink.
                </p>

            </div>


            <a
                class="cta-btn"
                href="{{ route('products') }}"
            >

                Browse Products

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>

    </div>

</section>

@endsection