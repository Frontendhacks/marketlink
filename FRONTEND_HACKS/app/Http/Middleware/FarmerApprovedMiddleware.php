<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Server-side gate for every protected farmer route.
 * Only farmers whose account is APPROVED and ACTIVE may pass.
 */
class FarmerApprovedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'farmer') {
            abort(403);
        }

        if (!$user->isApprovedFarmer()) {
            $message = $user->farmerBlockedMessage();

            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('farmer.login')->withErrors(['email' => $message]);
        }

        return $next($request);
    }
}
