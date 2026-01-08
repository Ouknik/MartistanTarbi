<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/patients';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            // Central domain routes only (not tenant subdomains)
            foreach ($this->centralDomains() as $domain) {
                Route::middleware('api')
                    ->domain($domain)
                    ->prefix('api')
                    ->group(base_path('routes/api.php'));

                Route::middleware('web')
                    ->domain($domain)
                    ->group(base_path('routes/web.php'));

                // Super Admin Routes
                Route::middleware('web')
                    ->domain($domain)
                    ->prefix('superadmin')
                    ->group(base_path('routes/superadmin.php'));
            }

            // Tenant subdomain routes
            // Routes are loaded without domain restriction, tenant identification 
            // is handled by InitializeTenancyBySubdomain middleware
            if (file_exists(base_path('routes/tenant.php'))) {
                Route::group([], base_path('routes/tenant.php'));
            }
        });
    }

    /**
     * Get the central domains for the application.
     * These are the domains where central routes should be loaded.
     *
     * @return array
     */
    protected function centralDomains(): array
    {
        return config('tenancy.central_domains', [
            'localhost',
        ]);
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
