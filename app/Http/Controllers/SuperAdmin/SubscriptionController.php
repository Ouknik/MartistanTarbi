<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of subscriptions
     */
    public function index(Request $request)
    {
        $query = Subscription::with(['tenant', 'plan']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tenant')) {
            $query->where('tenant_id', $request->tenant);
        }

        $subscriptions = $query->latest()->paginate(15);

        return Inertia::render('SuperAdmin/Subscriptions/Index', [
            'subscriptions' => $subscriptions,
            'filters' => $request->only(['status', 'tenant']),
        ]);
    }

    /**
     * Show form to create subscription for a tenant
     */
    public function create(Request $request)
    {
        $tenants = Tenant::all();
        $plans = Plan::where('is_active', true)->get();

        return Inertia::render('SuperAdmin/Subscriptions/Create', [
            'tenants' => $tenants,
            'plans' => $plans,
            'selectedTenant' => $request->tenant,
        ]);
    }

    /**
     * Store a new subscription
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'plan_id' => 'required|exists:plans,id',
            'period' => 'required|in:monthly,yearly',
            'payment_method' => 'required|string',
            'payment_reference' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $plan = Plan::findOrFail($validated['plan_id']);
        $tenant = Tenant::findOrFail($validated['tenant_id']);

        $amount = $validated['period'] === 'monthly' 
            ? $plan->price_monthly 
            : $plan->price_yearly;

        $duration = $validated['period'] === 'monthly' ? 1 : 12;

        // Cancel previous active subscriptions
        Subscription::where('tenant_id', $tenant->id)
                    ->where('status', 'active')
                    ->update(['status' => 'cancelled', 'cancelled_at' => now()]);

        // Create new subscription
        $subscription = Subscription::create([
            'tenant_id' => $tenant->id,
            'plan_id' => $plan->id,
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => now()->addMonths($duration),
            'payment_method' => $validated['payment_method'],
            'payment_reference' => $validated['payment_reference'],
            'amount' => $amount,
            'notes' => $validated['notes'],
        ]);

        // Update tenant
        $tenant->update([
            'plan_id' => $plan->id,
            'subscription_ends_at' => $subscription->ends_at,
            'trial_ends_at' => null, // End trial
        ]);

        return redirect()->route('superadmin.subscriptions.index')
                        ->with('success', 'تم إنشاء الاشتراك بنجاح');
    }

    /**
     * Cancel a subscription
     */
    public function cancel(Subscription $subscription)
    {
        $subscription->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return back()->with('success', 'تم إلغاء الاشتراك');
    }

    /**
     * Renew a subscription
     */
    public function renew(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'period' => 'required|in:monthly,yearly',
            'payment_method' => 'required|string',
            'payment_reference' => 'nullable|string',
        ]);

        $plan = $subscription->plan;
        $amount = $validated['period'] === 'monthly' 
            ? $plan->price_monthly 
            : $plan->price_yearly;

        $duration = $validated['period'] === 'monthly' ? 1 : 12;

        // Create renewal subscription
        $newSubscription = Subscription::create([
            'tenant_id' => $subscription->tenant_id,
            'plan_id' => $plan->id,
            'status' => 'active',
            'starts_at' => $subscription->ends_at,
            'ends_at' => $subscription->ends_at->addMonths($duration),
            'payment_method' => $validated['payment_method'],
            'payment_reference' => $validated['payment_reference'],
            'amount' => $amount,
            'notes' => 'تجديد الاشتراك',
        ]);

        // Update tenant
        $subscription->tenant->update([
            'subscription_ends_at' => $newSubscription->ends_at,
        ]);

        return back()->with('success', 'تم تجديد الاشتراك بنجاح');
    }
}
