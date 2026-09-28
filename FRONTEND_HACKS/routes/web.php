<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\FarmerDashboardController;
use App\Http\Controllers\ProductController;
use App\Models\FarmerProfile;
use App\Models\Market;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::with(['category', 'farmer', 'market'])->where('status', 'active')->latest('product_id')->take(12)->get();
    $markets = Market::where('status', 'active')->orderBy('market_name')->take(6)->get();
    $farmers = FarmerProfile::with(['farmer', 'market'])->where('status', 'approved')->take(6)->get();
    return view('customer.index', compact('products', 'markets', 'farmers'));
})->name('home');

Route::view('/about', 'customer.about')->name('about');
Route::view('/contact', 'customer.contact')->name('contact');
Route::get('/account', fn() => view('Account.userlogin'))->name('userlogin');

Route::get('/markets', function () {
    $markets = Market::where('status', 'active')->withCount('products')->orderBy('market_name')->get();
    return view('customer.markets', compact('markets'));
})->name('markets');

Route::get('/market/{id}', function ($id) {
    $market = Market::with(['products.farmer', 'farmerProfiles.farmer'])->where('market_id', $id)->where('status', 'active')->firstOrFail();
    return view('customer.market_details', compact('market'));
})->whereNumber('id')->name('market.details');

Route::get('/farmers', function () {
    $farmers = FarmerProfile::with(['farmer', 'market'])->where('status', 'approved')->get();
    return view('customer.farmers', compact('farmers'));
})->name('farmers');

Route::get('/farmer/{id}', function ($id) {
    $farmer = FarmerProfile::with(['farmer', 'market'])->where('farmer_id', $id)->where('status', 'approved')->firstOrFail();
    $products = Product::with(['category', 'market'])->where('farmer_id', $id)->where('status', 'active')->get();
    return view('customer.farmer_details', compact('farmer', 'products'));
})->whereNumber('id')->name('farmer.details');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{id}', function ($id) {
    $product = Product::with(['category', 'farmer', 'market', 'reviews.customer'])->where('product_id', $id)->where('status', 'active')->firstOrFail();
    return view('customer.products_details', compact('product'));
})->whereNumber('id')->name('product.details');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/register/{type}', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::get('/admin/register', [AuthController::class, 'showAdminRegister'])->name('admin.register');
    Route::post('/admin/register', [AuthController::class, 'adminRegister'])->name('admin.register.store');
    Route::get('/farmer/register', [AuthController::class, 'showFarmerRegister'])->name('farmer.register');
    Route::post('/farmer/register', [AuthController::class, 'farmerRegister'])->name('farmer.register.store');
    Route::get('/farmer/login', fn() => view('farmer.login'))->name('farmer.login');
    Route::post('/farmer/login', [AuthController::class, 'farmerLogin'])->name('farmer.login.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/favorites', [CustomerDashboardController::class, 'favorites'])->name('favorites');
    Route::post('/favorites/{product}', [CustomerDashboardController::class, 'toggleFavorite'])->name('favorites.toggle');
    Route::get('/pre-order', [CustomerDashboardController::class, 'preorders'])->name('pre.order');
    Route::get('/pre-order/create', [CustomerDashboardController::class, 'createPreOrder'])->name('pre.order.create');
    Route::post('/pre-order', [CustomerDashboardController::class, 'storePreOrder'])->name('pre.order.store');
    Route::post('/orders', [CustomerDashboardController::class, 'storeOrder'])->name('orders.store');
    Route::get('/my-orders', [CustomerDashboardController::class, 'orders'])->name('myorders');
    Route::get('/my-orders/{id}', [CustomerDashboardController::class, 'orderDetails'])->name('myorders.details');
    Route::get('/reviews', [CustomerDashboardController::class, 'reviews'])->name('reviews');
    Route::post('/reviews', [CustomerDashboardController::class, 'storeReview'])->name('reviews.store');
    Route::get('/profile', fn() => view('customer-dashboard.profile'))->name('profile');
    Route::get('/account-settings', fn() => view('customer-dashboard.account_settings'))->name('account.settings');
    Route::put('/account-settings/profile', [AuthController::class, 'updateProfile'])->name('account.profile.update');
    Route::put('/account-settings/password', [AuthController::class, 'changePassword'])->name('account.password.update');
});

