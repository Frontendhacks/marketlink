<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\FarmerProfile;
use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('customer.register');
    }

    public function showFarmerRegister()
    {
        $markets = Market::where('status', 'active')->orderBy('market_name')->get();
        return view('farmer.register', compact('markets'));
    }

    public function showRegisterForm($type)
{
    if ($type === 'farmer' || $type === 'farmhub') {
        return redirect()->route('farmer.register');
    }

    if ($type === 'admin') {
        return redirect()->route('admin.register');
    }

    return redirect()->route('register');
}

public function showAdminRegister()
{
    return view('admin.register');
}


public function register(Request $request, $type = 'customer')
{
    if ($type === 'admin') {
        return $this->adminRegister($request);
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'contact' => 'required|string|max:30',
        'email' => 'required|email|unique:users,email',
        'address' => 'nullable|string|max:500',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'contact' => $request->contact,
        'email' => $request->email,
        'address' => $request->address,
        'password' => Hash::make($request->password),
        'role' => 'customer',
        'status' => 'active',
        'approval_status' => 'approved',
    ]);

    Auth::login($user);
    return redirect()->route('customer.dashboard');
}

public function adminRegister(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'contact' => 'required|string|max:30',
        'email' => 'required|email|unique:users,email',
        'address' => 'required|string|max:500',
        'password' => 'required|string|min:8|confirmed',
    ]);

    User::create([
        'name' => $data['name'],
        'contact' => $data['contact'],
        'email' => $data['email'],
        'address' => $data['address'],
        'password' => Hash::make($data['password']),
        'role' => 'admin',
        'status' => 'active',
        'approval_status' => 'approved',
    ]);

    return redirect()->route('admin.login')->with('success', 'Admin account created successfully. Please login to continue.');
}

public function farmerRegister(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'contact' => 'required|string|max:30',
        'email' => 'required|email|unique:users,email',
        'address' => 'nullable|string|max:500',
        'farm_name' => 'required|string|max:100',
        'farm_type' => 'required|string|max:50',
        'city' => 'required|string|max:100',
        'farm_size' => 'required|string|max:100',
        'market_id' => 'required|exists:markets,market_id',
        'password' => 'required|string|min:8|confirmed',
    ]);

    DB::transaction(function () use ($data) {
        $user = User::create([
            'name' => $data['name'],
            'contact' => $data['contact'],
            'email' => $data['email'],
            'address' => !empty($data['address'])
    ? $data['address']
    : (($data['city'] ?? '') . ', Pakistan'),
            'password' => Hash::make($data['password']),
            'role' => 'farmer',
            'status' => 'active',
            'approval_status' => 'pending',
        ]);

        FarmerProfile::create([
            'farmer_id' => $user->id,
            'market_id' => $data['market_id'],
            'stall_name' => $data['farm_name'],
            'stall_description' => $data['farm_type'],
            'farm_type' => $data['farm_type'],
            'farm_size' => $data['farm_size'],
            'city' => $data['city'],
            'status' => 'pending',
        ]);
    });

    return redirect()->route('farmer.login')->with('success', 'Your registration has been submitted and is waiting for admin approval.');
}

public function farmerLogin(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $credentials['email'])->where('role', 'farmer')->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return back()->withErrors(['email' => 'The email or password is incorrect.'])->onlyInput('email');
    }

    if (!$user->isApprovedFarmer()) {
        return back()->withErrors(['email' => $user->farmerBlockedMessage()])->onlyInput('email');
    }

    Auth::login($user, $request->boolean('remember'));
    $request->session()->regenerate();

    return redirect()->intended(route('farmer.dashboard'));
}

public function farmerLogout(Request $request)
{
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('farmer.login')->with('success', 'You have been logged out.');
}

    public function showLogin()
    {
        return view('customer.login');
    }

    public function showAdminLogin()
{
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }

    return view('admin.login');
}

public function adminLogin(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $admin = User::where('email', $credentials['email'])
        ->where('role', 'admin')
        ->first();

    if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
        return back()
            ->withErrors([
                'email' => 'The email or password is incorrect.',
            ])
            ->onlyInput('email');
    }

    if ($admin->status !== 'active') {
        return back()
            ->withErrors([
                'email' => 'This admin account is not active.',
            ])
            ->onlyInput('email');
    }

    Auth::guard('admin')->login(
        $admin,
        $request->boolean('remember')
    );

    $request->session()->regenerate();

    return redirect()->route('admin.dashboard');
}

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'The email or password is incorrect.'])->onlyInput('email');
        }

        if ($user->role === 'farmer') {
            return back()->withErrors(['email' => 'Farmers must use the Farmer Login page.'])->onlyInput('email');
        }

        if ($user->role === 'admin') {
            return back()->withErrors(['email' => 'Administrators must use the Admin Login page.'])->onlyInput('email');
        }

        if ($user->status !== 'active') {
            return back()->withErrors(['email' => 'Your account is not active.'])->onlyInput('email');
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('customer.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function adminLogout(Request $request)
{
    Auth::guard('admin')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
}

    public function updateProfile(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'contact' => 'nullable|string|max:30',
        'address' => 'nullable|string|max:500',
    ]);

    $user->update($validated);

    return back()->with('success', 'Profile updated successfully.');
}

public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors([
            'current_password' => 'Current password is incorrect.',
        ]);
    }

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Password updated successfully.');
}


    private function redirectByRole($user)
    {return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'farmer' => redirect()->route('farmer.dashboard'),
        'customer' => redirect()->route('customer.dashboard'),
         default => redirect()->route('home'),
        };
    }
}
