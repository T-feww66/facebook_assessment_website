@extends('layouts.user')

@section("title", "Giới Thiệu")

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-white">Giới Thiệu Hệ Thống</h2>
        <p class="lead text-white-50">Hệ thống giúp bạn khám phá, tìm hiểu và đánh giá các thương hiệu phổ biến dựa trên phản hồi thực tế từ cộng đồng.</p>
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
                    <li>Tìm kiếm thương hiệu theo từ khóa</li>
                    <li>So sánh các thương hiệu với nhau</li>
                    <li>Giao diện đơn giản, dễ sử dụng</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
