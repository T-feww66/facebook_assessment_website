@extends('layouts.user')

@section("title", "Cào dữ liệu comment từ facebook")
@section("header", "Cào dữ liệu từ API")

@section('content')
@include("user.includes.sidebar")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <h2 class="h2 fw-bold">API</h2>
            <!-- Chọn kiểu cào dữ liệu -->
            <div id="infomation" class="mb-3"></div>
            <div class="mb-3">
                <label for="crawl_type" class="form-label">Chọn kiểu cào dữ liệu:</label>
                <div class="form-check text-">
                    <input type="radio" class="form-check-input" id="crawl_group" name="crawl_type" value="group" checked>
                    <label class="form-check-label" for="crawl_group">Crawl Group</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="crawl_fanpage" name="crawl_type" value="fanpage">
                    <label class="form-check-label" for="crawl_fanpage">Crawl Fanpage</label>
                </div>
            </div>

            <!-- ==================FORM CRAWL GROUP URL ============================-->
            <form id="form_group_url" class="text_white" method="post" style="display:none;">
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
                        placeholder="Nhập vào thương hiệu cần tìm"
                        required>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="quantity_group_url" class="form-label">Số lượng group:</label>
                    <input type="number" class="form-control" id="quantity_group_url" name="quantity_group" min="1" max="20" placeholder="Nhập vào số lượng group muốn lấy (tối đa 20)" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Tìm kiếm</button>
            </form>

            <!-- ==================FORM CRAWL GROUP ============================-->
            <form id="group_form" class="mt-3" action="" method="POST" style="display:none;">
                @csrf
                <div id="selectGroup" class="row row-cols-2 g-3"></div>
                <label for="word_search_in_group" class="form-label">Từ khoá tìm kiếm:</label>
                <input type="text" class="form-control" id="word_search_in_group" name="word_search"
                    placeholder="Nhập vào từ khoá cần tìm trong thương hiệu"
                    required>
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
                    <input type="number" class="form-control" id="quantity_fanpage_url" name="quantity_fanpage" min="1" max="20" placeholder="Nhập vào số lượng fanpage muốn lấy (tối đa 20)" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Tìm kiếm</button>
            </form>

            <!-- ==================FORM CRAWL FANPAGES============================-->
            <form id="page_form" class="mt-3" action="" method="POST" style="display:block;">
                @csrf
                <div id="selectPage" class="row row-cols-2 g-3"></div>
                <label for="word_search_in_page" class="form-label">Từ khoá tìm kiếm:</label>
                <input type="text" class="form-control" id="word_search_in_page" name="word_search"
                    value=""
                    placeholder="Nhập vào từ khoá cần tìm trong thương hiệu"
                    required>
                <button type="submit" class="btn btn-primary mt-4">Lấy dữ liệu</button>
            </form>
        </div>
    </div>
</div>

