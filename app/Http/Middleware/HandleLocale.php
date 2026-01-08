<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class HandleLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get locale from session, cookie, or default
        $locale = Session::get('locale', $request->cookie('locale', config('app.locale', 'ar')));
        
        // Validate locale
        $supportedLocales = ['ar', 'en', 'fr'];
        if (!in_array($locale, $supportedLocales)) {
            $locale = 'ar';
        }
        
        // Set application locale
        App::setLocale($locale);
        
        // Share translations with Inertia
        Inertia::share([
            'locale' => $locale,
            'translations' => $this->getTranslations($locale),
            'supportedLocales' => [
                'ar' => 'العربية',
                'en' => 'English',
                'fr' => 'Français',
            ],
        ]);
        
        return $next($request);
    }
    
    /**
     * Get translations for the current locale
     */
    protected function getTranslations(string $locale): array
    {
        $translations = [];
        
        // Load superadmin translations
        $file = lang_path("{$locale}/superadmin.php");
        if (file_exists($file)) {
            $superadmin = require $file;
            foreach ($superadmin as $key => $value) {
                $translations["superadmin.{$key}"] = $value;
            }
        }
        
        // Load validation translations
        $validationFile = lang_path("{$locale}/validation.php");
        if (file_exists($validationFile)) {
            $validation = require $validationFile;
            foreach ($validation as $key => $value) {
                if (is_string($value)) {
                    $translations["validation.{$key}"] = $value;
                }
            }
        }
        
        return $translations;
    }
}
