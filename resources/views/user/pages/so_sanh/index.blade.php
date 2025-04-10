@extends('layouts.user')

@section("title", "So Sánh Thương Hiệu")

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-white">So Sánh Thương Hiệu</h2>
        <p class="text-white-50">Chọn các thương hiệu để xem bảng so sánh đánh giá tổng quan.</p>
    </div>

    <!-- Form so sánh -->
    <form action="{{ route('user.sosanh') }}" method="GET">
        <div class="row g-3 mb-4">
            <div class="col-md-5">
                <select name="brand1" class="form-select" required>
                    <option value="">-- Chọn thương hiệu 1 --</option>
                    <option value="Tiger">Tiger</option>
                    <option value="Heineken">Heineken</option>
                    <option value="Saigon">Saigon</option>
                    <option value="Budweiser">Budweiser</option>
                </select>
            </div>
            <div class="col-md-5">
                <select name="brand2" class="form-select" required>
                    <option value="">-- Chọn thương hiệu 2 --</option>
                    <option value="Tiger">Tiger</option>
                    <option value="Heineken">Heineken</option>
                    <option value="Saigon">Saigon</option>
                    <option value="Budweiser">Budweiser</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100 fw-bold">So sánh</button>
            </div>
        </div>
    </form>

    <!-- Bảng kết quả so sánh (placeholder) -->
    <div class="bg-white p-4 rounded shadow-sm">
        <h5 class="text-primary fw-bold mb-3">Kết quả so sánh</h5>
        <p class="text-secondary">Chọn hai thương hiệu để xem bảng so sánh đánh giá.</p>
    </div>
</div>
@endsection
