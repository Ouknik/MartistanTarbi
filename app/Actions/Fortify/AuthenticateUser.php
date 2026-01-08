<?php
namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticateUser
{
    public function __invoke($request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();
        
        Log::debug('Fortify custom auth ATTEMPT', [
            'email' => $email,
            'user_found' => $user ? true : false,
            'db' => \DB::connection()->getDatabaseName(),
            'session_id' => session()->getId(),
            'session_driver' => config('session.driver'),
            'session_cookie' => config('session.cookie'),
        ]);
        
        if ($user && Hash::check($password, $user->password)) {
            Log::debug('Fortify custom auth SUCCESS', [
                'user_id' => $user->id,
                'session_id' => session()->getId(),
                'auth_check_before' => Auth::check(),
            ]);
            return $user;
        }
        
        Log::debug('Fortify custom auth FAILED', [
            'email' => $email,
            'user_exists' => $user ? true : false,
            'password_correct' => $user ? Hash::check($password, $user->password) : 'N/A',
        ]);
        return null;
    }
}
