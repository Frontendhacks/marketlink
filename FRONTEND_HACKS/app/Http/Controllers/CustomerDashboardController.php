<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class CustomerDashboardController extends Controller
{
    public function index()
{
    $customer = Auth::user();

    $activeOrders = Order::where('customer_id', $customer->getKey())
        ->where('order_type', 'normal')
        ->whereIn('order_status', ['pending', 'confirmed'])
        ->count();

    $completedOrders = Order::where('customer_id', $customer->getKey())
        ->where('order_type', 'normal')
        ->where('order_status', 'completed')
        ->count();

    $favoriteCount = Favorite::where('customer_id', $customer->getKey())
        ->count();

    $preorderCount = Order::where('customer_id', $customer->getKey())
        ->where('order_type', 'preorder')
        ->count();

    $recentOrders = Order::with('product')
        ->where('customer_id', $customer->getKey())
        ->where('order_type', 'normal')
        ->latest('order_date')
        ->take(5)
        ->get();

    return view('customer-dashboard.dashboard', compact(
        'customer',
        'activeOrders',
        'completedOrders',
        'favoriteCount',
        'preorderCount',
        'recentOrders'
    ));
}

        public function orders()
    {
        $customer = Auth::user();

        $orders = Order::with('product')
            ->where('customer_id', $customer->getKey())
            ->where('order_type', 'normal')
            ->latest('order_date')
            ->get();

        return view('customer-dashboard.myorder', compact('orders'));
    }

    public function orderDetails($id)
    {
        $customer = Auth::user();

        $order = Order::with('product')
            ->where('order_id', $id)
            ->where('customer_id', $customer->getKey())
            ->where('order_type', 'normal')
            ->firstOrFail();

        return view('customer-dashboard.order_details', compact('order'));
    }

    public function favorites()
    {
        $customer = Auth::user();

        $favorites = Favorite::with('product')
            ->where('customer_id', $customer->getKey())
            ->latest()
            ->get();

        return view('customer-dashboard.favorites', compact('favorites'));
    }

    public function preorders()
    {
        $customer = Auth::user();

        $preorders = Order::with('product')
            ->where('customer_id', $customer->getKey())
            ->where('order_type', 'preorder')
            ->latest('order_date')
            ->get();

        return view('customer-dashboard.pre_orders', compact('preorders'));
    }

   public function createPreOrder(Request $request)
{
    $products = Product::with('category')
        ->where('status', 'active')
        ->orderBy('name')
        ->get();

    $selectedProduct = null;

    if ($request->filled('product_id')) {
        $selectedProduct = Product::with(['category', 'farmer', 'market'])
            ->where('product_id', $request->product_id)
            ->where('status', 'active')
            ->first();
    }

    return view(
        'customer-dashboard.create_pre_order',
        compact('products', 'selectedProduct')
    );
}

public function storePreOrder(Request $request)
{
    $validated = $request->validate([
        'product_id' => 'required|exists:products,product_id',
        'quantity' => 'required|integer|min:1',
        'pickup_date' => 'required|date|after_or_equal:today',
    ]);

    $product = Product::where('product_id', $validated['product_id'])
        ->where('status', 'active')
        ->firstOrFail();

    $totalAmount = $product->price * $validated['quantity'];

    Order::create([
        'customer_id' => Auth::id(),
        'product_id' => $product->product_id,
        'total_amount' => $totalAmount,
        'quantity' => $validated['quantity'],
        'order_status' => 'pending',
        'order_type' => 'preorder',
        'order_date' => now(),
        'pickup_date' => $validated['pickup_date'],
    ]);

    return redirect()
        ->route('pre.order')
        ->with('success', 'Pre-order placed successfully.');
}

    
    public function storeOrder(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($data) {
            $product = Product::where('product_id', $data['product_id'])->where('status', 'active')->lockForUpdate()->firstOrFail();
            if ($product->stock_quantity < $data['quantity']) {
                return back()->withErrors(['quantity' => 'Requested quantity is not available in stock.']);
            }
            $product->decrement('stock_quantity', $data['quantity']);
            Order::create([
                'customer_id' => auth()->id(),
                'product_id' => $product->product_id,
                'total_amount' => $product->price * $data['quantity'],
                'quantity' => $data['quantity'],
                'order_status' => 'pending',
                'order_type' => 'normal',
                'order_date' => now(),
            ]);
            return redirect()->route('myorders')->with('success', 'Order placed successfully.');
        });
    }

    public function toggleFavorite(Product $product)
    {
        $favorite = Favorite::where('customer_id', auth()->id())->where('product_id', $product->product_id)->first();
        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Product removed from favorites.');
        }
        Favorite::create(['customer_id' => auth()->id(), 'product_id' => $product->product_id, 'farmer_id' => $product->farmer_id]);
        return back()->with('success', 'Product added to favorites.');
    }


    public function reviews()
    {
        $customerId = Auth::id();

        $orderedProducts = Product::whereIn('product_id', Order::where('customer_id', $customerId)
                ->whereIn('order_status', ['confirmed', 'completed'])
                ->pluck('product_id'))
            ->orderBy('name')
            ->get();

        $reviews = Review::with('product')
            ->where('customer_id', $customerId)
            ->latest('review_date')
            ->get();

        return view('customer.reviews', compact('orderedProducts', 'reviews'));
    }

    public function storeReview(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:1000',
        ]);

        $hasBought = Order::where('customer_id', Auth::id())
            ->where('product_id', $data['product_id'])
            ->whereIn('order_status', ['confirmed', 'completed'])
            ->exists();

        if (!$hasBought) {
            return back()->withErrors(['product_id' => 'You can only review products you have ordered.'])->withInput();
        }

        Review::create($data + [
            'customer_id' => Auth::id(),
            'status' => 'active',
            'review_date' => now(),
        ]);

        return back()->with('success', 'Thank you! Your review has been submitted.');
    }
}
