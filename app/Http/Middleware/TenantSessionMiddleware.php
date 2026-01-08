<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class TenantSessionMiddleware
{
    /**
     * Middleware لإعداد الجلسة الخاصة بكل Tenant
     * يجب تشغيله بعد InitializeTenancyByDomain وقبل StartSession
     */
    public function handle(Request $request, Closure $next)
    {
        if (tenancy()->initialized && tenant()) {
            $tenantId = tenant()->id;
            
            // استخدام file sessions بدلاً من database لتجنب مشاكل الاتصال
            $sessionPath = storage_path('framework/sessions/tenant_' . $tenantId);
            
            // إنشاء المجلد إذا لم يكن موجوداً
            if (!is_dir($sessionPath)) {
                mkdir($sessionPath, 0755, true);
            }
            
            Config::set('session.driver', 'file');
            Config::set('session.files', $sessionPath);
            
            // اسم cookie فريد لكل tenant
            $cookieName = 'tenant_' . $tenantId . '_session';
            Config::set('session.cookie', $cookieName);
            
            // Domain للـ cookie - استخدام null للسماح بالعمل على أي subdomain
            Config::set('session.domain', null);
            
            // تعيين same_site
            Config::set('session.same_site', 'lax');
            
            // تعيين secure = false للتطوير المحلي
            Config::set('session.secure', false);
            
            // تعيين http_only
            Config::set('session.http_only', true);
            
            // تعيين path
            Config::set('session.path', '/');
            
            Log::debug('TenantSessionMiddleware', [
                'tenant_id' => $tenantId,
                'session_path' => $sessionPath,
                'cookie_name' => $cookieName,
                'request_path' => $request->path(),
                'method' => $request->method(),
                'has_session_cookie' => $request->hasCookie($cookieName),
                'all_cookies' => array_keys($request->cookies->all()),
            ]);
        }
        
        return $next($request);
    }
}
