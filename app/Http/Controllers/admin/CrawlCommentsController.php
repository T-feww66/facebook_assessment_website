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

    public function index($brand_name = null)
    {
        if ($brand_name) {
            return view("admin.pages.crawl_comments.index", compact('brand_name'));
        }

        return view("admin.pages.crawl_comments.index");
    }

    public function listCSVFile()
    {
        $response = Http::get('http://localhost:60074/crawl/list-csv-files');

        if ($response->successful()) {
            $files = $response->json()['csv_files'];
        } else {
            $files = [];
        }
        return view('admin.pages.crawl_comments.listcsv', compact('files'));

    }
}
