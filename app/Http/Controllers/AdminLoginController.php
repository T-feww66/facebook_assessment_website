<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// khai báo sử dụng loginRequest
use App\Http\Controllers\Requests\LoginRequest;
use App\Http\Controllers\Requests\RegisterRequest;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AdminLoginController extends Controller
{

    public function __construct()
    {
        @session_start();
    }

    public function index()
    {
        $users = NguoiDung::all(); // Lấy tất cả danh mục, không lọc theo status
        return view("admin.pages.users.index", compact("users"));
    }

    public function home()
    {
        $users = NguoiDung::all(); // Lấy tất cả danh mục, không lọc theo status
        return view("admin.pages.users.index", compact("users"));
    }

    #Edit user (return về view editing user)
    public function edit($id)
    {
        $user = NguoiDung::findOrFail($id);
        return view('admin.pages.users.edit', compact('user')); // Hiển thị form chỉnh sửa
    }

    # Cập nhật user
    public function update(Request $request, $id)
    {
        $user = NguoiDung::findOrFail($id);
        $user->update([
            'email' => $request->email,
            'username' => $request->username,
            'fullname' => $request->fullname,
            'sdt' => $request->sdt,
            'dia_chi' => $request->dia_chi,
        ]);

        return redirect()->route('admin.users')->with('notice', 'Cập nhật người dùng thành công!');
    }
    public function destroy($id)
    {
        $user = NguoiDung::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Xóa người dùng thành công');
    }


    # Lấy giao diện login(nếu login rồi thì trả về giao diện admin còn không return login)
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
        $remember = $request->has('remember');

        // Tạo mảng login
        $login = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        // Kiểm tra đăng nhập
        if (Auth::attempt($login, $remember)) {
            $user = Auth::user();

            if ($user->level == 1) {
                return redirect('admincp'); // hoặc route('user.dashboard') nếu bạn đặt route tên
            } else {
                Auth::logout();
                return redirect()->back()->with('error', 'Tài khoản không tồn tại, vui lòng đăng ký trước khi đăng nhập!');
            }
        }

        // Kiểm tra nếu người dùng tồn tại nhưng mật khẩu sai
        $user = NguoiDung::where('username', strtolower($request->username))->first();
        if ($user) {
            return redirect()->back()->with('error', 'Sai mật khẩu, vui lòng thử lại!');
        }

        // Nếu không tìm thấy tài khoản
        return redirect()->back()->with('error', 'Tài khoản không tồn tại, vui lòng đăng ký trước khi đăng nhập!');
    }


    # Người dùng
    public function getAddUser()
    {
        return view("admin.pages.users.add");
    }

    public function postRegister(RegisterRequest $request)
    {
        // Kiểm tra xem username đã tồn tại chưa
        if (NguoiDung::where('username', $request->username)->exists()) {
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

    public function postAddUser(RegisterRequest $request)
    {
        // Kiểm tra nếu có bất kỳ giá trị nào bị bỏ trống
        if (empty($request->username) || empty($request->password) || empty($request->fullname) || empty($request->email)) {
            return redirect()->back()->with('error', 'Vui lòng điền đầy đủ thông tin!');
        }

        // Kiểm tra xem username đã tồn tại chưa
        if (NguoiDung::where('username', $request->username)->exists()) {
            return redirect()->back()->with('error', 'Tên đăng nhập đã tồn tại, vui lòng chọn tên khác!');
        }

        $users = new NguoiDung();
        $users->username = $request->username;
        $users->password = bcrypt($request->password);
        $users->fullname = $request->fullname;
        $users->email = $request->email;
        $users->sdt = $request->sdt;
        $users->dia_chi = $request->dia_chi;
        $users->remember_token = Str::random(60);
        $users->level = 1; // Mặc định level là 0

        if ($users->save()) {
            return redirect('admincp/users')->with('notice', 'Tạo tài khoản thành công, vui lòng đăng nhập!');
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
