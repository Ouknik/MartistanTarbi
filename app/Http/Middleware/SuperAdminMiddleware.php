<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('superadmin')->check()) {
            return redirect()->route('superadmin.login');
        }

        if (!Auth::guard('superadmin')->user()->is_active) {
            Auth::guard('superadmin')->logout();
            return redirect()->route('superadmin.login')
                           ->withErrors(['email' => 'حسابك غير مفعل']);
        }

        return $next($request);
    }
}
