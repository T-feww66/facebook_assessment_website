<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class checkUserLogin
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
        // nếu user đã đăng nhập
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->level == 0 && $user->status == 1) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect("user/login")->with('error', 'Sai tên đăng nhập hoặc mật khẩu!');
            }
        } else
            return redirect('user/login');
    }
}
