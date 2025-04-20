@extends('layouts.admin')

@section("title", "Danh sách yêu cầu đánh giá")
@section("header", "Quản lý yêu cầu đánh giá")

@section('content')
<h2 class="h2 fw-bold">Danh Sách yêu cầu đánh giá</h2>
<div id="download-link-fanpages" class="mb-3"></div>
<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>User id</th>
            <th>Tên thương hiệu</th>
            <th>status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($user_requests as $user_request)
        <tr>
            <td>{{ $user_request->id }}</td>
            <td>{{ $user_request->user_id }}</td>
            <td>{{ $user_request->brand_name }}</td>
            <td>
                @if ($user_request->status == 0)
                Chưa xử lý
                @elseif ($user_request->status == 1)
                Đã xử lý và gửi cho người dùng
                @else
                Không xác định
                @endif
            </td>

            <td>
                @if ($user_request->status == 0)
                <form class="request_crawl_data" action="" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" class="form-control" name="word_search" value="{{ $user_request->brand_name }}" require>
                    <input type="hidden" class="form-control" name="quantity_fanpage" value="1" max="1" required>
                    <input type="hidden" class="form-control" name="quantity_post_of_fanpage" value="1" min="1" max="5" required>
                    <button type="submit" class="btn btn-warning btn-sm">Xử lý yêu cầu</button>
                </form>
                @elseif ($user_request->status == 1)
                <span class="badge bg-success">Đã gửi</span>
                @endif
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementsByClassName('request_crawl_data')[0]
        form.addEventListener('submit', async function(e) {
            e.preventDefault(); // Ngăn form gửi theo cách mặc định
            const downloadDiv = document.getElementById("download-link-fanpages");
            const form_fanpages = e.target;
            const formData = new FormData(form_fanpages);

            // Nếu bạn cần truyền thêm api_key thì có thể thêm ở đây
            const apiKey = '{{ config("services.crawl_api.key") }}'; // Thay bằng API key thực tế nếu cần

            downloadDiv.innerHTML = `
            <div class="alert alert-info" role="alert">
                ⏳ Đang tiến hành cào dữ liệu, vui lòng chờ giây lát...
            </div>
        `;
            try {
                const response = await fetch("http://localhost:60074/crawl/crawl_comment_of_fanpages", {
                    method: "POST",
                    headers: {
                        "API-Key": apiKey // Nếu dùng API key ở dạng header
                    },
                    body: formData
                });

                const result = await response.json();
                if (response.ok) {
                    if (result.data.message) {
                        // Chèn link tải file vào div phía trên nút submit
                        alert(result.data.message)
                        location.reload();
                    }
                } else {
                    if (result.detail) {
                        // Chèn link tải file vào div phía trên nút submit
                        downloadDiv.innerHTML = `
                    <div class="alert alert-success">
                        ${result.detail} hoặc đã có dữ liệu về file này vui lòng xoá trước khi thực hiện
                    </div>
                `;
                    }
                }

            } catch (error) {
                console.error("Error:", error);
                alert("Đã xảy ra lỗi trong quá trình gửi yêu cầu.");
            }
        });
    });
</script>