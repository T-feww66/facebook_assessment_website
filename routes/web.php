<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Middleware\checkAdminLogin;

// Route cho trang đăng nhập và đăng ký
// Route cho các trang admin


Route::get("/", function () {
    return view("auth.login");
});


Route::view("admincp/home", "admin.home")->name("admin.home");
Route::view('admincp/library', 'admin.library')->name('admin.library'); // Quản lý thư viện
Route::view('admincp/pages', 'admin.pages')->name('admin.pages'); // Quản lý trang
Route::view('admincp/posts', 'admin.posts')->name('admin.posts'); // Quản lý bài viết
Route::view('admincp/users', 'admin.users')->name('admin.users'); // Quản lý người dùng

// Route cho các chức năng đăng nhập và đăng xuất, đăng kí
Route::get('admincp/register', [AdminLoginController::class, 'getRegister'])->name('getRegister');
Route::post('admincp/register', [AdminLoginController::class, 'postRegister'])->name('postRegister');
Route::get('admincp/login', [AdminLoginController::class, 'getLogin'])->name('getLogin');
Route::post('admincp/login', [AdminLoginController::class, 'postLogin'])->name('postLogin');
Route::get('admincp/logout', [AdminLoginController::class, 'getLogout'])->name('getLogout');

// Nhóm các route quản trị với middleware bảo vệ và tiền tố 'admincp'
Route::middleware([checkAdminLogin::class])->prefix('admincp')->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    });
});
