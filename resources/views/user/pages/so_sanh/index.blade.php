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

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const compareForm = document.getElementById("evaluateCompareForm");

    compareForm.addEventListener("submit", async function (e) {
      e.preventDefault(); // Ngăn reload trang
      await compareBrands();
    });
  });

  async function compareBrands() {
    const form = document.getElementById("evaluateCompareForm");
    const brand1 = form.elements["brand1"].value;
    const brand2 = form.elements["brand2"].value;
    const resultDiv = document.getElementById("markdown-evaluete-compare");

    const apiKey = '{{ config("services.crawl_api.key") }}';

    if (!brand1 || !brand2) {
      alert("Vui lòng chọn đầy đủ hai thương hiệu.");
      return;
    }

    resultDiv.innerText = 'Đang xử lý...';

    const formData = new FormData();
    formData.append("brand1", brand1);
    formData.append("brand2", brand2);

    try {
      const response = await fetch('http://localhost:60074/danh_gia_thuong_hieu/so_sanh_thuong_hieu', {
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
          resultDiv.innerHTML = `<div class="alert alert-warning">Không có dữ liệu so sánh.</div>`;
        }
      } else {
        resultDiv.innerHTML = `<div class="alert alert-danger">${result.detail || "Đã xảy ra lỗi khi so sánh."}</div>`;
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
