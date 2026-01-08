<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $home = config('fortify.home', '/patients');
        
        // الحصول على URL المقصود
        $intendedUrl = session()->get('url.intended', $home);
        
        // Debug: log login response info
        Log::debug('LoginResponse', [
            'user_id' => Auth::id(),
            'session_id' => session()->getId(),
            'is_authenticated' => Auth::check(),
            'intended_url' => $intendedUrl,
            'session_driver' => config('session.driver'),
            'session_cookie' => config('session.cookie'),
        ]);
        
        // مسح الـ intended URL من الجلسة
        session()->forget('url.intended');
        
        // حفظ الجلسة بشكل صريح
        session()->save();
        
        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        }
        
        // استخدام redirect مباشر
        return redirect($intendedUrl);
    }
}
