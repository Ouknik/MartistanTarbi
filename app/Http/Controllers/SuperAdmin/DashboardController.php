<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the super admin dashboard
     */
    public function index()
    {
        // Basic statistics
        $stats = [
            'total_tenants' => Tenant::count(),
            'active_tenants' => Tenant::where('is_active', true)->count(),
            'inactive_tenants' => Tenant::where('is_active', false)->count(),
            'trial_tenants' => Tenant::whereNotNull('trial_ends_at')
                                    ->where('trial_ends_at', '>', now())
                                    ->count(),
            'expired_trials' => Tenant::whereNotNull('trial_ends_at')
                                     ->where('trial_ends_at', '<', now())
                                     ->where('is_active', false)
                                     ->count(),
            'total_plans' => Plan::where('is_active', true)->count(),
        ];

        // Revenue statistics
        $revenueStats = [
            'total_revenue' => Subscription::where('status', Subscription::STATUS_ACTIVE)->sum('amount'),
            'monthly_revenue' => Subscription::where('status', Subscription::STATUS_ACTIVE)
                                            ->whereMonth('starts_at', now()->month)
                                            ->whereYear('starts_at', now()->year)
                                            ->sum('amount'),
            'yearly_revenue' => Subscription::where('status', Subscription::STATUS_ACTIVE)
                                           ->whereYear('starts_at', now()->year)
                                           ->sum('amount'),
            'pending_revenue' => Subscription::where('status', Subscription::STATUS_PENDING)->sum('amount'),
        ];

        // Monthly revenue chart data (last 12 months)
        $monthlyRevenueChart = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyRevenueChart[] = [
                'month' => $date->format('M Y'),
                'revenue' => Subscription::whereYear('starts_at', $date->year)
                                        ->whereMonth('starts_at', $date->month)
                                        ->where('status', Subscription::STATUS_ACTIVE)
                                        ->sum('amount'),
                'subscriptions' => Subscription::whereYear('starts_at', $date->year)
                                              ->whereMonth('starts_at', $date->month)
                                              ->where('status', Subscription::STATUS_ACTIVE)
                                              ->count(),
            ];
        }

        // Tenants growth chart (last 12 months)
        $tenantsGrowthChart = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $tenantsGrowthChart[] = [
                'month' => $date->format('M Y'),
                'total' => Tenant::whereYear('created_at', '<=', $date->year)
                                ->whereMonth('created_at', '<=', $date->month)
                                ->count(),
                'active' => Tenant::where('is_active', true)
                                 ->whereYear('created_at', '<=', $date->year)
                                 ->whereMonth('created_at', '<=', $date->month)
                                 ->count(),
            ];
        }

        // Recent tenants
        $recentTenants = Tenant::with('plan')
                               ->latest()
                               ->take(10)
                               ->get()
                               ->map(function ($tenant) {
                                   return [
                                       'id' => $tenant->id,
                                       'name' => $tenant->name,
                                       'email' => $tenant->email,
                                       'plan' => $tenant->plan?->name,
                                       'is_active' => $tenant->is_active,
                                       'trial_ends_at' => $tenant->trial_ends_at?->format('Y-m-d'),
                                       'created_at' => $tenant->created_at->diffForHumans(),
                                   ];
                               });

        // Subscriptions by plan
        $subscriptionsByPlan = Plan::withCount(['tenants' => function ($query) {
                                        $query->where('is_active', true);
                                    }])
                                   ->where('is_active', true)
                                   ->orderBy('tenants_count', 'desc')
                                   ->get()
                                   ->map(fn($plan) => [
                                       'name' => $plan->name,
                                       'count' => $plan->tenants_count,
                                       'revenue' => Subscription::whereHas('tenant', function ($q) use ($plan) {
                                                       $q->where('plan_id', $plan->id);
                                                   })
                                                   ->where('status', Subscription::STATUS_ACTIVE)
                                                   ->sum('amount'),
                                   ]);

        // Expiring subscriptions (next 30 days)
        $expiringSubscriptions = Subscription::with(['tenant', 'plan'])
                                             ->where('status', Subscription::STATUS_ACTIVE)
                                             ->whereBetween('ends_at', [now(), now()->addDays(30)])
                                             ->orderBy('ends_at')
                                             ->take(10)
                                             ->get()
                                             ->map(function ($subscription) {
                                                 return [
                                                     'tenant_name' => $subscription->tenant->name,
                                                     'plan_name' => $subscription->plan->name,
                                                     'ends_at' => $subscription->ends_at->format('Y-m-d'),
                                                     'days_remaining' => $subscription->ends_at->diffInDays(now()),
                                                 ];
                                             });

        return Inertia::render('SuperAdmin/Dashboard', [
            'stats' => array_merge($stats, $revenueStats),
            'monthlyRevenueChart' => $monthlyRevenueChart,
            'tenantsGrowthChart' => $tenantsGrowthChart,
            'recentTenants' => $recentTenants,
            'subscriptionsByPlan' => $subscriptionsByPlan,
            'expiringSubscriptions' => $expiringSubscriptions,
        ]);
    }
}
