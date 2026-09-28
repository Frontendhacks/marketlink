@extends('admin.master')
@section('title', 'Products')
@section('main')
<div class="dashboard-content">
    <div class="page-header">
        <h1>Products</h1>
        <p>Manage every product listed on MarketLink.</p>
    </div>

    @include('admin.partials.flash')

    <div class="stats-grid cols-4">
        <div class="stat-card"><div class="stat-info"><p>Total Products</p><h2>{{ $stats['total'] }}</h2></div><div class="stat-icon">📦</div></div>
        <div class="stat-card"><div class="stat-info"><p>Active</p><h2>{{ $stats['active'] }}</h2></div><div class="stat-icon">✅</div></div>
        <div class="stat-card"><div class="stat-info"><p>Inactive</p><h2>{{ $stats['inactive'] }}</h2></div><div class="stat-icon">⏸️</div></div>
        <div class="stat-card"><div class="stat-info"><p>Out of Stock</p><h2>{{ $stats['out_of_stock'] }}</h2></div><div class="stat-icon">⚠️</div></div>
    </div>

    <div class="dashboard-card">
        <div class="toolbar">
            <form method="GET" action="{{ route('admin.products') }}">
                <input type="text" name="q" value="{{ $search }}" placeholder="Search product or farmer...">
                <select name="category">
                    <option value="">All categories</option>
                    @foreach($categories as $category)<option value="{{ $category->category_id }}" @selected($categoryId == $category->category_id)>{{ $category->name }}</option>@endforeach
                </select>
                <select name="status">
                    <option value="">All status</option>
                    <option value="active" @selected($status === 'active')>Active</option>
                    <option value="inactive" @selected($status === 'inactive')>Inactive</option>
                </select>
                <button class="btn" type="submit">Filter</button>
                @if($search || $status || $categoryId)<a class="btn light" href="{{ route('admin.products') }}">Reset</a>@endif
            </form>
            <button type="button" class="btn" data-modal-open="productModal" data-reset data-title="Add Product" data-action="{{ route('admin.products.store') }}" data-method="POST">+ Add Product</button>
        </div>

        <div class="table-wrap">
            <table class="orders-table">
                <thead><tr><th>Product</th><th>Farmer</th><th>Category</th><th>Market</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td><div class="cell-user"><img class="thumb" src="{{ $product->image_url }}" alt="{{ $product->name }}"><div><strong>{{ $product->name }}</strong><div class="muted">{{ $product->available_day }}</div></div></div></td>
                        <td>{{ $product->farmer->name ?? '—' }}</td>
                        <td>{{ $product->category->name ?? '—' }}</td>
                        <td>{{ $product->market->market_name ?? '—' }}</td>
                        <td>Rs. {{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td><span class="badge {{ $product->status }}">{{ ucfirst($product->status) }}</span></td>
                        <td>
                            <div class="row-actions">
                                <button type="button" class="btn sm light" data-modal-open="productModal" data-title="Edit Product" data-method="PUT"
                                    data-action="{{ route('admin.products.update', $product->product_id) }}"
                                    data-fill='{{ json_encode(["farmer_id" => $product->farmer_id, "category_id" => $product->category_id, "market_id" => $product->market_id, "name" => $product->name, "description" => $product->description, "price" => $product->price, "stock_quantity" => $product->stock_quantity, "available_day" => $product->available_day, "status" => $product->status], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG) }}'>Edit</button>
                                <form method="POST" action="{{ route('admin.products.destroy', $product->product_id) }}" data-confirm="Delete {{ $product->name }}?">@csrf @method('DELETE')<button class="btn sm danger">Delete</button></form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="empty">No products found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @include('admin.partials.pagination', ['paginator' => $products])
    </div>
</div>

<div class="modal-overlay" id="productModal">
    <div class="modal-box">
        <h3 data-modal-title>Add Product</h3>
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="POST" id="productMethod">
            <div class="form-grid">
                <div class="full"><label>Product name</label><input name="name" required maxlength="100"></div>
                <div>
                    <label>Farmer</label>
                    <select name="farmer_id" required>
                        <option value="">Select farmer</option>
                        @foreach($farmers as $farmer)<option value="{{ $farmer->id }}">{{ $farmer->name }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label>Category</label>
                    <select name="category_id" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)<option value="{{ $category->category_id }}">{{ $category->name }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label>Market</label>
                    <select name="market_id" required>
                        <option value="">Select market</option>
                        @foreach($markets as $market)<option value="{{ $market->market_id }}">{{ $market->market_name }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label>Available day</label>
                    <input name="available_day" required maxlength="20" placeholder="e.g. Saturday">
                </div>
                <div><label>Price (Rs.)</label><input type="number" name="price" step="0.01" min="0" required></div>
                <div><label>Stock quantity</label><input type="number" name="stock_quantity" min="0" step="1" required></div>
                <div><label>Status</label><select name="status"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
                <div><label>Image (optional)</label><input type="file" name="image" accept="image/*"></div>
                <div class="full"><label>Description</label><textarea name="description" rows="3"></textarea></div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn secondary" data-modal-close>Cancel</button>
                <button class="btn">Save Product</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('click', function (e) {
        var b = e.target.closest('[data-modal-open="productModal"]');
        if (b) document.getElementById('productMethod').value = b.getAttribute('data-method') || 'POST';
    });
</script>
@endpush
