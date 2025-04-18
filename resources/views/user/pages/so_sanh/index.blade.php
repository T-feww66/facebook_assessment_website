@extends('layouts.user')

@section("title", "So Sánh Thương Hiệu")

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-white">So Sánh Thương Hiệu</h2>
        <p class="text-white-50">Chọn các thương hiệu để xem bảng so sánh đánh giá tổng quan.</p>
    </div>

    <!-- Form so sánh -->
    <form id="evaluateCompareForm">
        <div class="row g-3 mb-4">
            <div class="col-md-5">
                <select name="brand1" class="form-select" required>
                    <option value="">-- Chọn thương hiệu 1 --</option>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->brand_name }}">{{ $brand->brand_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <select name="brand2" class="form-select" required>
                    <option value="">-- Chọn thương hiệu 2 --</option>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->brand_name }}">{{ $brand->brand_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100 fw-bold">So sánh</button>
            </div>
        </div>
    </form>

    <div id="markdown-evaluete-compare" class="text-light"></div>
</div>
@endsection
