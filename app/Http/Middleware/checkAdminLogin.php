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
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->level != 1 || $user->status != 1) {
                Auth::logout();
                return redirect()->route('getLogin');
            }

            if (in_array($request->route()->getName(), ['getLogin', 'postLogin', 'getRegister', 'postRegister'])) {
                return redirect('admincp');
            }

            return $next($request);
        }

        if (in_array($request->route()->getName(), ['getLogin', 'postLogin', 'getRegister', 'postRegister'])) {
            return $next($request);
        }

        return redirect()->route('getLogin');
    }
}
