<?php

namespace App\Http\Middleware;

use App\Models\Patient;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckResourceLimits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $resource)
    {
        // Only check for tenants
        if (!tenancy()->initialized) {
            return $next($request);
        }

        $tenant = tenant();
        $plan = $tenant->plan;

        // If no plan or unlimited plan (0 means unlimited)
        if (!$plan) {
            return $next($request);
        }

        switch ($resource) {
            case 'patients':
                return $this->checkPatientLimit($plan, $request, $next);
            
            case 'doctors':
                return $this->checkDoctorLimit($plan, $request, $next);
            
            case 'storage':
                return $this->checkStorageLimit($plan, $request, $next);
            
            default:
                return $next($request);
        }
    }

    /**
     * Check patient limit
     */
    protected function checkPatientLimit($plan, $request, $next)
    {
        // 0 means unlimited
        if ($plan->max_patients == 0) {
            return $next($request);
        }

        $currentCount = Patient::count();
        
        if ($currentCount >= $plan->max_patients) {
            return back()->withErrors([
                'limit' => "لقد وصلت إلى الحد الأقصى لعدد المرضى ({$plan->max_patients}) في خطة {$plan->name}. يرجى الترقية لخطة أعلى."
            ]);
        }

        // Warn when reaching 90% of limit
        if ($currentCount >= ($plan->max_patients * 0.9)) {
            session()->flash('warning', "تنبيه: لقد استخدمت {$currentCount} من {$plan->max_patients} مريض. يرجى النظر في الترقية قريباً.");
        }

        return $next($request);
    }

    /**
     * Check doctor limit
     */
    protected function checkDoctorLimit($plan, $request, $next)
    {
        // 0 means unlimited
        if ($plan->max_doctors == 0) {
            return $next($request);
        }

        $currentCount = User::where('type', 'docteur')->count();
        
        if ($currentCount >= $plan->max_doctors) {
            return back()->withErrors([
                'limit' => "لقد وصلت إلى الحد الأقصى لعدد الأطباء ({$plan->max_doctors}) في خطة {$plan->name}. يرجى الترقية لخطة أعلى."
            ]);
        }

        // Warn when reaching 90% of limit
        if ($currentCount >= ($plan->max_doctors * 0.9)) {
            session()->flash('warning', "تنبيه: لقد استخدمت {$currentCount} من {$plan->max_doctors} طبيب. يرجى النظر في الترقية قريباً.");
        }

        return $next($request);
    }

    /**
     * Check storage limit
     */
    protected function checkStorageLimit($plan, $request, $next)
    {
        // 0 means unlimited
        if ($plan->max_storage_mb == 0) {
            return $next($request);
        }

        // Calculate storage used (in MB)
        $storagePath = storage_path('app/tenant' . tenant()->getTenantKey());
        $storageUsedBytes = 0;

        if (is_dir($storagePath)) {
            $storageUsedBytes = $this->getDirectorySize($storagePath);
        }

        $storageUsedMB = round($storageUsedBytes / 1024 / 1024, 2);
        
        if ($storageUsedMB >= $plan->max_storage_mb) {
            return back()->withErrors([
                'limit' => "لقد وصلت إلى الحد الأقصى للتخزين ({$plan->max_storage_mb} MB) في خطة {$plan->name}. يرجى الترقية لخطة أعلى."
            ]);
        }

        // Warn when reaching 90% of limit
        if ($storageUsedMB >= ($plan->max_storage_mb * 0.9)) {
            session()->flash('warning', "تنبيه: لقد استخدمت {$storageUsedMB} MB من {$plan->max_storage_mb} MB. يرجى النظر في الترقية قريباً.");
        }

        return $next($request);
    }

    /**
     * Calculate directory size recursively
     */
    protected function getDirectorySize($path): int
    {
        $size = 0;
        
        if (!is_dir($path)) {
            return 0;
        }

        try {
            foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path)) as $file) {
                if ($file->isFile()) {
                    $size += $file->getSize();
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error calculating directory size: ' . $e->getMessage());
        }
        
        return $size;
    }
}

