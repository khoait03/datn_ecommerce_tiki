<?php

namespace App\Http\Middleware;

use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectRegistrationApp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu đường dẫn là 'app'
        if ($request->path() === 'app') {
            $user = Auth::user();
            $checkStatus = $user->shop;

            // Kiểm tra nếu người dùng không có shop_id
            if (!$checkStatus || !$user->shop_id) {
                return abort(403, 'Bạn không có quyền truy cập trang này');
            }

            // Kiểm tra trạng thái của shop
            if ($checkStatus->status == 0) {
                return redirect()->route('wait');
            }
            if ($checkStatus->status == 2) {
                return redirect()->route('stop.shop');
            }
        }
        if(Auth::check()){
            $user = Auth::user();
            $shopId = $user->shop_id;

            $shop = Shop::where('id',$shopId)->first();
            if ($shop){
                return $next($request);
            }

        }

        return $next($request);
    }

}
