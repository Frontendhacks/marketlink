<?php

use App\Models\Category;
use App\Models\Market;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

function makeMarket(): Market
{
    return Market::create([
        'market_name' => 'Test Market', 'address' => 'Karachi', 'day' => 'Monday',
        'timing' => '8-5', 'map_provider' => 'OpenStreetMap', 'status' => 'active',
    ]);
}

function makeAdmin(): User
{
    return User::create([
        'name' => 'Admin', 'email' => 'admin@test.com', 'contact' => '0300', 'address' => 'x',
        'password' => Hash::make('secret123'), 'role' => 'admin', 'status' => 'active', 'approval_status' => 'approved',
    ]);
}

function registerFarmer(Market $market, string $email = 'farmer@test.com')
{
    return test()->post(route('farmer.register.store'), [
        'name' => 'Test Farmer', 'contact' => '03001234567', 'email' => $email,
        'address' => 'Village road', 'farm_name' => 'Green Farm', 'farm_type' => 'Vegetable',
        'city' => 'Karachi', 'farm_size' => '5 acres', 'market_id' => $market->market_id,
        'password' => 'password123', 'password_confirmation' => 'password123',
    ]);
}

it('registers a farmer as pending and blocks login and dashboard access', function () {
    $market = makeMarket();

    registerFarmer($market)->assertRedirect(route('farmer.login'));

    $farmer = User::where('email', 'farmer@test.com')->firstOrFail();
    expect($farmer->approval_status)->toBe('pending')
        ->and($farmer->farmerProfile->status)->toBe('pending');

    $this->post(route('farmer.login.store'), ['email' => 'farmer@test.com', 'password' => 'password123'])
        ->assertSessionHasErrors('email');
    $this->assertGuest();

    // Even a forced session must be rejected by the middleware on every protected URL.
    foreach (['farmer.dashboard', 'farmer.products', 'farmer.orders', 'farmer.profile'] as $name) {
        $this->actingAs($farmer)->get(route($name))->assertRedirect(route('farmer.login'));
        $this->post(route('farmer.logout'));
    }
});

it('lets an approved farmer in after admin approval and blocks again when deactivated', function () {
    $market = makeMarket();
    $admin = makeAdmin();
    registerFarmer($market);
    $farmer = User::where('email', 'farmer@test.com')->firstOrFail();

    $this->actingAs($admin, 'admin')->post(route('admin.farmers.approve', $farmer))->assertSessionHas('success');
    $this->post(route('admin.logout'));

    expect($farmer->fresh()->approval_status)->toBe('approved');

    $this->post(route('farmer.login.store'), ['email' => 'farmer@test.com', 'password' => 'password123'])
        ->assertRedirect(route('farmer.dashboard'));
    $this->get(route('farmer.dashboard'))->assertOk();
    $this->post(route('farmer.logout'));

    $this->actingAs($admin, 'admin')->post(route('admin.farmers.deactivate', $farmer))->assertSessionHas('success');
    $this->post(route('admin.logout'));

    $this->post(route('farmer.login.store'), ['email' => 'farmer@test.com', 'password' => 'password123'])
        ->assertSessionHasErrors('email');
});

it('blocks rejected farmers', function () {
    $market = makeMarket();
    $admin = makeAdmin();
    registerFarmer($market);
    $farmer = User::where('email', 'farmer@test.com')->firstOrFail();

    $this->actingAs($admin, 'admin')->post(route('admin.farmers.reject', $farmer));
    expect($farmer->fresh()->approval_status)->toBe('rejected');

    $this->post(route('farmer.login.store'), ['email' => 'farmer@test.com', 'password' => 'password123'])
        ->assertSessionHasErrors('email');
});

it('stops a farmer from editing another farmer\'s product', function () {
    $market = makeMarket();
    $admin = makeAdmin();
    $category = Category::create(['name' => 'Fruits', 'status' => 'active']);

    registerFarmer($market, 'a@test.com');
    registerFarmer($market, 'b@test.com');
    $a = User::where('email', 'a@test.com')->first();
    $b = User::where('email', 'b@test.com')->first();
    $this->actingAs($admin, 'admin')->post(route('admin.farmers.approve', $a));
    $this->actingAs($admin, 'admin')->post(route('admin.farmers.approve', $b));

    $product = Product::create([
        'farmer_id' => $b->id, 'category_id' => $category->category_id, 'market_id' => $market->market_id,
        'name' => 'Apples', 'price' => 100, 'stock_quantity' => 5, 'available_day' => 'Monday', 'status' => 'active',
    ]);

    $this->actingAs($a->fresh())->put(route('farmer.products.update', $product->product_id), [
        'category_id' => $category->category_id, 'market_id' => $market->market_id, 'name' => 'Hacked',
        'price' => 1, 'stock_quantity' => 1, 'available_day' => 'Monday', 'status' => 'active',
    ])->assertNotFound();

    expect($product->fresh()->name)->toBe('Apples');
});

it('keeps non-admins out of the admin area', function () {
    $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
    $customer = User::create([
        'name' => 'C', 'email' => 'c@test.com', 'contact' => '1', 'password' => Hash::make('password123'),
        'role' => 'customer', 'status' => 'active', 'approval_status' => 'approved',
    ]);
    $this->actingAs($customer)->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
});
