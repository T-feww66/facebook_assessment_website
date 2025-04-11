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
            @foreach($brands as $brand)
            <li class="brands">
                <a class="badge bg-white text-primary px-3 py-2 {{ $brand->brand_name }}">{{ $brand->brand_name }}</a>
            </li>
            @endforeach
        </ul>
    </div>


    <!-- Form tìm kiếm -->
    <form id="evaluateForm" class="d-flex mb-3">
        <input id="brandInput" class="form-control me-1" type="search" placeholder="🔍 Nhập tên thương hiệu..."
            aria-label="Tìm kiếm">
        <button class="btn btn-success" type="submit">Search</button>
    </form>
    <div id="markdown-container" class="text-light"></div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("evaluateForm");

        form.addEventListener("submit", async function(e) {
            e.preventDefault(); // Ngăn reload trang
            await evaluateBrand(); // Gọi hàm async
        });
    });

    async function evaluateBrand() {
        const brandName = document.getElementById('brandInput').value.trim();
        const resultDiv = document.getElementById('markdown-container');

        const apiKey = '{{ config("services.crawl_api.key") }}';
        
        if (!brandName) {
            alert("Vui lòng nhập tên thương hiệu.");
            return;
        }

        resultDiv.innerText = 'Đang xử lý...';

        const formData = new FormData();
        formData.append("brand", brandName);

        try {
            const response = await fetch('http://localhost:60074/danh_gia_thuong_hieu/thuong_hieu', {
                method: "POST",
                headers: {
                    "API-Key": apiKey
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                if (result.data) {
                    resultDiv.innerHTML = marked.parse(result.data);
                } else {
                    resultDiv.innerHTML = `<div class="alert alert-warning">Không có dữ liệu đánh giá.</div>`;
                }
            } else {
                resultDiv.innerHTML = `<div class="alert alert-danger">${result.detail || "Đã xảy ra lỗi khi đánh giá."}</div>`;
            }

        } catch (error) {
            console.error(error);
            resultDiv.innerHTML = `
        <div class="alert alert-danger">
          Đã xảy ra lỗi trong quá trình gửi yêu cầu.
        </div>
      `;
        }
    }
</script>