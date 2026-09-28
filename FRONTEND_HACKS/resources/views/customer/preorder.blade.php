@extends('customer.master')
@section('main')


<div class="container py-5">
<div class="hero p-4 p-md-5 mb-4">
<h1 class="fw-bold">Create Pre-Order</h1>
<p class="mb-0">Select your product and pickup details.</p>
</div>
<div class="card form-card shadow-sm p-4">
<form id="preOrderForm">
<div class="mb-3">
<label class="form-label"><b>Product</b></label>
<select class="form-select" id="product" required="">
<option value="">Select Product</option>
<option value="Fresh Tomatoes">Fresh Tomatoes</option>
<option value="Fresh Apples">Fresh Apples</option>
<option value="Fresh Carrots">Fresh Carrots</option>
</select>
</div>
<div class="mb-3">
<label class="form-label"><b>Quantity</b></label>
<input class="form-control" id="quantity" min="1" required="" type="number"/>
</div>
<div class="mb-3">
<label class="form-label"><b>Pickup Date</b></label>
<input class="form-control" id="date" required="" type="date"/>
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
<a class="btn btn-outline-secondary ms-2" href="products.html">Cancel</a>
</form>
</div>
</div>


@endsection