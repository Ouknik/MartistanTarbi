<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    /**
     * Display tenant's current subscription details
     */
    public function index()
    {
        $tenant = tenancy()->tenant;
        
        // Get current active subscription
        $currentSubscription = Subscription::with('plan')
            ->where('tenant_id', $tenant->id)
            ->where('status', Subscription::STATUS_ACTIVE)
            ->latest()
            ->first();

        // Get subscription history
        $subscriptionHistory = Subscription::with('plan')
            ->where('tenant_id', $tenant->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get available plans for upgrade/downgrade
        $availablePlans = Plan::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Calculate usage statistics
        $usageStats = $this->getUsageStatistics($tenant, $currentSubscription);

        // Calculate days remaining
        $daysRemaining = $currentSubscription 
            ? now()->diffInDays($currentSubscription->ends_at, false) 
            : 0;

        // Check if in trial
        $isInTrial = $tenant->trial_ends_at && now()->lessThan($tenant->trial_ends_at);
        $trialDaysRemaining = $isInTrial 
            ? now()->diffInDays($tenant->trial_ends_at, false) 
            : 0;

        return Inertia::render('Tenant/Subscription/Index', [
            'currentSubscription' => $currentSubscription,
            'subscriptionHistory' => $subscriptionHistory,
            'availablePlans' => $availablePlans,
            'usageStats' => $usageStats,
            'daysRemaining' => $daysRemaining,
            'isInTrial' => $isInTrial,
            'trialDaysRemaining' => $trialDaysRemaining,
            'tenant' => [
                'name' => $tenant->name,
                'email' => $tenant->email,
                'is_active' => $tenant->is_active,
            ],
        ]);
    }

    /**
     * Show plan comparison page
     */
    public function comparePlans()
    {
        $tenant = tenancy()->tenant;
        
        $currentSubscription = Subscription::with('plan')
            ->where('tenant_id', $tenant->id)
            ->where('status', Subscription::STATUS_ACTIVE)
            ->latest()
            ->first();

        $plans = Plan::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('Tenant/Subscription/ComparePlans', [
            'plans' => $plans,
            'currentPlan' => $currentSubscription?->plan,
        ]);
    }

    /**
     * Request plan upgrade/downgrade
     * Note: Actual payment will be handled manually by SuperAdmin for now
     */
    public function requestPlanChange(Request $request)
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'period' => 'required|in:monthly,yearly',
            'message' => 'nullable|string|max:1000',
        ]);

        $tenant = tenancy()->tenant;
        $newPlan = Plan::findOrFail($validated['plan_id']);

        // Create a pending subscription request
        // This will be approved by SuperAdmin
        $subscription = Subscription::create([
            'tenant_id' => $tenant->id,
            'plan_id' => $newPlan->id,
            'status' => Subscription::STATUS_PENDING,
            'starts_at' => now(),
            'ends_at' => now()->addMonths($validated['period'] === 'monthly' ? 1 : 12),
            'amount' => $validated['period'] === 'monthly' 
                ? $newPlan->price_monthly 
                : $newPlan->price_yearly,
            'notes' => $validated['message'] ?? 'طلب تغيير الخطة من العيادة',
        ]);

        // TODO: Send notification to SuperAdmin
        // Notification::route('mail', config('mail.superadmin'))
        //     ->notify(new PlanChangeRequestNotification($tenant, $newPlan));

        return back()->with('success', __('tenant.subscription_request_submitted'));
    }

    /**
     * Display invoices/receipts
     */
    public function invoices()
    {
        $tenant = tenancy()->tenant;
        
        $invoices = Subscription::with('plan')
            ->where('tenant_id', $tenant->id)
            ->whereIn('status', [Subscription::STATUS_ACTIVE, Subscription::STATUS_EXPIRED])
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Tenant/Subscription/Invoices', [
            'invoices' => $invoices,
        ]);
    }

    /**
     * Download invoice as PDF
     */
    public function downloadInvoice(Subscription $subscription)
    {
        $tenant = tenancy()->tenant;
        
        // Ensure subscription belongs to current tenant
        if ($subscription->tenant_id !== $tenant->id) {
            abort(403);
        }

        // TODO: Generate PDF invoice
        // For now, return view for printing
        return Inertia::render('Tenant/Subscription/InvoicePDF', [
            'subscription' => $subscription->load('plan'),
            'tenant' => $tenant,
        ]);
    }

    /**
     * Calculate usage statistics
     */
    private function getUsageStatistics($tenant, $subscription)
    {
        $plan = $subscription?->plan;

        tenancy()->initialize($tenant);

        // Count current usage
        $patientsCount = \App\Models\Patient::count();
        $doctorsCount = \App\Models\User::where('account_type', 'docteur')->count();
        
        // Calculate storage (in MB)
        $storagePath = storage_path('app/public');
        $storageUsed = $this->getDirectorySize($storagePath) / 1024 / 1024; // Convert to MB

        tenancy()->end();

        return [
            'patients' => [
                'current' => $patientsCount,
                'limit' => $plan?->max_patients ?? 0,
                'percentage' => $plan && $plan->max_patients > 0 
                    ? min(100, round(($patientsCount / $plan->max_patients) * 100)) 
                    : 0,
                'unlimited' => $plan && $plan->max_patients == 0,
            ],
            'doctors' => [
                'current' => $doctorsCount,
                'limit' => $plan?->max_doctors ?? 0,
                'percentage' => $plan && $plan->max_doctors > 0 
                    ? min(100, round(($doctorsCount / $plan->max_doctors) * 100)) 
                    : 0,
                'unlimited' => $plan && $plan->max_doctors == 0,
            ],
            'storage' => [
                'current' => round($storageUsed, 2),
                'limit' => $plan?->max_storage_mb ?? 0,
                'percentage' => $plan && $plan->max_storage_mb > 0 
                    ? min(100, round(($storageUsed / $plan->max_storage_mb) * 100)) 
                    : 0,
                'unlimited' => $plan && $plan->max_storage_mb == 0,
            ],
        ];
    }

    /**
     * Get directory size recursively
     */
    private function getDirectorySize($path)
    {
        $size = 0;
        
        if (!is_dir($path)) {
            return 0;
        }

        try {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CATCH_GET_CHILD
            );

            foreach ($files as $file) {
                if ($file->isFile()) {
                    $size += $file->getSize();
                }
            }
        } catch (\Exception $e) {
            \Log::error("Error calculating directory size: " . $e->getMessage());
        }

        return $size;
    }
}
