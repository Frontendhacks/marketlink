@extends('customer.master')

@section('main')

<style>
    /* =========================
       MARKETS HERO
    ========================= */

    .markets-hero {
        position: relative;
        overflow: hidden;
        padding: 85px 0 90px;
        background: #f7f8f2;
    }

    .markets-hero .container {
        position: relative;
        z-index: 2;
    }

    .hero-content {
        max-width: 650px;
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #4d7c0f;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1.5px;
    }

    .hero-label i {
        font-size: 15px;
    }

    .hero-content h1 {
        margin: 0 0 20px;
        color: #1f2937;
        font-size: clamp(42px, 5vw, 68px);
        font-weight: 800;
        line-height: 1.08;
        letter-spacing: -1.5px;
    }

    .hero-content h1 em {
        color: #5f8f24;
        font-style: normal;
    }

    .hero-content p {
        max-width: 580px;
        margin: 0 0 30px;
        color: #6b7280;
        font-size: 17px;
        line-height: 1.8;
    }

    .hero-buttons {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 22px;
    }

    .hero-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 48px;
        padding: 12px 24px;
        border: 0;
        border-radius: 8px;
        background: #5f8f24;
        color: #fff;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .hero-btn:hover {
        background: #4d761c;
        color: #fff;
        transform: translateY(-2px);
    }

    .hero-link {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: #374151;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .hero-link i {
        transition: transform 0.25s ease;
    }

    .hero-link:hover {
        color: #5f8f24;
    }

    .hero-link:hover i {
        transform: translateX(4px);
    }


    /* =========================
       HERO VISUAL
    ========================= */

    .hero-visual {
        position: relative;
        max-width: 500px;
        margin: 0 auto;
        padding: 15px 25px 35px;
    }

    .hero-image {
        position: relative;
        overflow: hidden;
        height: 430px;
        border-radius: 24px;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.14);
    }

    .hero-image img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    .hero-card {
        position: absolute;
        z-index: 3;
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 205px;
        padding: 14px 17px;
        border: 1px solid rgba(255, 255, 255, 0.7);
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.96);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }

    .hero-card-top {
        top: 35px;
        left: -5px;
    }

    .hero-card-bottom {
        right: -5px;
        bottom: 5px;
    }

    .hero-card-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #edf5df;
        color: #5f8f24;
        font-size: 17px;
    }

    .hero-card strong {
        display: block;
        margin-bottom: 3px;
        color: #1f2937;
        font-size: 14px;
        font-weight: 700;
    }

    .hero-card small {
        display: block;
        color: #6b7280;
        font-size: 12px;
    }

    .hero-shape {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }

    .shape-one {
        top: -120px;
        right: -100px;
        width: 330px;
        height: 330px;
        background: rgba(133, 173, 76, 0.10);
    }

    .shape-two {
        bottom: -170px;
        left: -120px;
        width: 360px;
        height: 360px;
        background: rgba(133, 173, 76, 0.08);
    }


    /* =========================
       MARKETS SECTION
    ========================= */

    .markets-section {
        padding: 90px 0;
        background: #fff;
    }

    .section-heading {
        max-width: 700px;
        margin: 0 auto 42px;
        text-align: center;
    }

    .section-heading > span {
        display: inline-block;
        margin-bottom: 10px;
        color: #5f8f24;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .section-heading h2 {
        margin: 0 0 12px;
        color: #1f2937;
        font-size: clamp(30px, 4vw, 42px);
        font-weight: 800;
    }

    .section-heading p {
        max-width: 600px;
        margin: 0 auto;
        color: #6b7280;
        font-size: 16px;
        line-height: 1.7;
    }


    /* =========================
       MARKET INFO BAR
    ========================= */

    .market-info-bar {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 42px;
        padding: 22px;
        border: 1px solid #e8ece2;
        border-radius: 18px;
        background: #f8faf5;
    }

    .market-info-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 8px 12px;
    }

    .info-icon {
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #e8f1d9;
        color: #5f8f24;
        font-size: 18px;
    }

    .market-info-item strong {
        display: block;
        margin-bottom: 4px;
        color: #27313b;
        font-size: 14px;
        font-weight: 700;
    }

    .market-info-item span {
        display: block;
        color: #7a838d;
        font-size: 12px;
        line-height: 1.5;
    }


    /* =========================
       MARKET CARDS
    ========================= */

    .market-card {
        overflow: hidden;
        border: 1px solid #e6e9e3;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .market-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 35px rgba(0, 0, 0, 0.10);
    }

    .market-image {
        position: relative;
        overflow: hidden;
        height: 235px;
    }

    .market-image img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .market-card:hover .market-image img {
        transform: scale(1.05);
    }

    .market-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.94);
        color: #4d7c0f;
        font-size: 11px;
        font-weight: 700;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.10);
    }

    .market-badge i {
        font-size: 11px;
    }

    .market-info {
        display: flex;
        flex-direction: column;
        padding: 24px;
    }

    .market-info h4 {
        margin: 0 0 9px;
        color: #202a34;
        font-size: 21px;
        font-weight: 800;
    }

    .market-info .location {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        margin: 0 0 20px;
        color: #7b8490;
        font-size: 13px;
        line-height: 1.5;
    }

    .market-info .location i {
        margin-top: 2px;
        color: #6f9b31;
    }

    .market-detail {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 11px 0;
        border-top: 1px solid #edf0eb;
    }

    .market-detail span {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #858d96;
        font-size: 12px;
    }

    .market-detail span i {
        color: #6f9b31;
    }

    .market-detail strong {
        color: #39424d;
        font-size: 12px;
        font-weight: 700;
        text-align: right;
    }

    .market-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        width: 100%;
        margin-top: 18px;
        padding: 12px 15px;
        border: 1px solid #dbe7c9;
        border-radius: 9px;
        background: #f5f9ed;
        color: #557f22;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .market-btn i {
        transition: transform 0.25s ease;
    }

    .market-btn:hover {
        border-color: #5f8f24;
        background: #5f8f24;
        color: #fff;
    }

    .market-btn:hover i {
        transform: translateX(4px);
    }


    /* =========================
       CTA
    ========================= */

    .market-cta {
        padding: 70px 0;
        background: #f4f7ee;
    }

    .cta-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 35px;
        padding: 35px 40px;
        border-radius: 20px;
        background: #5f8f24;
        box-shadow: 0 15px 35px rgba(95, 143, 36, 0.18);
    }

    .cta-content > div {
        max-width: 680px;
    }

    .cta-content > div > span {
        display: inline-block;
        margin-bottom: 8px;
        color: rgba(255, 255, 255, 0.78);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.7px;
    }

    .cta-content h2 {
        margin: 0 0 8px;
        color: #fff;
        font-size: clamp(26px, 3vw, 36px);
        font-weight: 800;
    }

    .cta-content p {
        margin: 0;
        color: rgba(255, 255, 255, 0.86);
        font-size: 14px;
        line-height: 1.7;
    }

    .cta-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex-shrink: 0;
        padding: 13px 21px;
        border-radius: 9px;
        background: #fff;
        color: #527d20;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .cta-btn:hover {
        background: #f1f4eb;
        color: #426718;
        transform: translateY(-2px);
    }

    .cta-btn i {
        transition: transform 0.25s ease;
    }

    .cta-btn:hover i {
        transform: translateX(4px);
    }


    /* =========================
       TABLET
    ========================= */

    @media (max-width: 991.98px) {

        .markets-hero {
            padding: 65px 0 70px;
        }

        .hero-content {
            max-width: 100%;
            text-align: center;
        }

        .hero-content p {
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            justify-content: center;
        }

        .hero-visual {
            margin-top: 45px;
        }

        .market-info-bar {
            grid-template-columns: 1fr;
        }

        .cta-content {
            align-items: flex-start;
            flex-direction: column;
        }

        .cta-btn {
            width: auto;
        }
    }


    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 767.98px) {

        .markets-hero {
            padding: 50px 0 60px;
        }

        .hero-content h1 {
            font-size: 42px;
            letter-spacing: -1px;
        }

        .hero-content p {
            font-size: 15px;
            line-height: 1.7;
        }

        .hero-buttons {
            flex-direction: column;
            gap: 15px;
        }

        .hero-btn {
            width: 100%;
            max-width: 260px;
        }

        .hero-visual {
            padding: 10px 10px 30px;
            margin-top: 35px;
        }

        .hero-image {
            height: 330px;
            border-radius: 18px;
        }

        .hero-card {
            min-width: 175px;
            padding: 11px 13px;
        }

        .hero-card-top {
            top: 20px;
            left: -5px;
        }

        .hero-card-bottom {
            right: -5px;
            bottom: 0;
        }

        .hero-card-icon {
            width: 36px;
            height: 36px;
            flex-basis: 36px;
            font-size: 14px;
        }

        .hero-card strong {
            font-size: 12px;
        }

        .hero-card small {
            font-size: 10px;
        }

        .markets-section {
            padding: 65px 0;
        }

        .section-heading {
            margin-bottom: 32px;
        }

        .section-heading h2 {
            font-size: 32px;
        }

        .section-heading p {
            font-size: 14px;
        }

        .market-info-bar {
            gap: 8px;
            margin-bottom: 30px;
            padding: 15px;
        }

        .market-info-item {
            padding: 8px 4px;
        }

        .market-image {
            height: 220px;
        }

        .market-info {
            padding: 20px;
        }

        .market-info h4 {
            font-size: 19px;
        }

        .market-detail {
            align-items: flex-start;
            flex-direction: column;
            gap: 5px;
        }

        .market-detail strong {
            text-align: left;
        }

        .market-cta {
            padding: 50px 0;
        }

        .cta-content {
            padding: 28px 22px;
            border-radius: 16px;
        }

        .cta-content h2 {
            font-size: 27px;
        }

        .cta-content p {
            font-size: 13px;
        }

        .cta-btn {
            width: 100%;
        }
    }


    /* =========================
       SMALL MOBILE
    ========================= */

    @media (max-width: 480px) {

        .hero-content h1 {
            font-size: 36px;
        }

        .hero-label {
            font-size: 11px;
            letter-spacing: 1px;
        }

        .hero-image {
            height: 280px;
        }

        .hero-card {
            min-width: 155px;
        }

        .hero-card-top {
            left: -8px;
        }

        .hero-card-bottom {
            right: -8px;
        }

        .market-info-bar {
            border-radius: 14px;
        }

        .market-card {
            border-radius: 15px;
        }
    }
