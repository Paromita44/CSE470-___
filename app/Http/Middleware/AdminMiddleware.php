<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is an admin
        if (!auth()->user() || !auth()->user()->is_admin) {
            // Redirect to login page if not an admin
            return redirect()->route('login');
        }

        return $next($request); // Proceed with the request if the user is an admin
    }
}