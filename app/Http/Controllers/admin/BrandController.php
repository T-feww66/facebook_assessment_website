<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
use App\Models\UserSendRequest;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{

    public function __construct()
    {
        @session_start();
    }

    public function index()
    {
        $brands = Brands::all();
        return view("admin.pages.brands.index", compact("brands"));
    }

    public function user_request_index()
    {
        $user_requests = UserSendRequest::orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.pages.user_request.index', compact('user_requests'));
    }

    public function evaluate()
    {
        return view("admin.pages.brands.evaluate");
    }

    public function tim_kiem($brand_name = null)
    {
        $brands = Brands::where('user_id', Auth::id())->get();
        return view('user.pages.tim_kiem_danh_gia.index', compact('brands', "brand_name"));
    }

    public function gui_danh_gia(Request $request)
    {
        $brandName = $request->query('brand');
        $brand = Brands::where('brand_name', $brandName)->first();

        if ($brand || empty($brandName)) {
            return redirect()->route('user.timkiem');
        }
        return view('user.pages.tim_kiem_danh_gia.gui_danh_gia', compact('brandName'));
    }

    public function so_sanh()
    {
        $brands = Brands::take(5)->get();
        return view('user.pages.so_sanh.index', compact('brands'));
    }

    public function user_send_request(Request $request)
    {
        // Kiểm tra nếu có bất kỳ giá trị nào bị bỏ trống
        if (empty($request->email) || empty($request->brand_name) || empty($request->user_id)) {
            return redirect()->back()->with('error', 'Vui lòng điền đầy đủ thông tin!');
        }

        $userSendRequest = new UserSendRequest();
        $userSendRequest->user_id = $request->user_id;
        $userSendRequest->brand_name = $request->brand_name;
        $userSendRequest->email = $request->email;

        if ($userSendRequest->save()) {
            return redirect()->back()->with('notice', 'Đã gửi yêu cầu đánh giá thành công chúng tôi sẻ gửi kết quả đánh giá về email của bạn!');
        } else {
            return redirect()->back()->with('error', 'Lỗi trong quá trình gửi yêu cầu, thử lại sau!');
        }
    }
}