</style>


<!-- Hero Section -->
<section class="markets-hero">
    <div class="hero-shape shape-one"></div>
    <div class="hero-shape shape-two"></div>

    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-7">
                <div class="hero-content">

                    <span class="hero-label">
                        <i class="fa-solid fa-leaf"></i>
                        DISCOVER • CONNECT • SHOP
                    </span>

                    <h1>
                        Find Fresh Markets
                        <br/>
                        <em>Near You.</em>
                    </h1>

                    <p>
                        Explore trusted local markets, discover fresh farm
                        products and connect directly with local farmers.
                    </p>

                    <div class="hero-buttons">

                        <a class="btn hero-btn" href="#markets">
                            Explore Markets
                            <i class="fa-solid fa-arrow-down ms-2"></i>
                        </a>

                        <a class="hero-link" href="{{ route('products') }}">
                            Browse Products
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                    </div>

                </div>
            </div>

            <div class="col-lg-5">
                <div class="hero-visual">

                    <div class="hero-image">
                        <img
                            src="{{ asset('customers/Images/markets/valley-market.jpg') }}"
                            alt="Fresh Local Market"
                        >
                    </div>

                    <div class="hero-card hero-card-top">
                        <div class="hero-card-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <div>
                            <strong>Local Markets</strong>
                            <small>Fresh &amp; trusted</small>
                        </div>
                    </div>

                    <div class="hero-card hero-card-bottom">
                        <div class="hero-card-icon">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>

                        <div>
                            <strong>Fresh Products</strong>
                            <small>Direct from farmers</small>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<!-- Markets Section -->
