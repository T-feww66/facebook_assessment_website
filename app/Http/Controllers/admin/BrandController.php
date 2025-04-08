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
}
