<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, \Closure $next, ...$guards)
    {
        if ($request->is('login') || $request->is('*/login')) {
            return $next($request);
        }
        
        return parent::handle($request, $next, ...$guards);
    }
    
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // تحقق من أننا لسنا بالفعل في صفحة login
            if (!$request->is('login') && !$request->is('*/login')) {
                // إذا كان المسار يبدأ بـ superadmin، وجه إلى صفحة تسجيل دخول superadmin
                if ($request->is('superadmin/*') || $request->is('superadmin')) {
                    return route('superadmin.login');
                }
                return route('login');
            }
        }
        return null;
    }
}
