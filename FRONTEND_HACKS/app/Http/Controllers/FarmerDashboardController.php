<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Market;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FarmerDashboardController extends Controller
{
    public function index()
    {
        $farmerId = auth()->id();
        $productIds = Product::where('farmer_id', $farmerId)->pluck('product_id');
        $orders = Order::whereIn('product_id', $productIds);

        return view('farmer.dashboard', [
            'productCount' => Product::where('farmer_id', $farmerId)->count(),
            'stockCount' => Product::where('farmer_id', $farmerId)->sum('stock_quantity'),
            'pendingOrders' => (clone $orders)->where('order_status', 'pending')->count(),
            'reviewCount' => Review::whereIn('product_id', $productIds)->count(),
            'sales' => (clone $orders)->whereIn('order_status', ['confirmed', 'completed'])->sum('total_amount'),
            'recentOrders' => (clone $orders)->with(['customer', 'product'])->latest('order_date')->take(8)->get(),
        ]);
    }

    public function orders()
    {
        $orders = Order::with(['customer', 'product'])
            ->whereHas('product', fn($q) => $q->where('farmer_id', auth()->id()))
            ->latest('order_date')
            ->paginate(15);

        return view('farmer.order', compact('orders'));
    }

    public function customers()
    {
        $farmerId = auth()->id();
        $customers = User::whereHas('orders.product', fn($q) => $q->where('farmer_id', $farmerId))
            ->withCount(['orders as farmer_orders_count' => fn($q) => $q->whereHas('product', fn($p) => $p->where('farmer_id', $farmerId))])
            ->get();

        return view('farmer.customers', compact('customers'));
    }

    public function updateOrder(Request $request, Order $order)
    {
        abort_unless($order->product && $order->product->farmer_id === auth()->id(), 403);
        $order->update($request->validate(['order_status' => 'required|in:pending,confirmed,cancelled,completed']));

        return back()->with('success', 'Order status updated successfully.');
    }

    public function stock()
    {
        $products = Product::where('farmer_id', auth()->id())->with('category')->orderBy('name')->get();
        return view('farmer.stock', compact('products'));
    }

    public function reviews()
    {
        $reviews = Review::with(['customer', 'product'])
            ->whereHas('product', fn($q) => $q->where('farmer_id', auth()->id()))
            ->where('status', 'active')
            ->latest('review_date')
            ->paginate(10);

        return view('farmer.reviews', compact('reviews'));
    }

    public function replyReview(Request $request, Review $review)
    {
        abort_unless($review->product && $review->product->farmer_id === auth()->id(), 403);
        $review->update($request->validate(['farmer_reply' => 'required|string|max:1000']));

        return back()->with('success', 'Reply saved.');
    }

    public function categories()
    {
        $farmerId = auth()->id();
        $categories = Category::where('status', 'active')
            ->withCount(['products as my_products_count' => fn($q) => $q->where('farmer_id', $farmerId)])
            ->orderBy('name')
            ->get();

        return view('farmer.categories', compact('categories'));
    }

    public function markets()
    {
        $farmerId = auth()->id();
        $markets = Market::where('status', 'active')
            ->withCount(['products as my_products_count' => fn($q) => $q->where('farmer_id', $farmerId)])
            ->orderBy('market_name')
            ->get();
        $myMarketId = auth()->user()->farmerProfile?->market_id;

        return view('farmer.markets', compact('markets', 'myMarketId'));
    }

    public function profile()
    {
        $user = auth()->user()->load('farmerProfile.market');
        $markets = Market::where('status', 'active')->orderBy('market_name')->get();

        return view('farmer.profile', compact('user', 'markets'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'contact' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'stall_name' => 'required|string|max:100',
            'stall_description' => 'nullable|string|max:1000',
            'farm_type' => 'nullable|string|max:50',
            'farm_size' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'market_id' => 'required|exists:markets,market_id',
        ]);

        $user->update(collect($data)->only(['name', 'email', 'contact', 'address'])->all());
        $user->farmerProfile()->update(collect($data)->only(['stall_name', 'stall_description', 'farm_type', 'farm_size', 'city', 'market_id'])->all());

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => $request->password]); // hashed by the model cast

        return back()->with('success', 'Password updated successfully.');
    }
}
