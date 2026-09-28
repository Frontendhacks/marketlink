@extends('admin.master')
@section('title', 'Categories')
@section('main')
<div class="dashboard-content">
    <div class="page-header">
        <h1>Categories</h1>
        <p>Organise the products sold on MarketLink.</p>
    </div>

    @include('admin.partials.flash')

    <div class="dashboard-card">
        <div class="toolbar">
            <strong>{{ $categories->count() }} categories</strong>
            <button type="button" class="btn" data-modal-open="categoryModal" data-reset data-title="Add Category" data-action="{{ route('admin.categories.store') }}">+ Add Category</button>
        </div>
        <div class="table-wrap">
            <table class="orders-table">
                <thead><tr><th>Name</th><th>Description</th><th>Products</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td>{{ \Illuminate\Support\Str::limit($category->description, 70) ?: '—' }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td><span class="badge {{ $category->status }}">{{ ucfirst($category->status) }}</span></td>
                        <td>
                            <div class="row-actions">
                                <button type="button" class="btn sm light" data-modal-open="categoryModal" data-title="Edit Category"
                                    data-action="{{ route('admin.categories.update', $category->category_id) }}"
                                    data-method="PUT"
                                    data-fill='{{ json_encode(["name" => $category->name, "description" => $category->description, "status" => $category->status], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG) }}'>Edit</button>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category->category_id) }}" data-confirm="Delete category {{ $category->name }}?">@csrf @method('DELETE')<button class="btn sm danger">Delete</button></form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">No categories yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-overlay" id="categoryModal">
    <div class="modal-box">
        <h3 data-modal-title>Add Category</h3>
        <form method="POST" action="{{ route('admin.categories.store') }}" id="categoryForm">
            @csrf
            <input type="hidden" name="_method" value="POST" id="categoryMethod">
            <div class="form-grid">
                <div class="full"><label>Name</label><input name="name" required maxlength="100"></div>
                <div class="full"><label>Description</label><textarea name="description" rows="3"></textarea></div>
                <div><label>Status</label><select name="status"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn secondary" data-modal-close>Cancel</button>
                <button class="btn">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Switch between create (POST) and update (PUT) when the modal is opened.
    document.addEventListener('click', function (e) {
        var b = e.target.closest('[data-modal-open="categoryModal"]');
        if (!b) return;
        document.getElementById('categoryMethod').value = b.getAttribute('data-method') || 'POST';
    });
</script>
@endpush
