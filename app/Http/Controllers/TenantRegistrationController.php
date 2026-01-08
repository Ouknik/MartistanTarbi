<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Tenant;
use App\Notifications\TenantWelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TenantRegistrationController extends Controller
{
    /**
     * Show the tenant registration form
     */
    public function create()
    {
        $plans = Plan::where('is_active', true)
                     ->orderBy('price_monthly')
                     ->get();

        return Inertia::render('Register/Tenant', [
            'plans' => $plans,
        ]);
    }

    /**
     * Store a newly registered tenant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'clinic_name' => 'required|string|max:255',
            'clinic_email' => 'required|email|max:255',
            'clinic_phone' => 'nullable|string|max:20',
            'subdomain' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                'unique:domains,domain',
                function ($attribute, $value, $fail) {
                    // Check reserved subdomains
                    $reserved = ['www', 'api', 'admin', 'superadmin', 'app', 'mail', 'ftp', 'dashboard'];
                    if (in_array(strtolower($value), $reserved)) {
                        $fail('هذا الاسم محجوز. اختر اسماً آخر.');
                    }
                },
            ],
            'city' => 'nullable|string|max:100',
            'plan_id' => 'required|exists:plans,id',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|string|min:8|confirmed',
            'accept_terms' => 'required|accepted',
        ], [
            'clinic_name.required' => 'اسم العيادة مطلوب',
            'clinic_email.required' => 'البريد الإلكتروني للعيادة مطلوب',
            'subdomain.required' => 'عنوان العيادة مطلوب',
            'subdomain.unique' => 'هذا العنوان مستخدم بالفعل',
            'subdomain.alpha_dash' => 'العنوان يجب أن يحتوي فقط على حروف وأرقام وشرطات',
            'plan_id.required' => 'يجب اختيار خطة',
            'admin_name.required' => 'اسم المدير مطلوب',
            'admin_email.required' => 'البريد الإلكتروني للمدير مطلوب',
            'admin_password.required' => 'كلمة المرور مطلوبة',
            'admin_password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
            'admin_password.confirmed' => 'كلمة المرور غير متطابقة',
            'accept_terms.accepted' => 'يجب الموافقة على الشروط والأحكام',
        ]);

        // Get plan for trial days
        $plan = Plan::findOrFail($validated['plan_id']);

        // Generate tenant ID from subdomain
        $tenantId = Str::slug($validated['subdomain']);

        // Create tenant
        $tenant = Tenant::create([
            'id' => $tenantId,
            'name' => $validated['clinic_name'],
            'email' => $validated['clinic_email'],
            'phone' => $validated['clinic_phone'] ?? null,
            'city' => $validated['city'] ?? null,
            'plan_id' => $validated['plan_id'],
            'is_active' => true,
            'trial_ends_at' => now()->addDays($plan->trial_days ?? 14),
            'data' => [
                'name' => $validated['clinic_name'],
                'email' => $validated['clinic_email'],
                'phone' => $validated['clinic_phone'] ?? null,
                'city' => $validated['city'] ?? null,
                'admin_name' => $validated['admin_name'],
                'admin_email' => $validated['admin_email'],
                'registered_at' => now()->toDateTimeString(),
            ],
        ]);

        // Create domain
        $tenant->domains()->create([
            'domain' => $validated['subdomain'],
            'is_primary' => true,
        ]);

        // Store plain password to send in email (before hashing)
        $plainPassword = $validated['admin_password'];

        // Run tenant migrations and create admin user
        $tenant->run(function () use ($validated) {
            // Seed tenant database with default data
            $seeder = new \Database\Seeders\TenantDatabaseSeeder();
            $seeder->run();

            // Create admin user in tenant database
            \App\Models\User::create([
                'name' => $validated['admin_name'],
                'email' => $validated['admin_email'],
                'password' => Hash::make($validated['admin_password']),
                'type' => 'docteur',
                'email_verified_at' => now(),
            ]);
        });

        // Send welcome email to tenant admin
        try {
            Notification::route('mail', $validated['admin_email'])
                ->notify(new TenantWelcomeNotification($tenant, $plainPassword));
        } catch (\Exception $e) {
            \Log::error('Failed to send welcome email: ' . $e->getMessage());
        }

        // Redirect to success page or tenant login
        return redirect()->route('register.tenant.success', ['tenant' => $tenantId]);
    }

    /**
     * Show success page after registration
     */
    public function success(Request $request)
    {
        $tenantId = $request->query('tenant');
        $tenant = Tenant::with('domains')->find($tenantId);

        if (!$tenant) {
            return redirect()->route('register.tenant');
        }

        return Inertia::render('Register/Success', [
            'tenant' => $tenant,
            'loginUrl' => 'https://' . $tenant->domains->first()->domain . '.maristan.app/login',
        ]);
    }
}
