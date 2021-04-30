<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if ($user->role != $role) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => ["Sorry, we cannot proceed your request! Please contact administrator!"]
            ]);
        }

        return $next($request);
    }
}
