<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\AuthController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\TenantController;
use App\Http\Controllers\SuperAdmin\PlanController;
use App\Http\Controllers\SuperAdmin\SubscriptionController;
use App\Http\Controllers\LocaleController;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Super Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Super Admin routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Guest routes (not authenticated as superadmin)
Route::middleware(['guest:superadmin', 'superadmin.inertia', 'locale'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('superadmin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('superadmin.login.submit');
});

// Protected routes (authenticated as superadmin)
Route::middleware(['auth:superadmin', 'superadmin', 'superadmin.inertia', 'locale'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard.index');

    // Tenants Management
    Route::resource('tenants', TenantController::class)->names([
        'index' => 'superadmin.tenants.index',
        'create' => 'superadmin.tenants.create',
        'store' => 'superadmin.tenants.store',
        'show' => 'superadmin.tenants.show',
        'edit' => 'superadmin.tenants.edit',
        'update' => 'superadmin.tenants.update',
        'destroy' => 'superadmin.tenants.destroy',
    ]);
    Route::post('tenants/{tenant}/toggle-status', [TenantController::class, 'toggleStatus'])->name('superadmin.tenants.toggle-status');
    Route::post('tenants/{tenant}/extend-trial', [TenantController::class, 'extendTrial'])->name('superadmin.tenants.extend-trial');
    Route::post('tenants/{tenant}/impersonate', [TenantController::class, 'impersonate'])->name('superadmin.tenants.impersonate');

    // Plans Management
    Route::resource('plans', PlanController::class)->names([
        'index' => 'superadmin.plans.index',
        'create' => 'superadmin.plans.create',
        'store' => 'superadmin.plans.store',
        'show' => 'superadmin.plans.show',
        'edit' => 'superadmin.plans.edit',
        'update' => 'superadmin.plans.update',
        'destroy' => 'superadmin.plans.destroy',
    ]);
    Route::post('plans/{plan}/toggle-status', [PlanController::class, 'toggleStatus'])->name('superadmin.plans.toggle-status');

    // Subscriptions Management
    Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('superadmin.subscriptions.index');
    Route::get('subscriptions/{subscription}', [SubscriptionController::class, 'show'])->name('superadmin.subscriptions.show');
    Route::post('subscriptions', [SubscriptionController::class, 'store'])->name('superadmin.subscriptions.store');
    Route::post('subscriptions/{subscription}/cancel', [SubscriptionController::class, 'cancel'])->name('superadmin.subscriptions.cancel');
    Route::post('subscriptions/{subscription}/renew', [SubscriptionController::class, 'renew'])->name('superadmin.subscriptions.renew');

    // Reports & Analytics
    Route::get('reports/revenue', [DashboardController::class, 'revenueReport'])->name('superadmin.reports.revenue');
    Route::get('reports/tenants', [DashboardController::class, 'tenantsReport'])->name('superadmin.reports.tenants');

    // Settings
    Route::get('settings', [DashboardController::class, 'settings'])->name('superadmin.settings');
    Route::post('settings', [DashboardController::class, 'updateSettings'])->name('superadmin.settings.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('superadmin.logout');
});

// Locale switch route for SuperAdmin (outside auth middleware to allow switching before/after login)
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('superadmin.locale.switch')
    ->middleware(['locale']);