Route::middleware(['auth', 'role:farmer', 'farmer.approved'])->prefix('farmer')->name('farmer.')->group(function () {
    Route::get('/dashboard', [FarmerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'farmerProducts'])->name('products');
    Route::post('/products', [ProductController::class, 'storeFarmerProduct'])->name('products.store');
    Route::put('/products/{id}', [ProductController::class, 'updateFarmerProduct'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroyFarmerProduct'])->name('products.destroy');
    Route::get('/stock', [FarmerDashboardController::class, 'stock'])->name('stock');
    Route::get('/orders', [FarmerDashboardController::class, 'orders'])->name('orders');
    Route::patch('/orders/{order}', [FarmerDashboardController::class, 'updateOrder'])->name('orders.update');
    Route::get('/customers', [FarmerDashboardController::class, 'customers'])->name('customers');
    Route::get('/reviews', [FarmerDashboardController::class, 'reviews'])->name('reviews');
    Route::put('/reviews/{review}/reply', [FarmerDashboardController::class, 'replyReview'])->name('reviews.reply');
    Route::get('/categories', [FarmerDashboardController::class, 'categories'])->name('categories');
    Route::get('/markets', [FarmerDashboardController::class, 'markets'])->name('markets');
    Route::get('/profile', [FarmerDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [FarmerDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [FarmerDashboardController::class, 'updatePassword'])->name('profile.password');
});

Route::post('/farmer/logout', [AuthController::class, 'farmerLogout'])->middleware('auth')->name('farmer.logout');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
    Route::get('/customers/{user}', [AdminController::class, 'customerDetails'])->name('customer.details');
    Route::post('/customers', [AdminController::class, 'storeCustomer'])->name('customers.store');
    Route::put('/customers/{user}', [AdminController::class, 'updateCustomer'])->name('customers.update');
    Route::delete('/customers/{user}', [AdminController::class, 'destroyCustomer'])->name('customers.destroy');
    Route::get('/farmers', [AdminController::class, 'farmers'])->name('farmers');
    Route::get('/farmers/{user}', [AdminController::class, 'farmerDetails'])->name('farmer.details');
    Route::post('/farmers/{user}/deactivate', [AdminController::class, 'deactivateFarmer'])->name('farmers.deactivate');
    Route::post('/farmers/{user}/approve', [AdminController::class, 'approveFarmer'])->name('farmers.approve');
    Route::post('/farmers/{user}/reject', [AdminController::class, 'rejectFarmer'])->name('farmers.reject');
    Route::post('/farmers/{user}/reactivate', [AdminController::class, 'reactivateFarmer'])->name('farmers.reactivate');
    Route::put('/farmers/{user}', [AdminController::class, 'updateFarmer'])->name('farmers.update');
    Route::delete('/farmers/{user}', [AdminController::class, 'destroyFarmer'])->name('farmers.destroy');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('products.destroy');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');
    Route::get('/markets', [AdminController::class, 'markets'])->name('markets');
    Route::post('/markets', [AdminController::class, 'storeMarket'])->name('markets.store');
    Route::put('/markets/{market}', [AdminController::class, 'updateMarket'])->name('markets.update');
    Route::delete('/markets/{market}', [AdminController::class, 'destroyMarket'])->name('markets.destroy');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::patch('/orders/{order}', [AdminController::class, 'updateOrder'])->name('orders.update');
    Route::delete('/orders/{order}', [AdminController::class, 'destroyOrder'])->name('orders.destroy');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::put('/settings/profile', [AdminController::class, 'updateSettings'])->name('settings.profile');
    Route::put('/settings/password', [AdminController::class, 'updatePassword'])->name('settings.password');
});

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.store');
Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
Route::get('/admin', fn() => redirect()->route('admin.dashboard'));
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
