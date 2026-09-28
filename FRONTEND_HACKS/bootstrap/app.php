<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'farmer.approved' => \App\Http\Middleware\FarmerApprovedMiddleware::class,
        ]);

        // Unauthenticated visitors are sent to the login page that matches the area they tried to open.
        $middleware->redirectGuestsTo(function ($request) {
            if ($request->is('farmer', 'farmer/*')) {
                return route('farmer.login');
            }
            return route('login');
        });

        // Already-logged-in users are sent to their own dashboard.
        $middleware->redirectUsersTo(function ($request) {
            $user = $request->user();
            return match ($user?->role) {
                'farmer' => route('farmer.dashboard'),
                'customer' => route('customer.dashboard'),
                default => route('home'),
            };
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
