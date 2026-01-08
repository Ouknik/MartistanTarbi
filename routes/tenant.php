<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
| ترتيب الـ Middleware مهم جداً:
| 1. EncryptCookies - تشفير/فك تشفير الكوكيز
| 2. AddQueuedCookiesToResponse - إضافة الكوكيز للاستجابة
| 3. InitializeTenancyBySubdomain - تهيئة الـ Tenant (مهم قبل الجلسة!)
| 4. PreventAccessFromCentralDomains - منع الوصول من النطاقات المركزية
| 5. TenantSessionMiddleware - إعداد مسار الجلسة الخاص بالـ tenant
| 6. StartSession - بدء الجلسة
| 7. ShareErrorsFromSession - مشاركة الأخطاء
| 8. VerifyCsrfToken - التحقق من CSRF
| 9. SubstituteBindings - ربط المتغيرات
| 10. HandleInertiaRequests - معالجة Inertia
*/

Route::middleware([
    \App\Http\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
    \App\Http\Middleware\TenantSessionMiddleware::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \App\Http\Middleware\VerifyCsrfToken::class,
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
    \App\Http\Middleware\HandleInertiaRequests::class,
    \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
])->group(function () {
    Route::get('/', function () {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    });

    // Load Fortify routes for tenant authentication
    require base_path('vendor/laravel/fortify/routes/routes.php');
    
    // Load tenant-specific web routes
    require base_path('routes/web.php');
});
