<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\UserSendRequest;
use Illuminate\Support\Facades\Auth;

class UserSendRequestController extends Controller
{

    public function __construct()
    {
        @session_start();
    }

    public function index()
    {
        $send_requests = UserSendRequest::where('user_id', Auth::id())->get();
        return view('user.pages.trang_ca_nhan.send_requests', compact("send_requests"));
    }
}