<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    /**
     * Switch the application locale
     */
    public function switch(Request $request, string $locale)
    {
        $supportedLocales = ['ar', 'en', 'fr'];
        
        if (!in_array($locale, $supportedLocales)) {
            $locale = 'ar';
        }
        
        // Store in session
        Session::put('locale', $locale);
        Session::save(); // Force save session
        
        // Set application locale
        App::setLocale($locale);
        
        // Get the redirect URL - use referer if available, otherwise try to redirect to a sensible default
        $referer = $request->headers->get('referer');
        
        // Determine where to redirect
        if ($referer) {
            $redirectUrl = $referer;
        } else {
            // Check if this is a superadmin request
            $currentHost = $request->getHost();
            $centralDomains = config('tenancy.central_domains', ['maristan.local']);
            
            if (in_array($currentHost, $centralDomains)) {
                // For central domain, redirect to superadmin dashboard
                $redirectUrl = url('/superadmin/dashboard');
            } else {
                // For tenant domains, redirect to patients
                $redirectUrl = url('/patients');
            }
        }
        
        // Return with cookie for persistence
        return redirect($redirectUrl)->withCookie(
            cookie('locale', $locale, 60 * 24 * 365) // 1 year
        );
    }
}
