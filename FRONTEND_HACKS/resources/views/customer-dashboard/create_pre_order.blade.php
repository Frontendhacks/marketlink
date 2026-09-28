@extends('customer.master')
@section('main')


<style>

    .selected-product-card {
    background: #f7f5ef;
    border-radius: 12px;
    padding: 15px;
    border: 1px solid #e5e7eb;
}
    .hero {
        padding: 20px !important;
        margin-bottom: 15px !important;
        min-height: auto !important;
        height: auto !important;
    }

    .hero h1 {
        margin-bottom: 5px !important;
    }

    .hero p {
        margin-bottom: 0 !important;
    }

    .form-card {
        margin-top: 0 !important;
    }
</style>


<div class="container py-5">
<div class="hero p-3 p-md-4 mb-2">
    <h1 class="fw-bold mb-1">Create Pre-Order</h1>
    <p class="mb-0">Select your product and pickup details.</p>
</div>
<div class="card form-card shadow-sm p-4">
<form id="preOrderForm" method="POST" action="{{ route('pre.order.store') }}">
    @csrf

    <div class="selected-product-card mb-4">
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

    @foreach($products as $product)

        @if(request('product_id') == $product->product_id)

            @php
                $imageKey = strtolower(trim($product->name));
            @endphp

            <div class="row align-items-center g-3">

                <div class="col-md-3">
                    <img
                        src="{{ $product->image_url }}"
                        alt="{{ $product->name }}"
                        class="img-fluid rounded"
                        style="height:160px; width:100%; object-fit:cover;"
                    >
                </div>

                <div class="col-md-9">
                    <h4 class="fw-bold mb-2">
                        {{ $product->name }}
                    </h4>

                    <p class="text-muted mb-2">
                        {{ $product->description ?? 'Fresh quality product from local farmers.' }}
                    </p>

                    <h5 class="fw-bold text-success mb-0">
                        Rs. {{ number_format($product->price, 2) }}
                    </h5>
                </div>

            </div>

        @endif

    @endforeach
</div>
<div class="mb-3">
    <label class="form-label"><b>Product</b></label>

    <select class="form-select" name="product_id" id="product" required>

        <option value="">Select Product</option>

        @foreach($products as $product)

            <option
                value="{{ $product->product_id }}"
                {{ request('product_id') == $product->product_id ? 'selected' : '' }}
            >
                {{ $product->name }} — Rs. {{ number_format($product->price, 2) }}
            </option>

        @endforeach

    </select>
</div>
<div class="mb-3">
<label class="form-label"><b>Quantity</b></label>
<input
    class="form-control"
    name="quantity"
    id="quantity"
    min="1"
    required
    type="number"
    value="1"
/>
</div>
<div class="mb-3">
<label class="form-label"><b>Pickup Date</b></label>
<input
    class="form-control"
    name="pickup_date"
    id="date"
    required
    type="date"
/>
</div>
<div class="mb-3">
<label class="form-label"><b>Pickup Time</b></label>
<select class="form-select" id="time" required="">
<option value="">Select Pickup Time</option>
<option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
<option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
<option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
<option value="12:00 PM - 1:00 PM">12:00 PM - 1:00 PM</option>
</select>
</div>
<div class="mb-3">
<label class="form-label"><b>Market</b></label>
<select class="form-select" id="market" required="">
<option value="">Select Market</option>
<option value="Central Valley Market">Central Valley Market</option>
<option value="Fresh Farm Market">Fresh Farm Market</option>
<option value="Local Farmers Market">Local Farmers Market</option>
</select>
</div>
<div class="mb-3">
<label class="form-label"><b>Additional Note</b></label>
<textarea class="form-control" id="note" placeholder="Optional note" rows="3"></textarea>
</div>
<button class="btn btn-main px-4" type="submit">Place Pre-Order</button>
<a class="btn btn-outline-secondary ms-2" href="{{ route('products') }}">
    Cancel
</a>
</form>
</div>
</div>


@endsection