@extends('farmer.master')

@section('title', 'FarmHub Products')

@section('main')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="fw-bold mb-1">Products</h1>
        <p class="text-muted">Manage your products</p>
    </div>

    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#productModal"
                onclick="openAddModal()">
            <i class="bi bi-plus-lg me-1"></i>
            Add Product
        </button>

        <i class="bi bi-bell fs-4"></i>

        <div class="d-flex align-items-center">
            <i class="bi bi-person-circle fs-2 me-2"></i>

            <div>
                <b>{{ auth()->user()->name }}</b><br>
                <small class="text-muted">Farmer</small>
            </div>
        </div>
    </div>
</div>


{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>
    </div>
@endif


{{-- Validation Errors --}}
@if($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the following:</strong>

        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="row g-4">

    @forelse($products as $product)

        <div class="col-md-6 col-lg-3">

            <div class="card h-100 shadow-sm">

                {{-- Product Image Placeholder --}}
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                     class="card-img-top" style="height:150px;object-fit:cover;">

                <div class="card-body">

                    <span class="badge bg-light text-success mb-2">
                        {{ $product->category->name ?? 'No Category' }}
                    </span>

                    <h5 class="card-title mb-2">
                        {{ $product->name }}
                    </h5>

                    @if($product->description)
                        <p class="text-muted small mb-2">
                            {{ Str::limit($product->description, 60) }}
                        </p>
                    @endif

                    <p class="text-success mb-2">
                        <strong>
                            Rs {{ number_format($product->price, 2) }}
                        </strong>
                    </p>

                    <p class="mb-2">
                        <small class="text-muted">
                            Stock:
                        </small>

                        <strong>
                            {{ $product->stock_quantity }}
                        </strong>
                    </p>

                    <p class="mb-3">
                        <small class="text-muted">
                            Market:
                        </small>

                        <strong>
                            {{ $product->market->market_name ?? 'N/A' }}
                        </strong>
                    </p>


                    @if($product->status === 'active')
                        <span class="badge bg-success mb-3">
                            Active
                        </span>
                    @else
                        <span class="badge bg-secondary mb-3">
                            Inactive
                        </span>
                    @endif


                    <div class="d-flex gap-2">

                        {{-- Edit --}}
                        <button type="button"
                                class="btn btn-success btn-sm flex-fill edit-btn"

                                data-id="{{ $product->product_id }}"
                                data-name="{{ $product->name }}"
                                data-category="{{ $product->category_id }}"
                                data-market="{{ $product->market_id }}"
                                data-description="{{ $product->description }}"
                                data-price="{{ $product->price }}"
                                data-stock="{{ $product->stock_quantity }}"
                                data-day="{{ $product->available_day }}"
                                data-status="{{ $product->status }}"

                                onclick="openEditModal(this)">

                            <i class="bi bi-pencil-square me-1"></i>
                            Edit

                        </button>


                        {{-- Delete --}}
                        <form action="{{ route('farmer.products.destroy', $product->product_id) }}"
                              method="POST"
                              class="flex-fill"
                              onsubmit="return confirm('Are you sure you want to delete this product?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-outline-danger btn-sm w-100">

                                <i class="bi bi-trash me-1"></i>
                                Delete

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="text-center py-5">

                <i class="bi bi-box-seam text-muted"
                   style="font-size:60px;">
                </i>

                <h4 class="mt-3">
                    No Products Found
                </h4>

                <p class="text-muted">
                    You have not added any products yet.
                </p>

                <button class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#productModal"
                        onclick="openAddModal()">

                    <i class="bi bi-plus-lg me-1"></i>
                    Add Your First Product

                </button>

            </div>

        </div>

    @endforelse

</div>



{{-- Product Modal --}}
<div class="modal fade"
     id="productModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title"
                    id="modalTitle">

                    Add Product

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>


            <form id="productForm"
                  method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('farmer.products.store') }}">

                @csrf

                <div id="methodField"></div>


                <div class="modal-body">

                    <div class="row g-3">


                        {{-- Product Name --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Product Name
                            </label>

                            <input type="text"
                                   name="name"
                                   id="pName"
                                   class="form-control"
                                   placeholder="e.g. Fresh Tomatoes"
                                   required>

                        </div>


                        {{-- Category --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Category
                            </label>

                            <select name="category_id"
                                    id="pCategory"
                                    class="form-select"
                                    required>

                                <option value="">
                                    Select Category
                                </option>

                                @foreach($categories as $category)

                                    <option value="{{ $category->category_id }}">
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Market --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Market
                            </label>

                            <select name="market_id"
                                    id="pMarket"
                                    class="form-select"
                                    required>

                                <option value="">
                                    Select Market
                                </option>

                                @foreach($markets as $market)

                                    <option value="{{ $market->market_id }}">
                                        {{ $market->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Price --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Price
                            </label>

                            <input type="number"
                                   name="price"
                                   id="pPrice"
                                   class="form-control"
                                   placeholder="e.g. 150"
                                   min="0"
                                   step="0.01"
                                   required>

                        </div>


                        {{-- Stock --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Stock Quantity
                            </label>

                            <input type="number"
                                   name="stock_quantity"
                                   id="pStock"
                                   class="form-control"
                                   placeholder="e.g. 100"
                                   min="0"
                                   required>

                        </div>


                        {{-- Available Day --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Available Day
                            </label>

                            <input type="text"
                                   name="available_day"
                                   id="pDay"
                                   class="form-control"
                                   placeholder="e.g. Monday">

                        </div>


                        {{-- Status --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Status
                            </label>

                            <select name="status"
                                    id="pStatus"
                                    class="form-select"
                                    required>

                                <option value="active">
                                    Active
                                </option>

                                <option value="inactive">
                                    Inactive
                                </option>

                            </select>

                        </div>


                        {{-- Image --}}
                        <div class="col-12">
                            <label class="form-label">Product Image (optional)</label>
                            <input type="file" name="image" accept="image/*" class="form-control">
                        </div>


                        {{-- Description --}}
                        <div class="col-12">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea name="description"
                                      id="pDescription"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Enter product description">
                            </textarea>

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit"
                            class="btn btn-success">

                        <i class="bi bi-check-lg me-1"></i>
                        <span id="saveButtonText">
                            Save Product
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection



@section('scripts')

<script>

let productModal;


document.addEventListener('DOMContentLoaded', function () {

    const modalElement = document.getElementById('productModal');

    if (modalElement) {
        productModal = new bootstrap.Modal(modalElement);
    }

});



function openAddModal() {

    document.getElementById('modalTitle').innerText = 'Add Product';

    document.getElementById('saveButtonText').innerText = 'Save Product';

    document.getElementById('productForm').action =
        "{{ route('farmer.products.store') }}";


    document.getElementById('methodField').innerHTML = '';


    document.getElementById('pName').value = '';
    document.getElementById('pCategory').value = '';
    document.getElementById('pMarket').value = '';
    document.getElementById('pPrice').value = '';
    document.getElementById('pStock').value = '';
    document.getElementById('pDay').value = '';
    document.getElementById('pStatus').value = 'active';
    document.getElementById('pDescription').value = '';

}



function openEditModal(button) {

    const id = button.dataset.id;

    document.getElementById('modalTitle').innerText =
        'Edit Product';

    document.getElementById('saveButtonText').innerText =
        'Update Product';


    document.getElementById('productForm').action =
        "{{ url('/farmer/products') }}/" + id;


    document.getElementById('methodField').innerHTML =
        '@method("PUT")';


    document.getElementById('pName').value =
        button.dataset.name;

    document.getElementById('pCategory').value =
        button.dataset.category;

    document.getElementById('pMarket').value =
        button.dataset.market;

    document.getElementById('pPrice').value =
        button.dataset.price;

    document.getElementById('pStock').value =
        button.dataset.stock;

    document.getElementById('pDay').value =
        button.dataset.day;

    document.getElementById('pStatus').value =
        button.dataset.status;

    document.getElementById('pDescription').value =
        button.dataset.description;


    productModal.show();

}

</script>

@endsection