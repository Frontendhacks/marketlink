<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::with(['category', 'farmer', 'market'])
            ->where('status', 'active')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->latest('product_id')
            ->get();

        $categories = Category::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('customer.products', compact(
            'products',
            'categories',
            'search'
        ));
    }


    public function farmerProducts()
{
    $products = Product::with(['category', 'market'])
        ->where('farmer_id', auth()->id())
        ->latest('product_id')
        ->get();

    $categories = Category::where('status', 'active')
        ->orderBy('name')
        ->get();

    $markets = Market::where('status', 'active')->orderBy('market_name')->get();

    return view('farmer.products', compact(
        'products',
        'categories',
        'markets'
    ));
}

public function storeFarmerProduct(Request $request)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,category_id',
        'market_id' => 'required|exists:markets,market_id',
        'name' => 'required|string|max:100',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'available_day' => 'required|string|max:20',
        'status' => 'required|in:active,inactive',
        'image' => 'nullable|image|max:4096',
    ]);

    $validated['farmer_id'] = auth()->id();
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    Product::create($validated);

    return redirect()
        ->route('farmer.products')
        ->with('success', 'Product added successfully.');
}

public function updateFarmerProduct(Request $request, $id)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,category_id',
        'market_id' => 'required|exists:markets,market_id',
        'name' => 'required|string|max:100',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'available_day' => 'required|string|max:20',
        'status' => 'required|in:active,inactive',
        'image' => 'nullable|image|max:4096',
    ]);

    $product = Product::where('product_id', $id)
        ->where('farmer_id', auth()->id())
        ->firstOrFail();

    if ($request->hasFile('image')) {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $validated['image'] = $request->file('image')->store('products', 'public');
    }
    $product->update($validated);

    return redirect()
        ->route('farmer.products')
        ->with('success', 'Product updated successfully.');
}

public function destroyFarmerProduct($id)
{
    $product = Product::where('product_id', $id)
        ->where('farmer_id', auth()->id())
        ->firstOrFail();

    if ($product->image) Storage::disk('public')->delete($product->image);
    $product->delete();

    return redirect()
        ->route('farmer.products')
        ->with('success', 'Product deleted successfully.');
}
}