<section class="markets-section" id="markets">

    <div class="container">

        <div class="section-heading">

            <span>MARKETPLACES</span>

            <h2>Available Markets</h2>

            <p>
                Explore trusted local markets and find fresh products
                available from local farmers.
            </p>

        </div>


        <!-- Market Info -->
        <div class="market-info-bar">

            <div class="market-info-item">

                <div class="info-icon">
                    <i class="fa-solid fa-store"></i>
                </div>

                <div>
                    <strong>Local Markets</strong>
                    <span>Explore nearby marketplaces</span>
                </div>

            </div>


            <div class="market-info-item">

                <div class="info-icon">
                    <i class="fa-solid fa-seedling"></i>
                </div>

                <div>
                    <strong>Fresh Produce</strong>
                    <span>Products from local farmers</span>
                </div>

            </div>


            <div class="market-info-item">

                <div class="info-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>

                <div>
                    <strong>Flexible Timings</strong>
                    <span>Check market pickup hours</span>
                </div>

            </div>

        </div>


        <div class="row g-4">

            @forelse($markets as $market)

    <div class="col-md-6 col-lg-4">

        <div class="market-card h-100">

            <div class="market-image">

                <img
                    src="{{ asset('customers/Images/markets/valley-market.jpg') }}"
                    alt="{{ $market->market_name }}"
                >

                <span class="market-badge">
                    <i class="fa-solid fa-circle-check"></i>
                    Active Market
                </span>

            </div>

            <div class="market-info">

                <h4>{{ $market->market_name }}</h4>

                <p class="location">
                    <i class="fa-solid fa-location-dot"></i>
                    {{ $market->address }}
                </p>

                <div class="market-detail">

                    <span>
                        <i class="fa-regular fa-calendar"></i>
                        Day
                    </span>

                    <strong>
                        {{ $market->day }}
                    </strong>

                </div>

                <div class="market-detail">

                    <span>
                        <i class="fa-regular fa-clock"></i>
                        Time
                    </span>

                    <strong>
                        {{ $market->timing }}
                    </strong>

                </div>

                <a
                    class="market-btn"
                    href="{{ route('market.details', ['id' => $market->market_id]) }}"
                >
                    View Market
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>

@empty

    <div class="col-12">

        <div class="text-center py-5">

            <i
                class="fa-solid fa-store"
                style="font-size: 45px; color: #5f8f24;"
            ></i>

            <h4 class="mt-3">No Markets Available</h4>

            <p class="text-muted">
                There are currently no active markets available.
            </p>

        </div>

    </div>

@endforelse

    </div>

</section>


<!-- CTA -->
<section class="market-cta">

    <div class="container">

        <div class="cta-content">

            <div>

                <span>FRESH • LOCAL • TRUSTED</span>

                <h2>Looking for fresh products?</h2>

                <p>
                    Explore products from local farmers and discover
                    fresh produce available through MarketLink.
                </p>

            </div>

            <a
                class="cta-btn"
                href="{{ route('products') }}"
            >
                Explore Products
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

    </div>

</section>

@endsection