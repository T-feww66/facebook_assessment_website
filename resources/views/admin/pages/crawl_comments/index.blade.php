@extends('layouts.admin')

@section("title", "Cào dữ liệu comment từ facebook")
@section("header", "Cào dữ liệu từ API")

@section('content')
<h2 class="h2 fw-bold">API</h2>
<!-- Chọn kiểu cào dữ liệu -->
<div class="mb-3">
    <label for="crawl_type" class="form-label">Chọn kiểu cào dữ liệu:</label>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="crawl_group" name="crawl_type" value="group" checked>
        <label class="form-check-label" for="crawl_group">Crawl Group</label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" id="crawl_fanpage" name="crawl_type" value="fanpage">
        <label class="form-check-label" for="crawl_fanpage">Crawl Fanpage</label>
    </div>
</div>

<form id="group_form" method="post">
    <div class="mb-3">
        <label for="name_group" class="form-label">Tên Group:</label>
        <input type="text" class="form-control" id="name_group" name="name_group" required>
        <div id="name_group_error" class="text-danger"></div>
    </div>

    <div class="mb-3">
        <label for="word_search" class="form-label">Từ khoá tìm kiếm:</label>
        <input type="text" class="form-control" id="word_search" name="word_search" required>
        <div id="word_search_error" class="text-danger"></div>
    </div>

    <div class="mb-3">
        <label for="quantity_group" class="form-label">Số lượng group (tối đa 2):</label>
        <input type="number" class="form-control" id="quantity_group" name="quantity_group" min="1" max="2" required>
        <div id="quantity_group_error" class="text-danger"></div>
    </div>

    <div class="mb-3">
        <label for="quantity_post_of_group" class="form-label">Số bài viết mỗi group (tối đa 5):</label>
        <input type="number" class="form-control" id="quantity_post_of_group" name="quantity_post_of_group" min="1" max="5" required>
        <div id="quantity_post_of_group_error" class="text-danger"></div>
    </div>
    <div id="download-link" class="mb-3"></div>
    <button type="submit" class="btn btn-primary mt-4">Cào dữ liệu</button>
</form>

<!-- Form Crawl Fanpage -->
<form id="fanpage_form" action="" method="POST" style="display:none;">
    @csrf
    <div class="mb-3">
        <label for="word_search_fanpage" class="form-label">Từ khóa tìm kiếm (tên thương hiệu cần tìm):</label>
        <input type="text" class="form-control" id="word_search_fanpage" name="word_search" value="{{ old('word_search') }}" required>
    </div>
    <div class="mb-3">
        <label for="quantity_fanpages" class="form-label">Số lượng fanpage:</label>
        <input type="number" class="form-control" id="quantity_fanpages" name="quantity_fanpage" value="{{ old('quantity_fanpage') }}" max="1" required>
    </div>
    <div class="mb-3">
        <label for="quantity_post_of_fanpage" class="form-label">Số bài viết mỗi fanpage:</label>
        <input type="number" class="form-control" id="quantity_post_of_fanpage" name="quantity_post_of_fanpage" value="{{ old('quantity_post_of_fanpage') }}" min="1" max="5" required>
    </div>
    <div id="download-link-fanpages" class="mb-3"></div>
    <button type="submit" class="btn btn-success crawl_group">Cào dữ liệu Fanpage</button>
</form>

<script>
    function toggleCrawlOptions() {
        const groupForm = document.getElementById("group_form");
        const fanpageForm = document.getElementById("fanpage_form");

        if (document.getElementById("crawl_group").checked) {
            groupForm.style.display = "block";
            fanpageForm.style.display = "none";
        } else {
            groupForm.style.display = "none";
            fanpageForm.style.display = "block";
        }
    }
    window.addEventListener("DOMContentLoaded", () => {
        // toggleCrawlOptions(); // Hiển thị form đúng khi tải trang

        const groupRadio = document.getElementById("crawl_group");
        const fanpageRadio = document.getElementById("crawl_fanpage");

        groupRadio.addEventListener("change", toggleCrawlOptions);
        fanpageRadio.addEventListener("change", toggleCrawlOptions);

    });

    document.getElementById('group_form').addEventListener('submit', async function(e) {
        e.preventDefault(); // Ngăn form gửi theo cách mặc định

        const downloadDiv = document.getElementById("download-link");
        const form = e.target;
        const formData = new FormData(form);

        // Nếu bạn cần truyền thêm api_key thì có thể thêm ở đây
        const apiKey = '{{ config("services.crawl_api.key") }}'; // Thay bằng API key thực tế nếu cần

        downloadDiv.innerHTML = `
            <div class="alert alert-info" role="alert">
                ⏳ Đang tiến hành cào dữ liệu, vui lòng chờ giây lát...
            </div>
        `;

        try {
            const response = await fetch("http://localhost:60074/crawl/crawl_comment_of_groups", {
                method: "POST",
                headers: {
                    "API-Key": apiKey
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                if (result.data.message) {
                    // Chèn link tải file vào div phía trên nút submit
                    downloadDiv.innerHTML = `
                    <div class="alert alert-success">
                        ${result.data.message}
                    </div>
                `;
                    document.getElementById("name_group").value = "";
                    document.getElementById("word_search").value = "";
                    document.getElementById("quantity_group").value = "";
                    document.getElementById("quantity_post_of_group").value = "";

                }
            } else {
                if (result.detail) {
                    // Chèn link tải file vào div phía trên nút submit
                    downloadDiv.innerHTML = `
                    <div class="alert alert-success">
                        ${result.detail} hoặc đã có dữ liệu về file này vui lòng xoá trước khi thực hiện
                    </div>
                `;
                    document.getElementById("name_group").value = "";
                    document.getElementById("word_search").value = "";
                    document.getElementById("quantity_group").value = "";
                    document.getElementById("quantity_post_of_group").value = "";

                }
            }
        } catch (error) {
            alert("Đã xảy ra lỗi trong quá trình gửi yêu cầu.");
            downloadDiv.innerHTML = `
                    <div class="alert alert-success">
                        Đã có dữ liệu về file này vui lòng xoá trước khi thực hiện
                    </div>
                `;
        }
    });

    document.getElementById('fanpage_form').addEventListener('submit', async function(e) {
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
                    downloadDiv.innerHTML = `
                    <div class="alert alert-success">
                        ${result.data.message}
                    </div>
                `;
                    document.getElementById("word_search_fanpage").value = "";
                    document.getElementById("quantity_fanpages").value = "";
                    document.getElementById("quantity_post_of_fanpage").value = "";

                }
            } else {
                if (result.detail) {
                    // Chèn link tải file vào div phía trên nút submit
                    downloadDiv.innerHTML = `
                    <div class="alert alert-success">
                        ${result.detail} hoặc đã có dữ liệu về file này vui lòng xoá trước khi thực hiện
                    </div>
                `;
                    document.getElementById("word_search_fanpage").value = "";
                    document.getElementById("quantity_fanpages").value = "";
                    document.getElementById("quantity_post_of_fanpage").value = "";

                }
            }

        } catch (error) {
            console.error("Error:", error);
            alert("Đã xảy ra lỗi trong quá trình gửi yêu cầu.");
        }
    });
</script>
@endsection