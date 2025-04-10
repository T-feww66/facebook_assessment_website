@extends('layouts.user')

@section("title", "Tìm Kiếm Đánh Giá")

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-white">Tìm Kiếm Đánh Giá</h2>
        <p class="text-white-50">Nhập từ khóa để tra cứu đánh giá của thương hiệu bạn quan tâm.</p>
    </div>

    <!-- Thương hiệu nổi bật -->
    <div class="mb-4">
        <h5 class="text-white mb-3">Thương hiệu nổi bật:</h5>
        <ul class="list-unstyled d-flex flex-wrap gap-2">
            <li class="brands">
                <a class="badge bg-white text-primary px-3 py-2">Tiger</a>
            </li>
            <li class="brands">
                <a class="badge bg-white text-primary px-3 py-2">Tiger</a>
            </li>
            <li class="brands">
                <a class="badge bg-white text-primary px-3 py-2">Tiger</a>
            </li>
            <li class="brands">
                <a class="badge bg-white text-primary px-3 py-2">Tiger</a>
            </li>
        </ul>
    </div>


    <!-- Form tìm kiếm -->
    <form class="d-flex">
        <input class="form-control me-1" type="search" placeholder="🔍 Nhập tên thương hiệu..."
            aria-label="Tìm kiếm">
        <button class="btn btn-success" type="submit">Search</button>
    </form>

</div>
@endsection