<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>So Sánh Thương Hiệu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <header class="text-center mb-4">
            <h1>So sánh Thương hiệu</h1>
            <p>Chọn 2-3 thương hiệu để so sánh cảm xúc, từ khóa và đánh giá.</p>
        </header>

        <div class="d-flex justify-content-center mb-4">
            <select class="form-select me-2" style="width: 200px;">
                <option selected>Thương hiệu 1</option>
                <option value="1">Thương hiệu 2</option>
                <option value="2">Thương hiệu 3</option>
            </select>
            <select class="form-select" style="width: 200px;">
                <option selected>Thương hiệu 2</option>
                <option value="1">Thương hiệu 1</option>
                <option value="2">Thương hiệu 3</option>
            </select>
        </div>

        <section id="comparisonResults">
            <h2>So sánh kết quả</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Biểu đồ Cảm Xúc</h3>
                    <div class="d-flex justify-content-center">
                        <canvas id="comparisonEmotionChart" width="400" height="400"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Từ khóa nổi bật</h3>
                    <div class="tag-cloud">
                        <span class="badge bg-secondary">Chất lượng</span>
                        <span class="badge bg-secondary">Uy tín</span>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
