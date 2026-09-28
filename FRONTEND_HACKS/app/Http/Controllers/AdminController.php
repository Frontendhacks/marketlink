<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FarmerProfile;
use App\Models\Market;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalCustomers' => User::where('role', 'customer')->count(),
            'totalFarmers' => User::where('role', 'farmer')->count(),
            'pendingFarmers' => User::where('role', 'farmer')->where('approval_status', 'pending')->count(),
            'approvedFarmers' => User::where('role', 'farmer')->where('approval_status', 'approved')->count(),
            'totalProducts' => Product::count(),
            'activeProducts' => Product::where('status', 'active')->count(),
            'totalCategories' => Category::count(),
            'totalMarkets' => Market::count(),
            'totalOrders' => Order::count(),
            'pendingOrders' => Order::where('order_status', 'pending')->count(),
            'sales' => Order::whereIn('order_status', ['confirmed', 'completed'])->sum('total_amount'),
            'recentOrders' => Order::with(['customer', 'product.farmer'])->latest('order_date')->take(8)->get(),
            'pendingRequests' => FarmerProfile::with(['farmer', 'market'])->whereHas('farmer', fn($q) => $q->where('approval_status', 'pending'))->latest()->take(8)->get(),
        ]);
    }

    public function customers()
    {
        $customers = User::where('role', 'customer')->withCount('orders')->latest()->get();
        return view('admin.customers', compact('customers'));
    }

    public function customerDetails(User $user)
    {
        abort_unless($user->role === 'customer', 404);
        $user->load(['orders.product.farmer']);
        return view('admin.customer_details', compact('user'));
    }

    public function storeCustomer(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'contact' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:500',
            'password' => 'required|string|min:8',
            'status' => 'required|in:active,suspended',
        ]);
        $data['role'] = 'customer';
        $data['password'] = Hash::make($data['password']);
        $data['approval_status'] = 'approved';
        User::create($data);
        return back()->with('success', 'Customer created successfully.');
    }

    public function updateCustomer(Request $request, User $user)
    {
        abort_unless($user->role === 'customer', 404);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'contact' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:active,suspended',
        ]);
        $user->update($data);
        return back()->with('success', 'Customer updated successfully.');
    }

    public function destroyCustomer(User $user)
    {
        abort_unless($user->role === 'customer', 404);
        $user->delete();
        return back()->with('success', 'Customer deleted successfully.');
    }

    public function farmers(Request $request)
    {
        $status = $request->input('status');
        $search = trim((string) $request->input('q'));

        $query = User::where('role', 'farmer')
            ->with(['farmerProfile.market'])
            ->withCount('products')
            ->when(in_array($status, User::FARMER_STATUSES, true), fn($q) => $q->where('approval_status', $status))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($w) use ($search) {
                    $w->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('contact', 'like', "%{$search}%")
                      ->orWhereHas('farmerProfile', fn($p) => $p->where('stall_name', 'like', "%{$search}%")->orWhere('city', 'like', "%{$search}%"));
                });
            })
            ->latest();

        $farmers = $query->paginate(10)->withQueryString();

        $counts = User::where('role', 'farmer')
            ->selectRaw('approval_status, COUNT(*) as total')
            ->groupBy('approval_status')
            ->pluck('total', 'approval_status');

        $stats = [
            'total' => (int) $counts->sum(),
            'pending' => (int) ($counts['pending'] ?? 0),
            'approved' => (int) ($counts['approved'] ?? 0),
            'rejected' => (int) ($counts['rejected'] ?? 0),
            'inactive' => (int) ($counts['inactive'] ?? 0),
        ];

        $markets = Market::where('status', 'active')->orderBy('market_name')->get();

        return view('admin.farmers', compact('farmers', 'stats', 'status', 'search', 'markets'));
    }

    public function farmerDetails(User $user)
    {
        abort_unless($user->role === 'farmer', 404);
        $user->load(['farmerProfile.market', 'products.category', 'products.market']);
        $orders = Order::with(['customer', 'product'])
            ->whereHas('product', fn($q) => $q->where('farmer_id', $user->id))
            ->latest('order_date')->get();
        return view('admin.farmer_details', compact('user', 'orders'));
    }

    public function updateFarmer(Request $request, User $user)
    {
        abort_unless($user->role === 'farmer', 404);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'contact' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'stall_name' => 'required|string|max:100',
            'city' => 'nullable|string|max:100',
            'market_id' => 'required|exists:markets,market_id',
        ]);

        DB::transaction(function () use ($user, $data) {
            $user->update(collect($data)->only(['name', 'email', 'contact', 'address'])->all());
            FarmerProfile::updateOrCreate(
                ['farmer_id' => $user->id],
                collect($data)->only(['stall_name', 'city', 'market_id'])->all()
            );
        });

        return back()->with('success', 'Farmer updated successfully.');
    }

    /** Central place that keeps users.approval_status, users.status and farmer_profiles.status in sync. */
    private function setFarmerStatus(User $user, string $status): void
    {
        abort_unless($user->role === 'farmer', 404);

        $profileStatus = $status === 'approved' ? 'approved' : ($status === 'pending' ? 'pending' : 'suspended');
        $accountStatus = in_array($status, ['approved', 'pending'], true) ? 'active' : 'suspended';

        DB::transaction(function () use ($user, $status, $profileStatus, $accountStatus) {
            $profile = $user->farmerProfile;
            if ($profile) {
                $profile->update(['status' => $profileStatus]);
            } else {
                FarmerProfile::create([
                    'farmer_id' => $user->id,
                    'market_id' => Market::orderBy('market_id')->value('market_id'),
                    'stall_name' => $user->name . ' Farm',
                    'status' => $profileStatus,
                ]);
            }
            $user->update(['approval_status' => $status, 'status' => $accountStatus]);
        });
    }

    public function approveFarmer(User $user)
    {
        $this->setFarmerStatus($user, 'approved');
        return back()->with('success', $user->name . ' has been approved and can now log in to the Farmer Dashboard.');
    }

    public function rejectFarmer(User $user)
    {
        $this->setFarmerStatus($user, 'rejected');
        return back()->with('success', $user->name . ' has been rejected. Dashboard access is blocked.');
    }

    public function deactivateFarmer(User $user)
    {
        $this->setFarmerStatus($user, 'inactive');
        return back()->with('success', $user->name . ' has been deactivated. Dashboard access is blocked.');
    }

    public function reactivateFarmer(User $user)
    {
        $this->setFarmerStatus($user, 'approved');
        return back()->with('success', $user->name . ' has been re-approved.');
    }

    public function destroyFarmer(User $user)
    {
        abort_unless($user->role === 'farmer', 404);
        $user->delete();
        return back()->with('success', 'Farmer deleted successfully.');
    }

    public function products(Request $request)
    {
        $search = trim((string) $request->input('q'));
        $status = $request->input('status');
        $categoryId = $request->input('category');

        $products = Product::with(['farmer', 'category', 'market'])
            ->when($search !== '', fn($q) => $q->where(function ($w) use ($search) {
                $w->where('name', 'like', "%{$search}%")
                  ->orWhereHas('farmer', fn($f) => $f->where('name', 'like', "%{$search}%"));
            }))
            ->when(in_array($status, ['active', 'inactive'], true), fn($q) => $q->where('status', $status))
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->latest('product_id')
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => Product::count(),
            'active' => Product::where('status', 'active')->count(),
            'inactive' => Product::where('status', 'inactive')->count(),
            'out_of_stock' => Product::where('stock_quantity', 0)->count(),
        ];

        $farmers = User::where('role', 'farmer')->where('approval_status', 'approved')->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $markets = Market::orderBy('market_name')->get();

        return view('admin.products', compact('products', 'stats', 'farmers', 'categories', 'markets', 'search', 'status', 'categoryId'));
    }

    public function storeProduct(Request $request)
    {
        $data = $this->validateProduct($request);
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('products', 'public');
        Product::create($data);
        return back()->with('success', 'Product created successfully.');
    }

    public function updateProduct(Request $request, Product $product)
    {
        $data = $this->validateProduct($request);
        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($data);
        return back()->with('success', 'Product updated successfully.');
    }

    public function destroyProduct(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }

    private function validateProduct(Request $request): array
    {
        return $request->validate([
            'farmer_id' => ['required', \Illuminate\Validation\Rule::exists('users', 'id')->where('role', 'farmer')],
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
    }

    public function categories()
    {
        $categories = Category::withCount('products')->orderBy('name')->get();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        Category::create($request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]));
        return back()->with('success', 'Category created successfully.');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->category_id . ',category_id',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);
        $category->update($data);
        return back()->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(Category $category)
    {
        if ($category->products()->exists()) return back()->withErrors(['category' => 'Delete or move its products first.']);
        $category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }

    public function markets()
    {
        $markets = Market::withCount(['products', 'farmerProfiles'])->orderBy('market_name')->get();
        return view('admin.markets', compact('markets'));
    }

    public function storeMarket(Request $request)
    {
        Market::create($request->validate([
            'market_name' => 'required|string|max:100',
            'address' => 'required|string',
            'day' => 'required|string|max:20',
            'timing' => 'required|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'map_provider' => 'nullable|string|max:30',
            'status' => 'required|in:active,inactive',
        ]));
        return back()->with('success', 'Market created successfully.');
    }

    public function updateMarket(Request $request, Market $market)
    {
        $market->update($request->validate([
            'market_name' => 'required|string|max:100',
            'address' => 'required|string',
            'day' => 'required|string|max:20',
            'timing' => 'required|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'map_provider' => 'nullable|string|max:30',
            'status' => 'required|in:active,inactive',
        ]));
        return back()->with('success', 'Market updated successfully.');
    }

    public function destroyMarket(Market $market)
    {
        if ($market->products()->exists() || $market->farmerProfiles()->exists()) return back()->withErrors(['market' => 'This market is in use and cannot be deleted.']);
        $market->delete();
        return back()->with('success', 'Market deleted successfully.');
    }

    public function orders(Request $request)
    {
        $search = trim((string) $request->input('q'));
        $status = $request->input('status');

        $orders = Order::with(['customer', 'product.farmer'])
            ->when($search !== '', fn($q) => $q->where(function ($w) use ($search) {
                $w->where('order_id', ltrim($search, '#'))
                  ->orWhereHas('customer', fn($c) => $c->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"))
                  ->orWhereHas('product', fn($p) => $p->where('name', 'like', "%{$search}%"));
            }))
            ->when(in_array($status, ['pending', 'confirmed', 'completed', 'cancelled'], true), fn($q) => $q->where('order_status', $status))
            ->latest('order_date')
            ->paginate(12)
            ->withQueryString();

        $stats = [
            'total' => Order::count(),
            'pending' => Order::where('order_status', 'pending')->count(),
            'completed' => Order::where('order_status', 'completed')->count(),
            'revenue' => Order::whereIn('order_status', ['confirmed', 'completed'])->sum('total_amount'),
        ];

        return view('admin.orders', compact('orders', 'stats', 'search', 'status'));
    }

    public function reports()
    {
        $orders = Order::whereIn('order_status', ['confirmed', 'completed'])->get(['order_date', 'total_amount']);
        $revenueByMonth = $orders->groupBy(fn($o) => $o->order_date->format('Y-m'))
            ->map(fn($g) => (float) $g->sum('total_amount'))
            ->sortKeys()->take(-12);

        $topProducts = Product::withCount('orders')->withSum('orders as revenue', 'total_amount')
            ->orderByDesc('orders_count')->take(8)->get();
        $topFarmers = User::where('role', 'farmer')->with('farmerProfile')->get()
            ->map(function ($f) {
                $ids = Product::where('farmer_id', $f->id)->pluck('product_id');
                $f->orders_total = Order::whereIn('product_id', $ids)->whereIn('order_status', ['confirmed', 'completed'])->count();
                $f->revenue_total = (float) Order::whereIn('product_id', $ids)->whereIn('order_status', ['confirmed', 'completed'])->sum('total_amount');
                return $f;
            })->sortByDesc('revenue_total')->take(8)->values();

        $ordersByStatus = Order::selectRaw('order_status, COUNT(*) as total')->groupBy('order_status')->pluck('total', 'order_status');
        $categories = Category::withCount('products')->orderByDesc('products_count')->get();

        return view('admin.reports', [
            'revenueByMonth' => $revenueByMonth,
            'topProducts' => $topProducts,
            'topFarmers' => $topFarmers,
            'ordersByStatus' => $ordersByStatus,
            'categories' => $categories,
            'totalRevenue' => (float) $orders->sum('total_amount'),
            'totalOrders' => Order::count(),
            'totalCustomers' => User::where('role', 'customer')->count(),
            'totalFarmers' => User::where('role', 'farmer')->where('approval_status', 'approved')->count(),
        ]);
    }

    public function updateOrder(Request $request, Order $order)
    {
        $order->update($request->validate(['order_status' => 'required|in:pending,confirmed,cancelled,completed']));
        return back()->with('success', 'Order status updated successfully.');
    }

    public function destroyOrder(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order deleted successfully.');
    }

    public function settings()
    {
        $admin = auth('admin')->user();
        return view('admin.settings', compact('admin'));
    }

    public function updateSettings(Request $request)
    {
        $admin = auth('admin')->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'contact' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:500',
        ]);
        $admin->update($data);
        return back()->with('success', 'Admin profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate(['current_password' => 'required', 'password' => 'required|min:8|confirmed']);
        $admin = auth('admin')->user();
        if (!Hash::check($request->current_password, $admin->password)) return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        $admin->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Password updated successfully.');
    }
}
