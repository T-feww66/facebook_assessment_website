@extends('layouts.admin')

@section("title", "Danh sách thương hiệu")
@section("header", "Quản lý thương hiệu")

@section('content')
<form id="evaluate_form" action="" method="POST">
    @csrf
    <div class="mb-3">
        <label for="comments_file" class="form-label">Tên File cần đánh giá (phải có trên hệ thống)</label>
        <input type="text" class="form-control" id="comments_file" name="comments_file" value="{{ old('comments_file') }}" required>
        @error('comments_file')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="limit" class="form-label">Số lượng dòng cần đánh giá</label>
        <input type="number" class="form-control" id="limit" name="limit" value="{{ old('limit') }}">
        @error('limit')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div id="infomation" class="mb-3"></div>
    <button type="submit" class="btn btn-success crawl_group">Đánh giá File này</button>
</form>
<script>
    document.getElementById("evaluate_form").addEventListener("submit", async function(e) {
        e.preventDefault(); // Chặn submit mặc định
        const infomationDiv = document.getElementById("infomation");

        const apiKey = '{{ config("services.crawl_api.key") }}';

        const form_fanpages = e.target;
        const formData = new FormData(form_fanpages);

        infomationDiv.innerHTML = `
            <div class="alert alert-info" role="alert">
                ⏳ Đang tiến hành đánh giá file csv, vui lòng chờ giây lát...
            </div>
        `;

        try {
            const response = await fetch("http://localhost:60074/danh_gia_thuong_hieu/danh_gia", {
                method: "POST",
                headers: {
                    "API-Key": apiKey // Nếu dùng API key ở dạng header
                },
                body: formData
            });

            const result = await response.json();
            if (response.ok) {
                if (result.data && result.data.message) {
                    // Chèn link tải file vào div
                    infomationDiv.innerHTML = `
                    <div class="alert alert-success">
                        ${result.data.message}
                    </div>
                `;
                    document.getElementById("comments_file").value = "";
                    document.getElementById("limit").value = "";
                }
            } else {
                alert("Lỗi: " + result.detail);
            }
        } catch (error) {
            console.error("Lỗi khi gọi API:", error);
            alert("Lỗi xảy ra khi gọi API.");
        }
    });
</script>
@endsection