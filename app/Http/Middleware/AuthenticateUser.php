<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('user')->check()) {
            return redirect()->route('login'); 
        }

        return $next($request);
    }
}
