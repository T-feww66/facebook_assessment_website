<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// khai báo sử dụng loginRequest
use App\Http\Controllers\Requests\LoginRequest;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;


class AdminLoginController extends Controller
{

    public function getLogin()
    {
        if (Auth::check()) {
            // nếu đăng nhập thàng công thì 
            return redirect('admincp');
        } else {
            return view('auth.login');
        }
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        // Kiểm tra đầu vào
        if (empty($request->username) || empty($request->password)) {
            return redirect()->back()->with('notice', 'Vui lòng nhập tên đăng nhập và mật khẩu');
        }

        // Kiểm tra checkbox "Ghi nhớ đăng nhập"
        $remember = $request->has('remember');

        // Tạo mảng login, nhưng password cần hash trước khi lưu vào DB
        $login = [
            'username' => strtolower($request->username),
            'password' => $request->password,
        ];

        // Kiểm tra đăng nhập
        if (Auth::attempt($login, $remember)) {
            return redirect('admincp');
        }

        // Nếu đăng nhập thất bại, kiểm tra xem user có tồn tại không
        $user = NguoiDung::where('username', strtolower($request->username))->first();

        if ($user) {
            // Nếu người dùng đã tồn tại, đăng nhập vào hệ thống ngay lập tức
            Auth::attempt($login, $remember);
            return redirect('/');  // Đưa người dùng vào trang admin
        }

        // Nếu người dùng không tồn tại, tạo tài khoản mới
        $users = new NguoiDung();
        $users->username = strtolower($request->username);
        $users->password = bcrypt($request->password);
        $users->fullname = "Người dùng mới";  // Đảm bảo fullname có giá trị
        $users->email = "example@gmail.com";  // Bạn có thể thay đổi logic này
        $users->remember_token = Str::random(60);  // Tạo token ngẫu nhiên
        $users->level = 1;

        if ($users->save()) {
            // Đăng nhập người dùng sau khi tạo tài khoản mới
            return redirect('admincp/login')->with('notice', 'Tạo tài khoản thành công');  // Đưa người dùng vào trang admin
        } else {
            return redirect()->back()->with('error', 'Lỗi khi tạo tài khoản');
        }
    }





    /**
     * action admincp/logout
     * @return RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
