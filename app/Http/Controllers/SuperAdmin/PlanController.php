<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlanController extends Controller
{
    /**
     * Display a listing of plans
     */
    public function index()
    {
        $plans = Plan::withCount('tenants')->get();

        return Inertia::render('SuperAdmin/Plans/Index', [
            'plans' => $plans,
        ]);
    }

    /**
     * Show the form for creating a new plan
     */
    public function create()
    {
        return Inertia::render('SuperAdmin/Plans/Create');
    }

    /**
     * Store a newly created plan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:50|unique:plans,slug|alpha_dash',
            'description' => 'nullable|string',
            'price_monthly' => 'required|numeric|min:0',
            'price_yearly' => 'required|numeric|min:0',
            'max_doctors' => 'required|integer|min:-1',
            'max_patients' => 'required|integer|min:-1',
            'max_storage_mb' => 'required|integer|min:-1',
            'features' => 'nullable|array',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        Plan::create($validated);

        return redirect()->route('superadmin.plans.index')
                        ->with('success', 'تم إنشاء الخطة بنجاح');
    }

    /**
     * Show the form for editing the plan
     */
    public function edit(Plan $plan)
    {
        return Inertia::render('SuperAdmin/Plans/Edit', [
            'plan' => $plan,
        ]);
    }

    /**
     * Update the specified plan
     */
    public function update(Request $request, Plan $plan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:50|unique:plans,slug,' . $plan->id . '|alpha_dash',
            'description' => 'nullable|string',
            'price_monthly' => 'required|numeric|min:0',
            'price_yearly' => 'required|numeric|min:0',
            'max_doctors' => 'required|integer|min:-1',
            'max_patients' => 'required|integer|min:-1',
            'max_storage_mb' => 'required|integer|min:-1',
            'features' => 'nullable|array',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $plan->update($validated);

        return redirect()->route('superadmin.plans.index')
                        ->with('success', 'تم تحديث الخطة بنجاح');
    }

    /**
     * Delete the plan
     */
    public function destroy(Plan $plan)
    {
        if ($plan->tenants()->count() > 0) {
            return back()->with('error', 'لا يمكن حذف خطة مرتبطة بعيادات');
        }

        $plan->delete();

        return redirect()->route('superadmin.plans.index')
                        ->with('success', 'تم حذف الخطة بنجاح');
    }
}
