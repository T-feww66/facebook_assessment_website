<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;


class CrawlCommentsController extends Controller
{

    public function __construct()
    {
        @session_start();
    }

    public function index()
    {
        return view("admin.pages.crawl_comments.index"); //compact('danhmuc')
    }
}