<script>
    // const downloadDiv = document.getElementById("infomation"); // div thông báo

    const formGroupUrl = document.getElementById("form_group_url");
    const formFanpageUrl = document.getElementById("form_fanpage_url");

    const groupRadio = document.getElementById("crawl_group");
    const fanpageRadio = document.getElementById("crawl_fanpage");

    const brandInputGroup = document.getElementById("word_search_group");
    const quantityGroupUrl = document.getElementById("quantity_group_url");

    const brandInputPage = document.getElementById("word_search_pages");
    const brandPageValue = brandInputPage.value;
    const quantityPageUrl = document.getElementById("quantity_fanpage_url");


    const wordSearchInGroup = document.getElementById("word_search_in_group")
    const wordSearchInPage = document.getElementById("word_search_in_page")

    const formGroup = document.getElementById("group_form");
    const formPage = document.getElementById("page_form");

    const selectGroup = document.getElementById("selectGroup");
    const selectPage = document.getElementById("selectPage");

    function handleCheckboxChange(checkbox, name) {
        const checkboxWrapper = checkbox.closest('div'); // Lấy div chứa checkbox
        let hiddenInput = checkboxWrapper.querySelector('input[type="hidden"]'); // Tìm input hidden trong cùng div

        // Nếu checkbox được check và chưa có hidden input, tạo input hidden
        if (checkbox.checked) {
            if (!hiddenInput) { // Kiểm tra xem đã có hidden input chưa
                hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'crawl_url_name';
                hiddenInput.value = name;
                checkboxWrapper.appendChild(hiddenInput); // Thêm input hidden vào div chứa checkbox
            }
        } else {
            // Nếu checkbox bị uncheck, xóa input hidden
            if (hiddenInput) {
                hiddenInput.remove();
            }
        }
    }

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
        Swal.fire({
            title: 'Đang xử lý...',
            allowOutsideClick: () => !Swal.isLoading(),
            didOpen: () => {
                Swal.showLoading();
            }
        });


        const form = e.target;
        const formData = new FormData(form);

        // Nếu bạn cần truyền thêm api_key thì có thể thêm ở đây
        const apiKey = '{{ config("services.crawl_api.key") }}'; // Thay bằng API key thực tế nếu cần
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
                Swal.close();
                Swal.fire('Thành công!', 'Tìm kiếm thành công', 'success');
                formGroup.style.display = "block";

                // Xóa nội dung cũ nếu có
                selectGroup.innerHTML = "";
                let htmlContent = ""; // Biến lưu trữ HTML sẽ được chèn vào selectGroup

                result.forEach((item, index) => {
                    // Tạo HTML với dữ liệu từ item
                    htmlContent += `
                        <label for="group_url_${index}" class="card shadow-sm p-3 mb-3 col">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="${item.group_url}" id="group_url_${index}" name="crawl_url_link" class="form-check-input me-3" style="margin-top: 0;" onchange="handleCheckboxChange(this, '${item.group_name}')">
                                <img src="${item.group_image}" alt="Fanpage Avatar"
                                    class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-bold">${item.group_name}</h6>
                                    <a href="${item.group_url}" class="text-muted small" target="_blank">Nhấn vào đây để xem fanpage</a>
                                </div>
                            </div>
                        </label>
                    `;
                });
                brandInputGroup.value = ""
                selectGroup.innerHTML = htmlContent;
            }
            if (result.detail) {
                Swal.close();
                Swal.fire('Lỗi!', result.detail, 'error');
                selectPage.innerHTML = "";
            }

        } catch (err) {
            if (err.name === 'AbortError') {
                console.log("Yêu cầu bị hủy");
            } else {
                Swal.close();
                Swal.fire('Lỗi!', err.message, 'error');
            }
        }
    });

    // ======================CRAWL URL FANPAGES===========================
    document.getElementById('form_fanpage_url').addEventListener('submit', async function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Đang xử lý...',
            allowOutsideClick: () => !Swal.isLoading(),
            didOpen: () => {
                Swal.showLoading();
            }
        });


        const form = e.target;
        const formDataPage = new FormData(form);

        // Nếu bạn cần truyền thêm api_key thì có thể thêm ở đây
        const apiKey = '{{ config("services.crawl_api.key") }}'; // Thay bằng API key thực tế nếu cần

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
                Swal.close();
                Swal.fire('Thành công!', 'Xủ lí thành công', 'success');

                formPage.style.display = "block";

                // Xóa nội dung cũ nếu có
                selectPage.innerHTML = "";

                let htmlContent = ""; // Biến lưu trữ HTML sẽ được chèn vào selectPage

                result.forEach((item, index) => {
                    // Tạo HTML với dữ liệu từ item
                    htmlContent += `
                        <label for="fanpage_urls_${index}" class="card shadow-sm p-3 mb-3 col">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="${item.fanpage_url}" id="fanpage_urls_${index}" name="crawl_url_link" class="form-check-input me-3" style="margin-top: 0;" onchange="handleCheckboxChange(this, '${item.fanpage_name}')">
                                <img src="${item.fanpage_image}" alt="Fanpage Avatar"
                                    class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-bold">${item.fanpage_name}</h6>
                                    <a href="${item.fanpage_url}" class="text-muted small" target="_blank">Nhấn vào đây để xem fanpage</a>
                                </div>
                            </div>
                        </label>
                    `;
                });
                brandInputPage.value = ""

                // Chèn toàn bộ HTML vào selectPage
                selectPage.innerHTML = htmlContent;
            }

            if (result.detail) {
                Swal.close();
                Swal.fire('Lỗi!', result.detail, 'error');
                selectPage.innerHTML = "";
            }

        } catch (err) {
            if (err.name === 'AbortError') {
                console.log("Yêu cầu bị hủy");
            } else {
                Swal.close();
                Swal.fire('Lỗi!', err.message, 'error');
            }
        }
    });

    // ======================CRAWLle GROUP===========================
    document.getElementById('group_form').addEventListener('submit', async function(e) {
        e.preventDefault(); // Ngăn form gửi theo cách mặc định
        Swal.fire({
            title: 'Đang lấy dữ liệu và đánh giá, có thể mất ít phút, vui lòng đợi...',
            allowOutsideClick: () => !Swal.isLoading(), // ✅ chỉ cho click khi không loading
            didOpen: () => {
                Swal.showLoading();
            }
        });


        const form = e.target;
        const formData = new FormData(form);

        // Nếu bạn cần truyền thêm api_key thì có thể thêm ở đây
        const apiKey = '{{ config("services.crawl_api.key") }}'; // Thay bằng API key thực tế nếu cần

        const checked = form.querySelectorAll('input[name="crawl_url_link"]:checked');
        const name = form.querySelectorAll('input[name="crawl_url_name"]');

        if (checked.length === 0) {
            alert("Vui lòng chọn ít nhất một nhóm.");
            return;
        }

        checked.forEach(cb => {
            formData.append("crawl_url_link[]", cb.value);
        });

        name.forEach(cb => {
            formData.append("crawl_url_name[]", cb.value);
        });
        formData.append("brand_name", brandInputGroup.value);
        formData.append("word_search", wordSearchInGroup.value);
        formData.append("user_id", '{{Auth::id()}}');

        formGroup.style.display = "none";
        selectGroup.innerHTML = "";

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
                    Swal.close();
                    Swal.fire('Thành công!', result.data.message, 'success');
                }
            } else {
                if (result.detail) {
                    Swal.close();
                    Swal.fire('Lỗi!', result.detail, 'error');
                    selectPage.innerHTML = "";
                }
            }
        } catch (err) {
            if (err.name === 'AbortError') {
                console.log("Yêu cầu bị hủy");
            } else {
                Swal.close();
                Swal.fire('Lỗi!', err.message, 'error');
            }
        }
    });

    // ======================CRAWL FANPAGES===========================
    document.getElementById('page_form').addEventListener('submit', async function(e) {
        e.preventDefault(); // Ngăn form gửi theo cách mặc định
        Swal.fire({
            title: 'Đang lấy dữ liệu và đánh giá có thể mất ít phút vui lòng đợi',
            allowOutsideClick: () => !Swal.isLoading(), // ✅ chỉ cho click khi không loading
            didOpen: () => {
                Swal.showLoading();
            }
        });


        const form = e.target;
        const formData = new FormData(form);

        // Nếu bạn cần truyền thêm api_key thì có thể thêm ở đây
        const apiKey = '{{ config("services.crawl_api.key") }}'; // Thay bằng API key thực tế nếu cần

        const checked = form.querySelectorAll('input[name="crawl_url_link"]:checked');
        const name = form.querySelectorAll('input[name="crawl_url_name"]');

        if (checked.length === 0) {
            alert("Vui lòng chọn ít nhất một nhóm.");
            return;
        }


        checked.forEach(cb => {
            formData.append("crawl_url_link[]", cb.value);
        });

        name.forEach(cb => {
            formData.append("crawl_url_name[]", cb.value);
        });

        formData.append("brand_name", brandInputPage.value);
        formData.append("word_search", wordSearchInPage.value);
        formData.append("user_id", '{{Auth::id()}}');

        formPage.style.display = "none";
        selectPage.innerHTML = "";
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
                    if (result.data.message) {
                        Swal.close();
                        Swal.fire('Thành công!', result.data.message, 'success');
                    }
                }
            } else {
                if (result.detail) {
                    Swal.close();
                    Swal.fire('Lỗi!', result.detail, 'error');
                    selectPage.innerHTML = "";
                }
            }

        } catch (err) {
            if (err.name === 'AbortError') {
                console.log("Yêu cầu bị hủy");
            } else {
                Swal.close();
                Swal.fire('Lỗi!', err.message, 'error');
            }
        }
    });
</script>
@endsection