<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{

    public function __construct()
    {
        @session_start();
    }

    public function index()
    {
        $danhmuc = DanhMuc::all();
        return view("admin.pages.danh_muc.index", compact("danhmuc"));
    }

    public function edit($id)
    {
        $danhmuc = DanhMuc::findOrFail($id);
        return view('admin.pages.danh_muc.edit', compact('danhmuc')); // Hiển thị form chỉnh sửa
    }

    # Cập nhật user
    public function update(Request $request, $id)
    {
        $danhmuc = DanhMuc::findOrFail($id);
        $danhmuc->tieu_de = $request->tieu_de;
        $danhmuc->link = xoa_ky_tu_dat_biet($request->tieu_de);

        $check = $danhmuc->save();

        if ($check) {
            return redirect()->route('admin.danhmuc')->with('notice', 'Cập nhật danh mục thành công!');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật danh mục!');
        }
    }
    public function destroy($id)
    {
        $danhmuc = DanhMuc::findOrFail($id);
        $check = $danhmuc->delete();
        if ($check) {
            return redirect()->route('admin.danhmuc')->with('success', 'Xóa danh mục thành công');
        }
    }

    public function getAddDanhMuc()
    {
        return view("admin.pages.danh_muc.add");
    }

    public function postAddDanhMuc(Request $request)
    {

        $danhmuc = new Danhmuc();
        $danhmuc->tieu_de = $request->tieu_de;
        $danhmuc->link = xoa_ky_tu_dat_biet($request->tieu_de);
        $check = $danhmuc->save();

        if ($check) {
            return redirect()->route('admin.danhmuc')->with('success', 'Thêm danh mục thành công');
        }
    }
}
