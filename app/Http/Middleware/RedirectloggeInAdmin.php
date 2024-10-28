<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectloggeInAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // Middleware để chuyển hướng người dùng đã đăng nhập
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Kiểm tra vai trò super_admin
        if ($user && $user->hasRole('super_admin')) {
            return $next($request);
        }

        // Kiểm tra vai trò admin hoặc staff
        if ($user && ($user->hasRole('admin') || $user->hasRole('staff'))) {
            return redirect('/app');
        }

        // Nếu người dùng không có quyền đăng nhập, trả về lỗi 403
        if ($user) {
            return abort(403, 'Bạn không có quyền đăng nhập');
        }

        return $next($request);
    }

}
