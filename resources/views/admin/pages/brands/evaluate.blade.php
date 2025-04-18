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
        e.preventDefault();

        const comments_file = document.getElementById("comments_file");
        const limit = document.getElementById("limit");
        const infomationDiv = document.getElementById("infomation"); // Đảm bảo div này tồn tại

        const apiKey = '{{ config("services.crawl_api.key") }}';
        const formData = new FormData();
        formData.append("comments_file", comments_file.value);
        if (limit.value !== "") {
            formData.append("limit", limit.value);
        }

        infomationDiv.innerHTML = `
            <div class="alert alert-info" role="alert">
                ⏳ Đang tiến hành đánh giá file csv, vui lòng chờ giây lát và không qua tag khác...
            </div>
        `;


        try {
            const response = await fetch("http://localhost:60074/danh_gia_thuong_hieu/danh_gia", {
                method: "POST",
                headers: {
                    "API-Key": apiKey
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

                    // ✅ Reset 2 input
                    comments_file.value = "";
                    limit.value = "";
                }
            } else {
                infomationDiv.innerHTML = `
                <div class="alert alert-danger">Có lỗi xảy ra: ${result.detail || "Không rõ nguyên nhân"}</div>
            `;
            }
        } catch (error) {
            console.error("Lỗi khi gọi API:", error);
            infomationDiv.innerHTML = `
            <div class="alert alert-danger">Lỗi khi gửi yêu cầu: ${error.message}</div>
        `;
        }
    });
</script>
@endsection