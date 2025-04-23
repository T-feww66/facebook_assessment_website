@extends('layouts.admin')

@section("title", "Cào dữ liệu comment từ facebook")
@section("header", "Cào dữ liệu từ API")

@section('content')
<h2 class="h2 fw-bold">API</h2>
<!-- Chọn kiểu cào dữ liệu -->
<div id="infomation" class="mb-3"></div>
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

<!-- ==================FORM CRAWL GROUP URL ============================-->
<form id="form_group_url" method="post" style="display:none;">
    <div class="mb-3">
        <label for="word_search_group" class="form-label">Từ khoá tìm kiếm:</label>
        @if(isset($brand_name))
        <input type="text" class="form-control" id="word_search_group" name="word_search_group"
            value="{{ $brand_name }}"
            placeholder="Nhập vào thương hiệu cần tìm"
            readonly
            required>
        @else
        <input type="text" class="form-control" id="word_search_group" name="word_search_group"
            value=""
            placeholder="Nhập vào thương hiệu cần tìm"
            required>
        @endif
    </div>
    <div class="mb-3">
        <label for="quantity_group_url" class="form-label">Số lượng group:</label>
        <input type="number" class="form-control" id="quantity_group_url" name="quantity_group" min="1" max="10" placeholder="Nhập vào số lượng group muốn lấy (tối đa 10)" required>
    </div>
    <button type="submit" class="btn btn-primary mt-4">Tìm kiếm</button>
</form>

<!-- ==================FORM CRAWL GROUP ============================-->
<form id="group_form" class="mt-3" action="" method="POST" style="display:none;">
    @csrf
    <div id="selectGroup"></div>
    <button type="submit" class="btn btn-primary mt-4">Lấy dữ liệu</button>
</form>


<!-- ==================FORM CRAWL FANPAGES URL============================-->
<form id="form_fanpage_url" method="post" style="display:none;">
    <div class="mb-3">
        <label for="word_search_pages" class="form-label">Từ khoá tìm kiếm:</label>
        @if(isset($brand_name))
        <input type="text" class="form-control" id="word_search_pages" name="word_search_pages"
            value="{{ $brand_name }}"
            placeholder="Nhập vào thương hiệu cần tìm"
            readonly
            required>
        @else
        <input type="text" class="form-control" id="word_search_pages" name="word_search_pages"
            value=""
            placeholder="Nhập vào thương hiệu cần tìm"
            required>
        @endif
    </div>

    <div class="mb-3">
        <label for="quantity_fanpage_url" class="form-label">Số lượng fanpages:</label>
        <input type="number" class="form-control" id="quantity_fanpage_url" name="quantity_fanpage" min="1" max="10" placeholder="Nhập vào số lượng fanpage muốn lấy (tối đa 10)" required>
    </div>
    <button type="submit" class="btn btn-primary mt-4">Tìm kiếm</button>
</form>

<!-- ==================FORM CRAWL FANPAGES============================-->
<form id="page_form" class="mt-3" action="" method="POST" style="display:none;">
    @csrf
    <div id="selectPage"></div>
    <button type="submit" class="btn btn-primary mt-4">Lấy dữ liệu</button>
</form>


