<?php

namespace App\Http\Middleware;

use App\Models\Setting;
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
            return redirect()->route('admin.home');
        }

        // Kiểm tra nếu route là 'settings.index' hoặc 'settings.update' thì không cần kiểm tra cấu hình
        if (in_array($routeName, ['settings.index', 'settings.update'])) {
            return $next($request);
        }

        $settings = Setting::whereIn('key', ['ai_provider', 'ai_api_key', 'model_llm'])->pluck('value', 'key');
        $aiProvider = $settings['ai_provider'] ?? null;
        $apiKey = $settings['ai_api_key'] ?? null;
        $modelLlm = $settings['model_llm'] ?? null;

        if (empty($aiProvider) || empty($apiKey) || empty($modelLlm)) {
            return redirect()->route('settings.index');
        }

        // ✅ Đủ điều kiện → cho qua
        return $next($request);
    }
}
