@extends('layouts.user')

@section("title", "Giới Thiệu")


@section('content')
@include("user.includes.sidebar")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Giới Thiệu Hệ Thống</h2>
                <p class="lead">Hệ thống giúp bạn khám phá, tìm hiểu và đánh giá các thương hiệu phổ biến dựa trên phản hồi thực tế từ cộng đồng.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="bg-white shadow-sm p-4 rounded">
                        <h5 class="fw-bold text-primary">Mục tiêu của hệ thống</h5>
                        <p class="text-secondary">Mang lại thông tin đánh giá minh bạch, khách quan và dễ hiểu về các thương hiệu trong nhiều lĩnh vực khác nhau.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-white shadow-sm p-4 rounded">
                        <h5 class="fw-bold text-primary">Tính năng nổi bật</h5>
                        <ul class="text-secondary mb-0">
                            <li>Đánh giá thương hiệu theo từ khoá</li>
                            <li>Đánh giá thương hiệu</li>
                            <li>Tự động thu thập dữ liệu và đánh giá</li>
                            <li>Giao diện đơn giản, dễ sử dụng</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection