<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Middleware\checkAdminLogin;
use App\Http\Controllers\admin\DanhMucController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CrawlCommentsController;



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


    // quản lí router cào dữ liệu comment
    Route::get("crawl", [CrawlCommentsController::class, "index"])->name("admin.crawl");
    Route::get('crawl/csv-files', [CrawlCommentsController::class, 'listCSVFile'])->name('admin.crawl.listcsv');
});

// Route cho các chức năng đăng nhập và đăng xuất, đăng kí
Route::prefix('admincp')->group(function () {
    Route::get('register', [AdminLoginController::class, 'getRegister'])->name('getRegister');
    Route::post('register', [AdminLoginController::class, 'postRegister'])->name('postRegister');
    Route::get('login', [AdminLoginController::class, 'getLogin'])->name('getLogin');
    Route::post('login', [AdminLoginController::class, 'postLogin'])->name('postLogin');
    Route::get('logout', [AdminLoginController::class, 'getLogout'])->name('getLogout');
});
