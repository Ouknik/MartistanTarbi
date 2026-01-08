<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTenantAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = tenant();

        if (!$tenant) {
            abort(404, 'العيادة غير موجودة');
        }

        if (!$tenant->is_active) {
            abort(403, 'تم تعطيل هذه العيادة. يرجى التواصل مع الدعم الفني.');
        }

        if (!$tenant->canAccess()) {
            return redirect()->route('tenant.subscription.expired');
        }

        return $next($request);
    }
}
