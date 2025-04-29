<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class checkAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $routeName = $request->route()->getName();
        $guestRoutes = ['getLogin', 'postLogin', 'getRegister', 'postRegister'];

        // Nếu chưa đăng nhập
        if (!Auth::check()) {
            return in_array($routeName, $guestRoutes)
                ? $next($request)
                : redirect()->route('getLogin');
        }

        // Nếu đã đăng nhập nhưng không đủ quyền
        if ($user->level != 1 || $user->status != 1) {
            Auth::logout();
            return redirect()->route('getLogin');
        }

        // Nếu đã login mà vào trang login/register thì redirect vào admin dashboard
        if (in_array($routeName, $guestRoutes)) {
            return redirect()->route('admin.dashboard');
        }

        // ✅ Đủ điều kiện → cho qua
        return $next($request);
    }
}
