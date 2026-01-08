<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TenantWelcomeNotification;
use Inertia\Inertia;
use Stancl\Tenancy\Database\Models\Domain;

class TenantController extends Controller
{
    /**
     * Display a listing of tenants
     */
    public function index(Request $request)
    {
        $query = Tenant::with(['plan', 'domains']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status === 'trial') {
                $query->whereNotNull('trial_ends_at')
                      ->where('trial_ends_at', '>', now());
            }
        }

        if ($request->filled('plan')) {
            $query->where('plan_id', $request->plan);
        }

        $tenants = $query->latest()->paginate(15);
        $plans = Plan::all();

        return Inertia::render('SuperAdmin/Tenants/Index', [
            'tenants' => $tenants,
            'plans' => $plans,
            'filters' => $request->only(['search', 'status', 'plan']),
        ]);
    }

    /**
     * Show the form for creating a new tenant
     */
    public function create()
    {
        $plans = Plan::where('is_active', true)->get();

        return Inertia::render('SuperAdmin/Tenants/Create', [
            'plans' => $plans,
        ]);
    }

    /**
     * Store a newly created tenant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'plan_id' => 'required|exists:plans,id',
            'subdomain' => 'required|string|max:50|unique:domains,domain|alpha_dash',
            'trial_days' => 'nullable|integer|min:0|max:90',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email',
            'admin_password' => 'required|string|min:8',
        ]);

        try {
            // Generate tenant ID from subdomain
            $tenantId = Str::slug($validated['subdomain']);

            // Create tenant (this triggers CreateDatabase and MigrateDatabase jobs via TenantCreated event)
            $tenant = Tenant::create([
                'id' => $tenantId,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
                'city' => $validated['city'] ?? null,
                'plan_id' => $validated['plan_id'],
                'is_active' => true,
                'trial_ends_at' => $validated['trial_days'] 
                    ? now()->addDays($validated['trial_days']) 
                    : null,
                'data' => [
                    'admin_name' => $validated['admin_name'],
                    'admin_email' => $validated['admin_email'],
                ],
            ]);

            // Create domain - يجب حفظ subdomain فقط، ليس الدومين الكامل
            // Tenancy middleware سيضيف central domain تلقائياً
            $tenant->domains()->create([
                'domain' => $validated['subdomain'],
                'is_primary' => true,
            ]);

            // Store plain password to send in email (before hashing)
            $plainPassword = $validated['admin_password'];

            // Create admin user in tenant database
            // Note: Database and seeding are done automatically via TenantCreated event
            $tenant->run(function () use ($validated) {
                // Create admin user in tenant database (clinic manager)
                \App\Models\User::create([
                    'name' => $validated['admin_name'],
                    'email' => $validated['admin_email'],
                    'password' => Hash::make($validated['admin_password']),
                    'type' => 'admin',  // مدير العيادة
                    'email_verified_at' => now(),
                ]);
            });

            // Send welcome email to tenant admin with login credentials
            try {
                Notification::route('mail', $validated['admin_email'])
                    ->notify(new TenantWelcomeNotification($tenant, $plainPassword));
                
                \Log::info('Welcome email sent successfully to: ' . $validated['admin_email']);
            } catch (\Exception $e) {
                \Log::error('Failed to send welcome email: ' . $e->getMessage());
                // لا نوقف العملية إذا فشل إرسال البريد
            }

            return redirect()->route('superadmin.tenants.index')
                            ->with('success', __('superadmin.clinic_created_success'));
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Tenant creation failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'subdomain' => $validated['subdomain'] ?? null,
            ]);

            return back()->withInput()->withErrors([
                'error' => __('superadmin.clinic_creation_failed') . ': ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified tenant
     */
    public function show(Tenant $tenant)
    {
        $tenant->load(['plan', 'domains', 'subscriptions']);

        return Inertia::render('SuperAdmin/Tenants/Show', [
            'tenant' => $tenant,
        ]);
    }

    /**
     * Show the form for editing the tenant
     */
    public function edit(Tenant $tenant)
    {
        $plans = Plan::where('is_active', true)->get();

        return Inertia::render('SuperAdmin/Tenants/Edit', [
            'tenant' => $tenant->load('domains'),
            'plans' => $plans,
        ]);
    }

    /**
     * Update the specified tenant
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email,' . $tenant->id . ',id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'plan_id' => 'required|exists:plans,id',
            'is_active' => 'boolean',
        ]);

        $tenant->update($validated);

        return redirect()->route('superadmin.tenants.index')
                        ->with('success', __('superadmin.clinic_updated_success'));
    }

    /**
     * Toggle tenant active status
     */
    public function toggleStatus(Tenant $tenant)
    {
        $tenant->update(['is_active' => !$tenant->is_active]);

        $message = $tenant->is_active 
            ? __('superadmin.clinic_activated') 
            : __('superadmin.clinic_deactivated');
        
        return back()->with('success', $message);
    }

    /**
     * Extend trial period
     */
    public function extendTrial(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'days' => 'required|integer|min:1|max:90',
        ]);

        $newTrialEnd = $tenant->trial_ends_at 
            ? $tenant->trial_ends_at->addDays($validated['days'])
            : now()->addDays($validated['days']);

        $tenant->update(['trial_ends_at' => $newTrialEnd]);

        return back()->with('success', __('superadmin.trial_extended'));
    }

    /**
     * Delete the tenant
     */
    public function destroy(Tenant $tenant)
    {
        // Delete tenant database
        $tenant->delete();

        return redirect()->route('superadmin.tenants.index')
                        ->with('success', __('superadmin.clinic_deleted_success'));
    }
}
