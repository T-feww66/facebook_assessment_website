@extends('layouts.user')
@section('content')
<div class="container py-5">
    <!-- Tiêu đề chính -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-white">Chào mừng đến với Hệ thống Đánh Giá Thương Hiệu</h1>
        <p class="lead text-white-50">Khám phá và so sánh các thương hiệu dựa trên đánh giá từ cộng đồng.</p>
    </div>

    <!-- Các chức năng chính -->
    <div class="row g-4">
        <!-- Giới Thiệu -->
        <div class="col-md-4">
            <div class="card border-0 shadow-lg h-100 bg-white hover-shadow">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title text-primary fw-bold mb-3">Giới Thiệu</h5>
                        <p class="card-text text-secondary">Tìm hiểu mục tiêu và cách hoạt động của hệ thống đánh giá.</p>
                    </div>
                    <a href="{{ route('user.gioithieu') }}" class="btn btn-primary mt-3">Xem thêm</a>
                </div>
            </div>
        </div>

        <!-- Tìm kiếm đánh giá -->
        <div class="col-md-4">
            <div class="card border-0 shadow-lg h-100 bg-white hover-shadow">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title text-primary fw-bold mb-3">Tìm Kiếm Đánh Giá</h5>
                        <p class="card-text text-secondary">Tra cứu thông tin đánh giá chi tiết theo từ khóa.</p>
                    </div>
                    <a href="{{ route('user.timkiem') }}" class="btn btn-primary mt-3">Tìm kiếm</a>
                </div>
            </div>
        </div>

        <!-- So sánh thương hiệu -->
        <div class="col-md-4">
            <div class="card border-0 shadow-lg h-100 bg-white hover-shadow">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title text-primary fw-bold mb-3">So Sánh Thương Hiệu</h5>
                        <p class="card-text text-secondary">Đặt các thương hiệu cạnh nhau và xem đánh giá tổng quan.</p>
                    </div>
                    <a href="{{ route('user.sosanh') }}" class="btn btn-primary mt-3">So sánh</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
