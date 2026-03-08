<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if ($request->user()->role !== $role) {

            // si el usuario es cliente
            if ($request->user()->role === 'client') {
                return redirect()->route('client.dashboard');
            }

            // si es admin
            if ($request->user()->role === 'admin') {
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}