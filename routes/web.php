<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Middleware\checkAdminLogin;
use App\Http\Controllers\admin\DanhMucController;
use App\Http\Controllers\admin\BrandController;

// Route cho trang đăng nhập và đăng ký
// Route cho các trang admin


// Route::get("/", function () {
//     return view("auth.login");
// });


// Route::view("admincp/home", "admin.home")->name("admin.home");
// Route::view('admincp/library', 'admin.library')->name('admin.library'); // Quản lý thư viện
// Route::view('admincp/pages', 'admin.pages')->name('admin.pages'); // Quản lý trang
// Route::view('admincp/posts', 'admin.posts')->name('admin.posts'); // Quản lý bài viết

// // Route::view('admincp/users', 'admin.users')->name('admin.users'); // Quản lý người dùng
// Route::get("admincp/users", [AdminLoginController::class, "index"])->name("admin.users");
// // Chỉnh sửa thông tin người dùng
// Route::get('admincp/users/edit/{id}', [AdminLoginController::class, 'edit'])->name('edit_user');
// Route::post('admincp/users/edit/{id}', [AdminLoginController::class, 'update'])->name('update_user');
// // Xóa người dùng
// Route::delete('admincp/users/delete/{id}', [AdminLoginController::class, 'destroy'])->name('delete_user');


// // Route cho các chức năng đăng nhập và đăng xuất, đăng kí
// Route::get('admincp/register', [AdminLoginController::class, 'getRegister'])->name('getRegister');
// Route::post('admincp/register', [AdminLoginController::class, 'postRegister'])->name('postRegister');
// Route::get('admincp/login', [AdminLoginController::class, 'getLogin'])->name('getLogin');
// Route::post('admincp/login', [AdminLoginController::class, 'postLogin'])->name('postLogin');
// Route::get('admincp/logout', [AdminLoginController::class, 'getLogout'])->name('getLogout');


// // Nhóm các route quản trị với middleware bảo vệ và tiền tố 'admincp'
// Route::middleware([checkAdminLogin::class])->prefix('admincp')->group(function () {
//     Route::get('/', function () {
//         return view('admin.home');
//     });
// });

// // Route cho các chức năng quản lý danh mục
// Route::get("admincp/danhmuc", [DanhMucController::class, "index"])->name("admin.danhmuc");
// Route::get("admincp/danhmuc/add_danh_muc", [DanhMucController::class, "getAddDanhMuc"])->name("getAddDanhMuc");
// Route::post("admincp/danhmuc/add_danh_muc", [DanhMucController::class, "postAddDanhMuc"])->name("postAddDanhMuc");
// Route::get('admincp/danhmuc/edit/{id}', [DanhMucController::class, 'edit'])->name('edit_danhmuc');
// Route::post('admincp/danhmuc/edit/{id}', [DanhMucController::class, 'update'])->name('update_danhmuc');
// // Xóa người dùng
// Route::delete('admincp/danhmuc/delete/{id}', [DanhMucController::class, 'destroy'])->name('delete_danhmuc');



Route::get("/", function () {
    return view("auth.login");
});

// Nhóm các route quản trị với middleware bảo vệ và tiền tố 'admincp'
Route::middleware([checkAdminLogin::class])->prefix('admincp')->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    });

    Route::view("home", "admin.home")->name("admin.home");
    Route::view('library', 'admin.library')->name('admin.library'); // Quản lý thư viện
    // Quản lý người dùng
    Route::get("users", [AdminLoginController::class, "index"])->name("admin.users");
    Route::get("user/add_user", [AdminLoginController::class, "getAddUser"])->name("getAddUser");
    Route::post("user/add_user", [AdminLoginController::class, "postAddUser"])->name("postAddUser");
    // Chỉnh sửa thông tin người dùng
    Route::get('users/edit/{id}', [AdminLoginController::class, 'edit'])->name('edit_user');
    Route::post('users/edit/{id}', [AdminLoginController::class, 'update'])->name('update_user');
    // Xóa người dùng
    Route::delete('users/delete/{id}', [AdminLoginController::class, 'destroy'])->name('delete_user');

    // Quản lý danh mục
    Route::get("danhmuc", [DanhMucController::class, "index"])->name("admin.danhmuc");
    Route::get("danhmuc/add_danh_muc", [DanhMucController::class, "getAddDanhMuc"])->name("getAddDanhMuc");
    Route::post("danhmuc/add_danh_muc", [DanhMucController::class, "postAddDanhMuc"])->name("postAddDanhMuc");
    Route::get('danhmuc/edit/{id}', [DanhMucController::class, 'edit'])->name('edit_danhmuc');
    Route::post('danhmuc/edit/{id}', [DanhMucController::class, 'update'])->name('update_danhmuc');
    // Xóa danh mục
    Route::delete('danhmuc/delete/{id}', [DanhMucController::class, 'destroy'])->name('delete_danhmuc');



    // Quản lý router thương hiệu
    Route::get("brands", [BrandController::class, "index"])->name("admin.brands");

});

// Route cho các chức năng đăng nhập và đăng xuất, đăng kí
Route::prefix('admincp')->group(function () {
    Route::get('register', [AdminLoginController::class, 'getRegister'])->name('getRegister');
    Route::post('register', [AdminLoginController::class, 'postRegister'])->name('postRegister');
    Route::get('login', [AdminLoginController::class, 'getLogin'])->name('getLogin');
    Route::post('login', [AdminLoginController::class, 'postLogin'])->name('postLogin');
    Route::get('logout', [AdminLoginController::class, 'getLogout'])->name('getLogout');
});
