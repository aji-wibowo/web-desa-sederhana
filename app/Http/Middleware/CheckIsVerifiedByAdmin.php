<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIsVerifiedByAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->role == 'warga') {
            if ($user->isVerifiedByAdmin != "true") {
                return redirect('/')->with(['sweetAlertMessage' => ['icon' => "warning", 'title' => "Forbidden!", 'text' => "Mohon maaf, akun Anda belum terverifikasi oleh Admin!"]]);
            }
        }

        return $next($request);
    }
}