<script>
    const downloadDiv = document.getElementById("infomation"); // div thông báo

    const formGroupUrl = document.getElementById("form_group_url");
    const formFanpageUrl = document.getElementById("form_fanpage_url");

    const groupRadio = document.getElementById("crawl_group");
    const fanpageRadio = document.getElementById("crawl_fanpage");

    const brandInputGroup = document.getElementById("word_search_group");
    const brandInputPage = document.getElementById("word_search_pages");

    const formGroup = document.getElementById("group_form");
    const formPage = document.getElementById("page_form");

    const selectGroup = document.getElementById("selectGroup");
    const selectPage = document.getElementById("selectPage");



    function toggleCrawlOptions() {

        if (groupRadio.checked) {
            formGroupUrl.style.display = "block";
            formFanpageUrl.style.display = "none";
            formGroup.style.display = "none";
            formPage.style.display = "none";
        } else {
            formGroupUrl.style.display = "none";
            formFanpageUrl.style.display = "block";
            formGroup.style.display = "none";
            formPage.style.display = "none";
        }
    }
    window.addEventListener("DOMContentLoaded", () => {
        toggleCrawlOptions();
        groupRadio.addEventListener("change", toggleCrawlOptions);
        fanpageRadio.addEventListener("change", toggleCrawlOptions);

    });

    // ======================CRAWL URL GROUP===========================
    document.getElementById('form_group_url').addEventListener('submit', async function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        // Nếu bạn cần truyền thêm api_key thì có thể thêm ở đây
        const apiKey = '{{ config("services.crawl_api.key") }}'; // Thay bằng API key thực tế nếu cần

        downloadDiv.innerHTML = `
            <div class="alert alert-info" role="alert">
                ⏳ Đang tiến hành quá trình lấy dữ liệu vui lòng chờ giây lát...
            </div>
        `;
        try {
            const response = await fetch("http://localhost:60074/crawl/get_url_groups", {
                method: "POST",
                headers: {
                    "API-Key": apiKey
                },
                body: formData
            });

            const result = await response.json();

            if (result) {
                downloadDiv.innerHTML = "";
                formGroup.style.display = "block";

                // Xóa nội dung cũ nếu có
                selectGroup.innerHTML = "";

                result.forEach(item => {
                    const label = document.createElement("label");
                    label.style.display = "block";

                    const checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.name = "group_urls";
                    checkbox.value = item.group_url;

                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(" " + item.group_name));

                    selectGroup.appendChild(label);
                });

            }


        } catch (error) {
            alert("Đã xảy ra lỗi trong quá trình gửi yêu cầu.");
            console.log(error)
        }
    });

    // ======================CRAWL URL FANPAGES===========================
    document.getElementById('form_fanpage_url').addEventListener('submit', async function(e) {
        e.preventDefault();

        const form = e.target;
        const formDataPage = new FormData(form);

        // Nếu bạn cần truyền thêm api_key thì có thể thêm ở đây
        const apiKey = '{{ config("services.crawl_api.key") }}'; // Thay bằng API key thực tế nếu cần

        downloadDiv.innerHTML = `
            <div class="alert alert-info" role="alert">
                ⏳ Đang tiến hành quá trình lấy dữ liệu vui lòng chờ giây lát...
            </div>
        `;
        try {
            const response = await fetch("http://localhost:60074/crawl/get_url_fanpages", {
                method: "POST",
                headers: {
                    "API-Key": apiKey
                },
                body: formDataPage
            });

            const result = await response.json();

            if (result) {
                console.log(result)
                downloadDiv.innerHTML = "";
                formPage.style.display = "block";

                // Xóa nội dung cũ nếu có
                selectPage.innerHTML = "";

                result.forEach(item => {
                    const label = document.createElement("label");
                    label.style.display = "block";

                    const checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.name = "fanpage_urls";
                    checkbox.value = item.fanpage_url;

                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(" " + item.fanpage_name));

                    selectPage.appendChild(label);
                });

            }
        } catch (error) {
            alert("Đã xảy ra lỗi trong quá trình gửi yêu cầu.");
            console.log(error)
        }
    });

    // ======================CRAWLle GROUP===========================
    document.getElementById('group_form').addEventListener('submit', async function(e) {
        e.preventDefault(); // Ngăn form gửi theo cách mặc định
        
        const form = e.target;
        const formData = new FormData(form);
        
        // Nếu bạn cần truyền thêm api_key thì có thể thêm ở đây
        const apiKey = '{{ config("services.crawl_api.key") }}'; // Thay bằng API key thực tế nếu cần
        
        downloadDiv.innerHTML = `
        <div class="alert alert-info" role="alert">
        ⏳ Đang tiến hành cào dữ liệu, vui lòng chờ giây lát...
        </div>
        `;
        const checked = form.querySelectorAll('input[name="group_urls"]:checked');
        
        if (checked.length === 0) {
            alert("Vui lòng chọn ít nhất một nhóm.");
            downloadDiv.innerHTML = "";
            return;
        }
        
        checked.forEach(cb => {
            formData.append("group_urls[]", cb.value);
        });
        formData.append("word_search", brandInputGroup.value);
        
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
                    formGroup.style.display = "none";
                    selectGroup.innerHTML = "";

                    downloadDiv.innerHTML = `
                    <div class="alert alert-success">
                        ${result.data.message}
                        </div>
                `;
            }
            } else {
                if (result.detail) {
                    // Chèn link tải file vào div phía trên nút submit
                    downloadDiv.innerHTML = `
                    <div class="alert alert-success">
                        ${result.detail} hoặc đã có dữ liệu về file này vui lòng xoá trước khi thực hiện
                        </div>
                        `;
                        selectGroup.innerHTML = "";

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
    
    // ======================CRAWL FANPAGES===========================
    document.getElementById('page_form').addEventListener('submit', async function(e) {
        e.preventDefault(); // Ngăn form gửi theo cách mặc định

        const form = e.target;
        const formData = new FormData(form);

        // Nếu bạn cần truyền thêm api_key thì có thể thêm ở đây
        const apiKey = '{{ config("services.crawl_api.key") }}'; // Thay bằng API key thực tế nếu cần

        downloadDiv.innerHTML = `
            <div class="alert alert-info" role="alert">
                ⏳ Đang tiến hành cào dữ liệu, vui lòng chờ giây lát...
            </div>
        `;
        const checked = form.querySelectorAll('input[name="fanpage_urls"]:checked');

        if (checked.length === 0) {
            alert("Vui lòng chọn ít nhất một nhóm.");
            downloadDiv.innerHTML = "";
            return;
        }

        checked.forEach(cb => {
            formData.append("fanpage_urls[]", cb.value);
        });
        formData.append("word_search", brandInputPage.value);

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
                    formPage.style.display = "none";
                    selectPage.innerHTML = "";

                    downloadDiv.innerHTML = `
                    <div class="alert alert-success">
                        ${result.data.message}
                    </div>
                `;
                }
            } else {
                if (result.detail) {
                    // Chèn link tải file vào div phía trên nút submit
                    downloadDiv.innerHTML = `
                    <div class="alert alert-success">
                        ${result.detail} hoặc đã có dữ liệu về file này vui lòng xoá trước khi thực hiện
                    </div>
                `;

                    selectPage.innerHTML = "";
                }
            }

        } catch (error) {
            console.error("Error:", error);
            alert("Đã xảy ra lỗi trong quá trình gửi yêu cầu.");
        }
    });
</script>
@endsection