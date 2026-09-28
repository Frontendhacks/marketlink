<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $admin = auth('admin')->user();

        if (!$admin || $admin->role !== 'admin' || $admin->status !== 'active') {
            auth('admin')->logout();
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
