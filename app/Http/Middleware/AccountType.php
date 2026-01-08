<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccountType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  ...$types  يقبل نوع واحد أو أكثر (admin, docteur, secretaire)
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$types)
    {
        // Debug logging
        Log::info('AccountType Middleware Check', [
            'url' => $request->url(),
            'auth_check' => Auth::check(),
            'user' => Auth::user() ? [
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'type' => Auth::user()->type,
            ] : null,
            'allowed_types' => $types,
            'session_id' => session()->getId(),
        ]);

        if (Auth::user() && in_array(Auth::user()->type, $types)) {
            Log::info('AccountType: Access GRANTED');
            return $next($request);
        }
        
        Log::warning('AccountType: Access DENIED', [
            'reason' => Auth::user() ? 'Type mismatch' : 'Not authenticated'
        ]);
        
        abort(403, __('messages.unauthorized_access'));
    }
}
