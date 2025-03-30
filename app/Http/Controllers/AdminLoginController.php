<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// khai báo sử dụng loginRequest
use App\Http\Controllers\Requests\LoginRequest;
use App\Http\Controllers\Requests\RegisterRequest;
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

    public function getRegister()
    {
        return view("auth.register");
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

        $remember = $request->has('remember');

        // Tạo mảng login
        $login = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        // Kiểm tra đăng nhập
        if (Auth::attempt($login, $remember)) {
            return redirect('admincp');
        }

        // Kiểm tra nếu người dùng tồn tại nhưng mật khẩu sai
        $user = NguoiDung::where('username', strtolower($request->username))->first();
        if ($user) {
            return redirect()->back()->with('error', 'Sai mật khẩu, vui lòng thử lại!');
        }

        // Nếu không tìm thấy tài khoản
        return redirect()->back()->with('notice', 'Tài khoản không tồn tại, vui lòng đăng ký trước khi đăng nhập!');
    }

    public function postRegister(RegisterRequest $request)
    {
        // Kiểm tra nếu có bất kỳ giá trị nào bị bỏ trống
        if (empty($request->username) || empty($request->password) || empty($request->fullname) || empty($request->email)) {
            return redirect()->back()->with('error', 'Vui lòng điền đầy đủ thông tin!');
        }

        // Kiểm tra xem username đã tồn tại chưa
        if (NguoiDung::where('username', strtolower($request->username))->exists()) {
            return redirect()->back()->with('error', 'Tên đăng nhập đã tồn tại, vui lòng chọn tên khác!');
        }

        $users = new NguoiDung();
        $users->username = $request->username;
        $users->password = bcrypt($request->password);
        $users->fullname = $request->fullname;
        $users->email = $request->email;
        $users->remember_token = Str::random(60);
        $users->level = 1; // Mặc định level là 0

        if ($users->save()) {
            return redirect('admincp/login')->with('notice', 'Tạo tài khoản thành công, vui lòng đăng nhập!');
        } else {
            return redirect()->back()->with('error', 'Lỗi khi tạo tài khoản, vui lòng thử lại!');
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
