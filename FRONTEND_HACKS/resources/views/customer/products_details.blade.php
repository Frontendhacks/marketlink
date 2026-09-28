@extends('customer.master')

@section('main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>

<style>
    .product-detail-page {
        background: #f7f5ef;
        padding: 35px 0 60px;
        min-height: 100vh;
    }

    .product-box {
        background: #ffffff;
        border-radius: 18px;
        padding: 25px;
    }

    .product-image-box {
        background: #f3f5ef;
        border-radius: 15px;
        padding: 15px;
    }

    .product-img {
        height: 420px;
        width: 100%;
        object-fit: cover;
        border-radius: 12px;
        display: block;
    }

    .product-info {
        padding: 20px;
    }

    .product-title {
        font-size: 38px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 10px;
    }

    .price {
        color: #2f6b3f;
        font-size: 28px;
        font-weight: 700;
    }

    .rating {
        color: #f97316;
    }

    .product-description {
        color: #6b7280;
        line-height: 1.7;
    }

    .product-meta {
        border-top: 1px solid #eeeeee;
        border-bottom: 1px solid #eeeeee;
        padding: 18px 0;
        margin: 20px 0;
    }

    .product-meta p {
        margin-bottom: 10px;
    }

    .product-meta p:last-child {
        margin-bottom: 0;
    }

    .btn-main {
        background: #2f6b3f;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-main:hover {
        background: #1f4d2e;
        color: white;
    }

    .back-link {
        color: #2f6b3f;
        text-decoration: none;
        font-weight: 600;
    }

    .back-link:hover {
        color: #1f4d2e;
    }

    @media (max-width: 767px) {

        .product-detail-page {
            padding: 20px 0 40px;
        }

        .product-box {
            padding: 15px;
        }

        .product-img {
            height: 300px;
        }

        .product-info {
            padding: 10px 5px;
        }

        .product-title {
            font-size: 30px;
        }

        .price {
            font-size: 24px;
        }
    }
</style>

<div class="product-detail-page">

    <div class="container">

        {{-- Back to Products --}}
        <div class="mb-3">
            <a
                class="back-link"
                href="{{ route('products') }}"
            >
                ← Back to Products
            </a>
        </div>

        <div class="product-box shadow-sm">

            <div class="row align-items-center g-4">

                {{-- Product Image --}}
                <div class="col-md-6">

                    <div class="product-image-box">

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

    $imageKey = strtolower(trim($product->name));
@endphp

<img
    src="{{ $product->image_url }}"
    class="product-img"
    alt="{{ $product->name }}"
>

                    </div>

                </div>

                {{-- Product Information --}}
                <div class="col-md-6">

                    <div class="product-info">

                        {{-- Category --}}
                        @if($product->category)

                            <span class="badge bg-light text-dark mb-2">
                                {{ $product->category->name }}
                            </span>

                        @endif

                        {{-- Product Name --}}
                        <h1 class="product-title">
                            {{ $product->name }}
                        </h1>

                        {{-- Rating --}}
                        <p class="rating">
                            ★★★★★
                            <span class="text-muted">
                                5.0
                            </span>
                        </p>

                        {{-- Description --}}
                        <p class="product-description">
                            {{ $product->description ?? 'Fresh quality product sourced from local farmers.' }}
                        </p>

                        {{-- Price --}}
                        <p class="price">
                            Rs. {{ number_format($product->price, 2) }}
                        </p>

                        {{-- Product Details --}}
                        <div class="product-meta">

                            <p>
                                <b>Farmer:</b>

                                @if($product->farmer)
                                    {{ $product->farmer->name ?? 'Local Farmer' }}
                                @else
                                    Local Farmer
                                @endif
                            </p>

                            <p>
                                <b>Market:</b>

                                @if($product->market)
                                    {{ $product->market->name ?? 'Local Market' }}
                                @else
                                    Local Market
                                @endif
                            </p>

                            <p>
                                <b>Availability:</b>

                                @if($product->status === 'active')

                                    <span class="text-success">
                                        Available
                                    </span>

                                @else

                                    <span class="text-danger">
                                        Not Available
                                    </span>

                                @endif
                            </p>

                        </div>

                        {{-- Quantity --}}
                        <div class="mb-3">

                            <label class="form-label">
                                <b>Quantity</b>
                            </label>

                            <input
                                class="form-control"
                                min="1"
                                name="quantity"
                                style="max-width:120px"
                                type="number"
                                value="1"
                            >

                        </div>

                        @auth
                            @if(auth()->user()->role === 'customer')
                                <form action="{{ route('orders.store') }}" method="POST" class="d-flex flex-wrap gap-2 align-items-end mb-2">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                    <div>
                                        <label class="form-label"><b>Quantity</b></label>
                                        <input class="form-control" min="1" max="{{ max(1, $product->stock_quantity) }}" name="quantity" type="number" value="1" style="max-width:120px">
                                    </div>
                                    <button class="btn btn-main px-4 py-2" type="submit" {{ $product->stock_quantity < 1 ? 'disabled' : '' }}>
                                        {{ $product->stock_quantity < 1 ? 'Out of Stock' : 'Place Order' }}
                                    </button>
                                </form>
                                <form action="{{ route('favorites.toggle', $product->product_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-outline-success px-4 py-2" type="submit">Add / Remove Favorite</button>
                                </form>
                                <a class="btn btn-outline-success px-4 py-2" href="{{ route('pre.order.create', ['product_id' => $product->product_id]) }}">Add to Pre-Order</a>
                            @else
                                <a class="btn btn-main px-4 py-2" href="{{ route('login') }}">Login as Customer to Order</a>
                            @endif
                        @else
                            <a class="btn btn-main px-4 py-2" href="{{ route('login') }}">Login to Order</a>
                        @endauth

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection