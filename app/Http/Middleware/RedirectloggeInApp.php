<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectloggeInApp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            $response = $next($request);

            if (Auth::user()?->hasRole('admin') || Auth::user()?->hasRole('staff')) {
                return $response;
            }
//            if (Auth::user()?->hasRole(0)){
//                abort(403,'Bạn không có quyền đăng nhâp');
//            }

        }
        return $next($request);
    }
}
