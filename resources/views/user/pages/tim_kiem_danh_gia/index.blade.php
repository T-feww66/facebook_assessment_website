<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm & Đánh Giá</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <header class="text-center mb-4">
            <h1>Tìm kiếm và Đánh giá Thương hiệu</h1>
            <input type="text" class="form-control" placeholder="Tìm thương hiệu..." id="searchBrand">
        </header>

        <section id="brandEvaluation" class="mt-4">
            <h2>Tổng quan đánh giá</h2>
            <p><strong>Cảm xúc:</strong> Tích cực</p>
            <p><strong>Từ khóa nổi bật:</strong> Chất lượng, Uy tín, Đổi mới</p>
            <p><strong>Phân tích AI:</strong> Phân tích chi tiết về cảm xúc và mức độ phổ biến của thương hiệu.</p>

            <h3>Biểu đồ Cảm Xúc</h3>
            <div class="d-flex justify-content-center">
                <canvas id="emotionChart" width="400" height="400"></canvas>
            </div>

            <h3>Từ khóa nổi bật</h3>
            <div class="d-flex justify-content-center">
                <div class="tag-cloud">
                    <span class="badge bg-secondary">Chất lượng</span>
                    <span class="badge bg-secondary">Uy tín</span>
                    <span class="badge bg-secondary">Đổi mới</span>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>