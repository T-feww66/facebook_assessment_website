<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Middleware\checkAdminLogin;
use App\Http\Middleware\checkUserLogin;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CrawlCommentsController;
use App\Http\Controllers\users\UserLoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\users\UserSendRequestController;




Route::get('/', function () {
    return view('user.pages.home');
})->middleware(checkUserLogin::class);

// router cấu hình robots.txt
Route::get('/robots.txt', function () {
    return response(setting('robots_content', "User-agent: *\nDisallow:"), 200)
        ->header('Content-Type', 'text/plain');
});


// Nhóm các route quản trị với middleware bảo vệ và tiền tố 'admincp'
Route::middleware([checkAdminLogin::class])->prefix('admincp')->group(function () {
    // Route cho các chức năng đăng nhập và đăng xuất, đăng kí
    Route::get('login', [AdminLoginController::class, 'getLogin'])->name('getLogin');
    Route::get('register', [AdminLoginController::class, 'getRegister'])->name('getRegister');

    // Route::get('register', [AdminLoginController::class, 'getRegister'])->name('getRegister');
    Route::post('register', [AdminLoginController::class, 'postRegister'])->name('postRegister');
    // Route::get('login', [AdminLoginController::class, 'getLogin'])->name('getLogin');
    Route::post('login', [AdminLoginController::class, 'postLogin'])->name('postLogin');
    Route::get('logout', [AdminLoginController::class, 'getLogout'])->name('getLogout');


    Route::get("/", [AdminLoginController::class, "home"])->name("admin.home");


    // Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');
    // router cấu hình hệ thống
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    // Quản lý người dùng
    Route::get("users", [AdminLoginController::class, "index"])->name("admin.users");
    Route::get("user/add_user", [AdminLoginController::class, "getAddUser"])->name("getAddUser");
    Route::post("user/add_user", [AdminLoginController::class, "postAddUser"])->name("postAddUser");


    // Chỉnh sửa thông tin người dùng
    Route::get('users/edit/{id}', [AdminLoginController::class, 'edit'])->name('edit_user');
    Route::post('users/edit/{id}', [AdminLoginController::class, 'update'])->name('update_user');
    // Xóa người dùng
    Route::delete('users/delete/{id}', [AdminLoginController::class, 'destroy'])->name('delete_user');



    // Quản lý router thương hiệu
    Route::get("brands", [BrandController::class, "index"])->name("admin.brands");
    // Route::get("brands/evaluate", [BrandController::class, "evaluate"])->name("admin.brands.evaluate");
});


// Nhóm các route người dùng với middleware bảo vệ và tiền tố 'user'
Route::middleware([checkUserLogin::class])->prefix('user')->group(function () {
    Route::get('/', function () {
        return view('user.pages.home');
    });
    Route::get('/gioi-thieu', function () {
        return view('user.pages.gioi_thieu.index');
    })->name('user.gioithieu');

    // Cấu hình router tìm kiếm đánh giá thương hiệu
    Route::get('truc-quan/{brand_name?}/{word_search?}', [BrandController::class, 'tim_kiem'])->name('user.timkiem');
    Route::get('test', [BrandController::class, 'test'])->name('user.test');

    // Route::get("gui-danh-gia", [BrandController::class, "gui_danh_gia"])->name("user.gui_danh_gia");
    // Route::post('gui-danh-gia', [BrandController::class, 'user_send_request'])->name('user.post_gui_danh_gia');

    // quản lí router cào dữ liệu comment
    Route::get("crawl/{brand_name?}", [CrawlCommentsController::class, "index"])->name("user.crawl");

    Route::get("danh-gia-thuong-hieu", [BrandController::class, "so_sanh"])->name("user.sosanh");

    Route::get("trang-ca-nhan", [UserLoginController::class, "trang_ca_nhan"])->name("user.trang_ca_nhan");
    Route::post('trang-ca-nhan/{id}', [UserLoginController::class, 'cap_nhat_user'])->name('user.update_user');
    Route::get('trang-ca-nhan/lich-su', [UserLoginController::class, 'lich_su'])->name('user.lich_su');

    Route::get("send-request", [UserSendRequestController::class, "index"])->name("user.send_request");

});

// Route cho các chức năng đăng nhập và đăng xuất, đăng kí
Route::prefix('user')->group(function () {
    Route::get('register', [UserLoginController::class, 'getRegister'])->name('userGetRegister');
    Route::post('register', [UserLoginController::class, 'postRegister'])->name('userPostRegister');
    Route::get('login', [UserLoginController::class, 'getLogin'])->name('userGetLogin');
    Route::post('login', [UserLoginController::class, 'postLogin'])->name('userPostLogin');
    Route::get('logout', [UserLoginController::class, 'getLogout'])->name('userGetLogout');
});
