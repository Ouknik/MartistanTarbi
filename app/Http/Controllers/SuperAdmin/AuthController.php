<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return Inertia::render('SuperAdmin/Auth/Login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = SuperAdmin::where('email', $credentials['email'])->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return back()->withErrors([
                'email' => __('superadmin.invalid_credentials'),
            ]);
        }

        if (!$admin->is_active) {
            return back()->withErrors([
                'email' => __('superadmin.account_inactive'),
            ]);
        }

        Auth::guard('superadmin')->login($admin, $request->boolean('remember'));
        $admin->updateLastLogin();
        $request->session()->regenerate();

        return redirect()->intended(route('superadmin.dashboard'));
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::guard('superadmin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login');
    }
}
