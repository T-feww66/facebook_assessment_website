<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\checkAdminLogin;
use App\Models\NguoiDung;

// Route cho trang đăng nhập và đăng ký
// Route cho các trang admin


Route::get("/", function () {
    $user = Auth::user();  // Lấy đối tượng người dùng đang đăng nhập
    if ($user) {
        return "ID người dùng: " . $user->id . " - Tên người dùng: " . $user->username;
    } else {
        return "Chưa có người dùng đăng nhập";
    }
});


Route::view("admin/home", "admin.home")->name("admin.home");
Route::view('admincp/library', 'admin.library')->name('admin.library'); // Quản lý thư viện
Route::view('admincp/pages', 'admin.pages')->name('admin.pages'); // Quản lý trang
Route::view('admincp/posts', 'admin.posts')->name('admin.posts'); // Quản lý bài viết
Route::view('admincp/users', 'admin.users')->name('admin.users'); // Quản lý người dùng

// Route cho các chức năng đăng nhập và đăng xuất
Route::get('admincp/login', [AdminLoginController::class, 'getLogin'])->name('getLogin');
Route::post('admincp/login', [AdminLoginController::class, 'postLogin'])->name('postLogin');
Route::get('admincp/logout', [AdminLoginController::class, 'getLogout'])->name('getLogout');

// Nhóm các route quản trị với middleware bảo vệ và tiền tố 'admincp'
Route::middleware([checkAdminLogin::class])->prefix('admincp')->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    });
});
