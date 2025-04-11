<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;

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

    public function evaluate()
    {
        return view("admin.pages.brands.evaluate");
    }

    public function tim_kiem()
    {
        $brands = Brands::take(5)->get();
        return view('user.pages.tim_kiem_danh_gia.index', compact('brands'));
    }

    public function so_sanh()
    {
        $brands = Brands::take(5)->get();
        return view('user.pages.so_sanh.index', compact('brands'));
    }
}
