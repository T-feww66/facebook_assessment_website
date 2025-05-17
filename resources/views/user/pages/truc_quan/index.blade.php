@extends('layouts.user')

@section("title", "Tìm Kiếm Đánh Giá")

@section('content')
@include("user.includes.sidebar")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="text-center mb-4">
                <h2 class="fw-bold">Tìm Kiếm Đánh Giá</h2>
                <p>Nhập từ khóa để tra cứu đánh giá của thương hiệu bạn quan tâm.</p>
            </div>

            <!-- Form tìm kiếm -->
            <form id="evaluateForm" class="mb-3">
                <div class="mb-3">
                    <label for="brandInput">Thương hiệu</label>
                    <input id="brandInput"
                        class="form-control me-1"
                        value="{{ $brand_name ?? '' }}"
                        type="search"
                        placeholder="🔍 Nhập tên thương hiệu..."
                        aria-label="Thương hiệu"
                        {{ $brand_name || $word_search ? 'readonly' : '' }}>
                </div>

                <div class="mb-3">
                    <label for="wordSearchInput">Từ khoá</label>
                    <input id="wordSearchInput"
                        class="form-control me-1"
                        value="{{ $word_search ?? '' }}"
                        type="search"
                        placeholder="🔍 Nhập từ khoá..."
                        aria-label="Từ khoá"
                        {{ $brand_name || $word_search ? 'readonly' : '' }}>
                </div>

                <button class="btn btn-success" type="submit">Search</button>
            </form>

            <div id="result-brand"></div>

            <div id="chart_grid_id" class="none mt-5">
                <!-- Card  -->
                <div class="row">

                    <!-- card tên thương hiệu đánh giá  -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Tên thương hiệu</p>
                                        <h4 class="mb-2" id="brand_name"></h4>
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-store-2-line font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- card từ ngữ đánh giá đánh giá  -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Từ ngữ đánh giá</p>
                                        <h4 class="mb-2" id="word_search">{{$word_search}}</h4>
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-text font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- card tổng số comment  -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Tổng số bình luận phân tích</p>
                                        <h4 class="mb-2" id="tong_binh_luan">
                                        </h4>
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-chat-4-line font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- card phần trăm tốt dựa trên comment  -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Phần trăm tốt (bình luận)</p>
                                        <h4 class="mb-2" id="phan_tram_tot">
                                        </h4>
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-thumb-up-line font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- card phần trăm xấu dựa trên comment  -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Phần trăm xấu (bình luận)</p>
                                        <h4 class="mb-2" id="phan_tram_xau">
                                        </h4>
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-thumb-down-line font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- card độ tin cậy dựa trên comment  -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Độ tin cậy (bình luận)</p>
                                        <h4 class="mb-2" id="do_tin_cay">
                                        </h4>
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-heart-line font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- card tổng số reaction của các bài viết  -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Tổng số reaction phân tích (emoji)</p>
                                        <h4 class="mb-2" id="tong_so_reaction">
                                        </h4>
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-tv-line font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- card phần trăm tích cực dựa trên emoji  -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Cảm xúc tích cực (emoji)</p>
                                        <h4 class="mb-2" id="cam_xuc_tich_cuc_emoji">
                                        </h4>
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-heart-2-line font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- card phần trăm tiêu cực dựa trên emoji  -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Cảm xúc tiêu cực (emoji)</p>
                                        <h4 class="mb-2" id="cam_xuc_tieu_cuc_emoji">
                                        </h4>
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-close-line font-size-24"></i>

                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- card từ tốt lặp lại nhiều nhất -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Từ tốt được lặp lại nhiều nhất (top 1)</p>
                                        <h4 class="mb-2" id="tu_tot_nhieu_nhat">
                                        </h4>
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-font-color font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- card từ xáu xuất hiện nhiều nhất -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Từ xấu xuất hiện nhiều nhất (top 1)</p>
                                        <h4 class="mb-2" id="tu_xau_nhieu_nhat">
                                        </h4>
                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-bold font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                </div><!-- end row -->

                <!-- Biểu đồ (Chart) -->
                <div class="row">
                    <!-- Biểu đồ wordCloudChart thể hiện từ tốt phổ biến -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="wordCloudChartGood"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ wordCloudChart thể hiện từ xấu phổ biến -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="chart-card">
                                    <canvas width="500" height="500" id="wordCloudChartBad"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ pie chart phần trăm cảm xúc  -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="chart-card">
                                    <canvas width="500" height="500" id="pieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ tròn (Pie chart) – Phân phối emoji theo tỷ lệ  -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="ty_le_cam_xuc_emoji"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ pie chart tỷ lệ bài viết từ group và pages  -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="ty_le_bai_viet_group_page"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ horizontal-bar-chart số lượng bài viết từ group và pages  -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="so_luong_bai_viet_group_page"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ horizontal-bar-chart trung bình tốt xấu từ group và pages  -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="trung_binh_tot_xau_group_page"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ horizontal-bar-chart số lượng comment group và pages  -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="so_luong_comment_group_page"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ horizontal-bar-chart số lượng bài viết theo word_search -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="so_luong_bai_viet_word_search"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ Stacked bar chart thể hiện Phân bổ cảm xúc theo từng từ khoá tìm kiếm -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="cam_xuc_theo_tu_khoa"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ barchart thể hiện số lượng cảm xúc (tốt xấu)  -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="chart-card">
                                    <canvas width="500" height="500" id="wordChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ barchart thể hiện số lượng cảm xúc icon theo word_search của thương  hiệu  -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="chart-card">
                                    <canvas width="500" height="500" id="so_luong_cam_xuc_emoji"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ thể hiện top 10 từ xấu phổ biến -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="chart-card">
                                    <canvas width="500" height="500" id="top_10_xau"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ thể hiện top 10 từ xấu phổ biến -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <div class="chart-card">
                                    <canvas width="500" height="500" id="top_10_tot"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ thể hiện top 5 từ xấu phổ biến -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="top_5_xau_pho_bien"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ thể hiện top 5 từ tốt phổ biến -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="top_5_tot_pho_bien"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ lineChart thể hiện tỷ lệ cảm xúc theo thời gian -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ lineChart thể hiện cảm xúc theo năm -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="cam_xuc_theo_nam"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ lineChart thể hiện số lượng comment theo thời gian -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="so_luong_comment_theo_thoi_gian"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ lineChart biến động emoji theo thời gian -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="bien_dong_emoji"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ box-plot thể hiện số lượng tốt xấu trung bình trên mỗi comment -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-card">
                                    <canvas width="500" height="500" id="so_luong_tot_xau_tren_comment"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    "use strict";

    // Các biến thể hiện của biểu đồ

    // các biểu đồ tròn
    let bieu_do_pie_post_group_page = null;
    let bieu_do_ty_le_cam_xuc_emoji = null
    let sentimentChart = null;

    // các biểu đồ cột ngang và đứng
    let bieu_do_horizontal_bar_chart_post_group_page = null
    let bieu_do_horizontal_bar_chart_comment_group_page = null
    let bieu_do_trung_binh_tot_xau_group_page = null
    let bieu_do_horizontal_bar_chart_post_word_search = null
    let bieu_do_cam_xuc_theo_tu_khoa = null
    let wordChartCoutChart = null;
    let bieu_do_top_10_tot = null
    let bieu_do_top_10_xau = null
    let bieu_do_tot_xau_tren_comment = null
    let bieu_do_top_5_tot_pho_bien = null
    let bieu_do_top_5_xau_pho_bien = null
    let bieu_do_so_luong_cam_xuc_emoji = null

    // biểu đồ wordCloud
    let wordCloudChartGood = null;
    let wordCloudChartBad = null;

    // biểu đồ linechart
    let lineChart = null;
    let bieu_do_line_chart_comment_time = null
    let bieu_do_cam_xuc_theo_nam = null
    let bieu_do_bien_dong_emoji = null


    // === CẤU HÌNH CHUNG ===
    const titleConfig = (text, size = 24) => ({
        display: true,
        text,
        color: '#333',
        font: {
            size
        }
    });

    const axisConfig = (label) => ({
        title: {
            display: true,
            text: label,
            color: '#333',
            font: {
                size: 16
            }
        },
        ticks: {
            color: '#333'
        }
    });

    const optionsWordChart = (label, size = 28) => ({
        color: '#333',
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: label,
                color: '#333',
                font: {
                    size
                }
            },
            wordCloud: {
                minFontSize: 10, // chữ nhỏ nhất
                maxFontSize: 40 // chữ lớn nhất – KHÔNG để quá lớn (vd: 80)
            },
        }
    })




    // === BIỂU ĐỒ PIE: tỷ lệ bài viết từ group và page ===
    function show_bieu_do_pie_post_group_page(group, page) {
        if (bieu_do_pie_post_group_page) bieu_do_pie_post_group_page.destroy();

        const ctx = document.getElementById('ty_le_bai_viet_group_page').getContext('2d');

        const data = [group, page];
        const labels = ['Group', 'Fanpage'];
        const backgroundColors = ['#2196F3', '#FFC107'];

        bieu_do_pie_post_group_page = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#000',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: value => typeof value === "number" ? value.toFixed(2) + '%' : value
                    },
                    title: titleConfig(`Biểu đồ thể hiện tỷ lệ bài viết trong Group và Fanpages`, 28),
                    legend: {
                        labels: {
                            boxWidth: 20,
                            font: {
                                size: 16
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    // === Biểu đồ tròn (Pie chart) – Phân phối emoji  ===
    function show_bieu_do_ty_le_cam_xuc_emoji(data_emoji) {
        if (bieu_do_ty_le_cam_xuc_emoji) bieu_do_ty_le_cam_xuc_emoji.destroy();

        const ctx = document.getElementById('ty_le_cam_xuc_emoji').getContext('2d');

        // Bỏ "Tất cả" và chuyển đổi key sang emoji nếu cần
        const emojiMap = {
            "Thích": "👍",
            "Haha": "😂",
            "Buồn": "😢",
            "Phẫn nộ": "😡",
            "Yêu thích": "❤️",
            "Ngạc nhiên": "😮",
            "Thương thương": "🥰"
        };

        const filtered = Object.entries(data_emoji).filter(([key]) => key !== "Tất cả");

        const labels = filtered.map(([key]) => emojiMap[key] || key);
        const values = filtered.map(([_, value]) => value);

        const backgroundColors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
            '#9966FF', '#FF9F40', '#66D4A3', '#F67019'
        ];

        bieu_do_ty_le_cam_xuc_emoji = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: backgroundColors.slice(0, labels.length),
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#000',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value, ctx) => {
                            const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            return `${((value / total) * 100).toFixed(1)}%`;
                        }
                    },
                    title: titleConfig('Biểu đồ tỷ lệ cảm xúc (emoji)', 28),
                    legend: {
                        labels: {
                            boxWidth: 20,
                            font: {
                                size: 16
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }


    // === BIỂU ĐỒ: số lượng bài viết từ group và page ===
    function show_bieu_do_horizontal_bar_chart_post_group_page(group, page) {
        if (bieu_do_horizontal_bar_chart_post_group_page) bieu_do_horizontal_bar_chart_post_group_page.destroy();

        const ctx = document.getElementById('so_luong_bai_viet_group_page').getContext('2d');
        bieu_do_horizontal_bar_chart_post_group_page = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Group', 'Fanpages'],
                datasets: [{
                    axis: 'y',
                    label: 'Số lượng bài viết',
                    data: [group, page],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)', // Xanh ngọc
                        'rgba(255, 206, 86, 0.2)' // Vàng sáng
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    hoverBackgroundColor: [
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 206, 86, 0.5)'
                    ],
                    borderWidth: 1

                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value) => value // không có dấu %
                    },
                    title: titleConfig('Biểu đồ thể hiện số lượng bài viết của group và fanpage', 24),
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: axisConfig("Số lượng"),
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    // === BIỂU ĐỒ bar h: số lượng comment từ group và page ===
    function show_bieu_do_horizontal_bar_chart_comment_group_page(group, page) {
        if (bieu_do_horizontal_bar_chart_comment_group_page) bieu_do_horizontal_bar_chart_comment_group_page.destroy();

        const ctx = document.getElementById('so_luong_comment_group_page').getContext('2d');
        bieu_do_horizontal_bar_chart_comment_group_page = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Group', 'Fanpages'],
                datasets: [{
                    label: 'Số lượng comments',
                    data: [group, page],
                    backgroundColor: ['rgba(255, 159, 64, 0.2)', 'rgba(153, 102, 255, 0.2)'],
                    borderColor: ['rgba(255, 159, 64, 1)', 'rgba(153, 102, 255, 1)'],
                    borderWidth: 1,
                    hoverBackgroundColor: ['rgba(255, 159, 64, 0.5)', 'rgba(153, 102, 255, 0.5)']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value) => value // không có dấu %
                    },
                    title: titleConfig('Biểu đồ thể hiện số lượng comments của group và fanpage', 24),
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: axisConfig("Số lượng"),
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    function show_trung_binh_tot_xau_group_page(groupData, pageData) {
        if (bieu_do_trung_binh_tot_xau_group_page) bieu_do_trung_binh_tot_xau_group_page.destroy();

        const ctx = document.getElementById('trung_binh_tot_xau_group_page').getContext('2d');
        bieu_do_trung_binh_tot_xau_group_page = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tốt', 'Xấu'], // 2 nhãn cho mỗi nhóm
                datasets: [{
                        label: 'Group',
                        data: [groupData.avgTot, groupData.avgXau],
                        backgroundColor: ['rgba(75, 192, 192, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                        borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Fanpage',
                        data: [pageData.avgTot, pageData.avgXau],
                        backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)'],
                        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value) => value + '%'
                    },
                    title: titleConfig('Biểu đồ trung bình % đánh giá Tốt và Xấu theo nguồn Group và Fanpage', 20),
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Loại đánh giá'
                        },
                        stacked: false
                    },
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: {
                            display: true,
                            text: '% đánh giá'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }



    // === BIỂU ĐỒ PIE: tỷ lệ bài viết từ group và page ===
    function show_bieu_do_horizontal_bar_chart_post_word_search(words, values) {
        if (bieu_do_horizontal_bar_chart_post_word_search) bieu_do_horizontal_bar_chart_post_word_search.destroy();

        const ctx = document.getElementById('so_luong_bai_viet_word_search').getContext('2d');

        // Hàm tạo màu sắc random (hoặc có thể dùng bảng màu cố định nếu muốn)
        const generateColors = (length) => {
            const backgroundColors = [];
            const borderColors = [];
            const hoverColors = [];

            const baseColors = [
                [255, 99, 132],
                [54, 162, 235],
                [255, 206, 86],
                [75, 192, 192],
                [153, 102, 255],
                [255, 159, 64]
            ];

            for (let i = 0; i < length; i++) {
                const color = baseColors[i % baseColors.length];
                backgroundColors.push(`rgba(${color[0]}, ${color[1]}, ${color[2]}, 0.2)`);
                borderColors.push(`rgba(${color[0]}, ${color[1]}, ${color[2]}, 1)`);
                hoverColors.push(`rgba(${color[0]}, ${color[1]}, ${color[2]}, 0.5)`);
            }

            return {
                backgroundColors,
                borderColors,
                hoverColors
            };
        };

        const {
            backgroundColors,
            borderColors,
            hoverColors
        } = generateColors(words.length);

        bieu_do_horizontal_bar_chart_post_word_search = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: words,
                datasets: [{
                    label: 'Số lượng bài viết',
                    data: values,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    hoverBackgroundColor: hoverColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value) => value
                    },
                    title: titleConfig('Biểu đồ thể hiện số lượng bài viết theo từ khóa', 24),
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: axisConfig("Số lượng")
                }
            },
            plugins: [ChartDataLabels]
        });
    }


    // === BIỂU ĐỒ PIE: CẢM XÚC ===
    function showSentimentChart(positive, negative) {
        if (sentimentChart) sentimentChart.destroy();

        const ctx = document.getElementById('pieChart').getContext('2d');
        const data = [positive, negative];
        const labels = ['Tích cực', 'Tiêu cực'];
        const backgroundColors = ['#ff81b7', '#9792e8'];

        sentimentChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#000',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: value => typeof value === "number" ? value.toFixed(2) + '%' : value
                    },
                    title: titleConfig('Biểu đồ thể hiện tỷ lệ cảm xúc', 28),
                    legend: {
                        labels: {
                            boxWidth: 20,
                            font: {
                                size: 16
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    // === BIỂU ĐỒ CỘT: TỪ TỐT/XẤU ===
    function showWordCountChart(tuTot, tuXau) {
        if (wordChartCoutChart) wordChartCoutChart.destroy();

        const ctx = document.getElementById('wordChart').getContext('2d');
        wordChartCoutChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Từ Tốt', 'Từ Xấu'],
                datasets: [{
                    label: 'Số lượng từ',
                    data: [tuTot.length, tuXau.length],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', // Đỏ hồng
                        'rgba(54, 162, 235, 0.2)' // Xanh dương
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    hoverBackgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value) => value // không có dấu %
                    },
                    title: titleConfig('Biểu đồ thể hiện số lượng từ tốt và từ xấu', 24),
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: axisConfig("Số lượng"),
                    x: axisConfig("Loại từ")
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    // === BIỂU ĐỒ CỘT: HIỂN THỊ TỔNG SỐ LƯỢNG EMOJI CỦA WORD_SEARCH TRONG THƯƠNG HIỆU ===
    function show_bieu_do_so_luong_cam_xuc_emoji(data_emoji) {
        if (bieu_do_so_luong_cam_xuc_emoji) bieu_do_so_luong_cam_xuc_emoji.destroy();

        const ctx = document.getElementById('so_luong_cam_xuc_emoji').getContext('2d');

        const filteredEntries = Object.entries(data_emoji).filter(([key, _]) => key !== "Tất cả");
        const labels = filteredEntries.map(([key, _]) => key);
        const values = filteredEntries.map(([_, value]) => value);


        bieu_do_so_luong_cam_xuc_emoji = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Số lượng cảm xúc',
                    data: values,
                    backgroundColor: 'rgba(153, 102, 255, 0.5)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1,
                    hoverBackgroundColor: 'rgba(153, 102, 255, 0.7)',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value) => value
                    },
                    title: titleConfig('Biểu đồ số lượng cảm xúc bài đăng', 24),
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: axisConfig("Số lượng cảm xúc"),
                    x: axisConfig("Loại cảm xúc")
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    // === BIỂU ĐỒ WordCloud: TỪ TỐT/XẤU ===
    function showWordCloudChartGood(words) {
        const topWords = words.slice(0, 50); // Giới hạn số từ

        const weights = topWords.map(d => d.weight);
        const min = Math.min(...weights);
        const max = Math.max(...weights);

        const scaledWeights = weights.map(w => {
            const normalized = max !== min ? (w - min) / (max - min) : 0.5;
            return 18 + normalized * 18; // font size từ 12 đến 30
        });

        wordCloudChartGood?.destroy();

        const ctx = document.getElementById("wordCloudChartGood");
        wordCloudChartGood = new Chart(ctx, {
            type: "wordCloud",
            data: {
                labels: topWords.map(w => w.word),
                datasets: [{
                    label: 'Từ tích cực phổ biến',
                    data: scaledWeights,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    function showWordCloudChartBad(words) {
        const topWords = words.slice(0, 50); // Giới hạn số từ

        const weights = topWords.map(d => d.weight);
        const min = Math.min(...weights);
        const max = Math.max(...weights);

        const scaledWeights = weights.map(w => {
            const normalized = max !== min ? (w - min) / (max - min) : 0.5;
            return 18 + normalized * 18; // font size từ 12 đến 30
        });

        wordCloudChartBad?.destroy();

        const ctx = document.getElementById("wordCloudChartBad");
        wordCloudChartBad = new Chart(ctx, {
            type: "wordCloud",
            data: {
                labels: topWords.map(w => w.word),
                datasets: [{
                    label: 'Từ tiêu cực phổ biến',
                    data: scaledWeights,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }


    // === BIỂU ĐỒ CỘT: TỪ TỐT/XẤU ===
    function show_top_10_xau(words, weights) {
        if (bieu_do_top_10_xau) bieu_do_top_10_xau.destroy();

        const ctx = document.getElementById('top_10_xau').getContext('2d');
        bieu_do_top_10_xau = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: words, // Tên các từ tiêu cực
                datasets: [{
                    label: 'Số lượng từ',
                    data: weights, // Số lần xuất hiện của các từ
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Xanh lá cây nhạt
                    borderColor: 'rgba(75, 192, 192, 1)', // Xanh lá cây đậm
                    hoverBackgroundColor: 'rgba(75, 192, 192, 0.5)', // Xanh lá cây khi hover
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value) => value // Hiển thị giá trị số mà không có dấu %
                    },
                    title: {
                        display: true,
                        text: 'Top 10 từ tiêu cực xuất hiện nhiều',
                        font: {
                            size: 24
                        },
                        color: '#333'
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Số lượng'
                        },
                        beginAtZero: true,
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Từ Tiêu Cực'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    // === BIỂU ĐỒ CỘT: TỪ TỐT/XẤU ===
    function show_top_10_tot(words, weights) {
        if (bieu_do_top_10_tot) bieu_do_top_10_tot.destroy();

        const ctx = document.getElementById('top_10_tot').getContext('2d');
        bieu_do_top_10_tot = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: words, // Tên các từ tiêu cực
                datasets: [{
                    label: 'Số lượng từ',
                    data: weights, // Số lần xuất hiện của các từ
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    hoverBackgroundColor: 'rgba(255, 159, 64, 0.5)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value) => value // Hiển thị giá trị số mà không có dấu %
                    },
                    title: {
                        display: true,
                        text: 'Top 10 từ tích cực phổ biến nhất',
                        font: {
                            size: 24
                        },
                        color: '#333'
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Số lượng'
                        },
                        beginAtZero: true,
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Từ Tiêu Cực'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    // === BIỂU ĐỒ: TOP 5 TỪ TÍCH CỰC PHỔ BIẾN NHẤT ===
    function show_top_5_tot_pho_bien(topPositiveComments) {
        // Hủy biểu đồ cũ nếu có
        if (bieu_do_top_5_tot_pho_bien) bieu_do_top_5_tot_pho_bien.destroy();

        const totalPositive = topPositiveComments.reduce((sum, item) => sum + (item.positiveCount || 0), 0);

        // Nếu không có dữ liệu tích cực
        const hasData = totalPositive > 0;

        const labels = hasData ?
            topPositiveComments.map(item => item.comment.length > 50 ? item.comment.substring(0, 10) + '...' : item.comment) : ["Không có dữ liệu"];

        const data = hasData ?
            topPositiveComments.map(item => item.positiveCount) : [0];

        const backgroundColor = hasData ?
            'rgba(255, 99, 132, 0.2)' :
            'rgba(200, 200, 200, 0.3)';

        const borderColor = hasData ?
            'rgba(255, 99, 132, 1)' :
            'rgba(160, 160, 160, 0.5)';

        const ctx = document.getElementById('top_5_tot_pho_bien').getContext('2d');
        bieu_do_top_5_tot_pho_bien = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Từ tích cực',
                    data: data,
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    borderWidth: 1,
                    hoverBackgroundColor: hasData ? 'rgba(255, 99, 132, 0.6)' : backgroundColor,
                }]
            },
            options: {
                ...optionsWordChart("Top 5 bình luận tích cực phổ biến nhất", 28, hasData),
                onClick: function(event, elements) {
                    if (hasData && elements.length > 0) {
                        const index = elements[0].index;
                        const fullComment = topPositiveComments[index].comment;
                        alert(`Bình luận đầy đủ: ${fullComment}`);
                    }
                },
            }
        });
    }


    // === BIỂU ĐỒ: TOP 5 TỪ TÍCH CỰC PHỔ BIẾN NHẤT ===
    function show_top_5_xau_pho_bien(topNegativeComments) {
        // Hủy biểu đồ cũ nếu có
        if (bieu_do_top_5_xau_pho_bien) bieu_do_top_5_xau_pho_bien.destroy();

        const totalNegativeCount = topNegativeComments.reduce((sum, item) => sum + (item.negativeCount || 0), 0);
        const hasData = totalNegativeCount > 0;

        const labels = hasData ?
            topNegativeComments.map(item =>
                item.comment.length > 50 ? item.comment.substring(0, 10) + '...' : item.comment
            ) : ["Không có dữ liệu"];

        const data = hasData ?
            topNegativeComments.map(item => item.negativeCount) : [0];

        const backgroundColor = hasData ?
            'rgba(66, 133, 244, 0.2)' :
            'rgba(200, 200, 200, 0.3)';

        const borderColor = hasData ?
            'rgba(66, 133, 244, 1)' :
            'rgba(160, 160, 160, 0.5)';

        const ctx = document.getElementById('top_5_xau_pho_bien').getContext('2d');
        bieu_do_top_5_xau_pho_bien = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Từ tiêu cực',
                    data: data,
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    borderWidth: 1,
                    hoverBackgroundColor: hasData ? 'rgba(66, 133, 244, 0.6)' : backgroundColor,
                }]
            },
            options: {
                ...optionsWordChart("Top 5 bình luận tiêu cực phổ biến nhất", 28, hasData),
                onClick: function(event, elements) {
                    if (hasData && elements.length > 0) {
                        const index = elements[0].index;
                        const fullComment = topNegativeComments[index].comment;
                        alert(`Bình luận đầy đủ: ${fullComment}`);
                    }
                },
            }
        });
    }




    // === BIỂU ĐỒ CẢM XÚC THEO THỜI GIAN ===
    function showEmotionOverTimeChart(data) {
        if (lineChart) lineChart.destroy();

        const ctx = document.getElementById('lineChart').getContext('2d');

        const labels = data.map(entry => entry.date);
        const positiveData = data.map(entry => entry.positive);
        const negativeData = data.map(entry => entry.negative);

        lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                        label: 'Từ Tốt (%)',
                        data: positiveData,
                        borderColor: '#66BB6A', // Xanh lá cây nhẹ
                        borderWidth: 2,
                        backgroundColor: '#66BB6A44', // Xanh lá cây nhẹ (mờ)
                        fill: false,
                        tension: 0.3
                    },
                    {
                        label: 'Từ Xấu (%)',
                        data: negativeData,
                        borderColor: '#FF7043', // Cam sáng
                        borderWidth: 2,
                        backgroundColor: '#FF704344', // Cam sáng (mờ)
                        fill: false,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Biến động cảm xúc theo thời gian',
                        color: '#333',
                        font: {
                            size: 28
                        }
                    },
                    legend: {
                        labels: {
                            color: '#333'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#333'
                        },
                        title: {
                            display: true,
                            text: 'Ngày',
                            color: '#333'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#333'
                        },
                        title: {
                            display: true,
                            text: 'Phần trăm (%)',
                            color: '#333'
                        }
                    }
                }
            }
        });
    }

    // === BIỂU ĐỒ CẢM XÚC THEO THỜI GIAN ===
    function show_bieu_do_cam_xuc_theo_nam(data) {
        if (bieu_do_cam_xuc_theo_nam) bieu_do_cam_xuc_theo_nam.destroy();

        const ctx = document.getElementById('cam_xuc_theo_nam').getContext('2d');

        const labels = data.map(entry => entry.year);
        const positiveData = data.map(entry => entry.positive);
        const negativeData = data.map(entry => entry.negative);

        bieu_do_cam_xuc_theo_nam = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                        label: 'Từ Tốt (%)',
                        data: positiveData,
                        borderColor: '#42A5F5', // Xanh dương nhẹ
                        borderWidth: 2,
                        backgroundColor: '#42A5F544', // Xanh dương mờ
                        fill: false,
                        tension: 0.3
                    },
                    {
                        label: 'Từ Xấu (%)',
                        data: negativeData,
                        borderColor: '#EF5350', // Đỏ hồng
                        borderWidth: 2,
                        backgroundColor: '#EF535044', // Đỏ hồng mờ
                        fill: false,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Biến động cảm xúc theo năm',
                        color: '#333',
                        font: {
                            size: 28
                        }
                    },
                    legend: {
                        labels: {
                            color: '#333'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#333'
                        },
                        title: {
                            display: true,
                            text: 'Ngày',
                            color: '#333'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#333'
                        },
                        title: {
                            display: true,
                            text: 'Phần trăm (%)',
                            color: '#333'
                        }
                    }
                }
            }
        });
    }

    // === BIỂU ĐỒ SỐ LƯỢNG COMMENT THEO THỜI GIAN THEO THỜI GIAN ===
    function show_bieu_do_line_so_comment_by_time(data) {
        if (bieu_do_line_chart_comment_time) bieu_do_line_chart_comment_time.destroy();

        const ctx = document.getElementById('so_luong_comment_theo_thoi_gian').getContext('2d');

        const labels = data.dates;
        const counts = data.counts;

        bieu_do_line_chart_comment_time = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Số lượng bình luận',
                    data: counts,
                    borderColor: '#4bc0c0',
                    backgroundColor: '#4bc0c044',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Số lượng bình luận theo thời gian',
                        color: '#333',
                        font: {
                            size: 24
                        }
                    },
                    legend: {
                        labels: {
                            color: '#333'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#333'
                        },
                        title: {
                            display: true,
                            text: 'Ngày',
                            color: '#333'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#333'
                        },
                        title: {
                            display: true,
                            text: 'Số lượng bình luận',
                            color: '#333'
                        }
                    }
                }
            }
        });
    }

    // == BIỂU ĐỒ BIẾN ĐỘNG EMOJI THEO THỜI GIAN ==
    function show_bieu_do_bien_dong_emoji(groupedData) {
        if (bieu_do_bien_dong_emoji) bieu_do_bien_dong_emoji.destroy();

        const ctx = document.getElementById('bien_dong_emoji').getContext('2d');

        // Lấy tất cả các năm
        const labels = Object.keys(groupedData).sort();

        // Tập hợp các loại emoji duy nhất
        const allEmojis = new Set();
        labels.forEach(year => {
            Object.keys(groupedData[year]).forEach(emoji => allEmojis.add(emoji));
        });

        // Danh sách màu đẹp (có thể thêm hoặc chỉnh sửa tùy thích)
        const niceColors = [
            '#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#4bc0c0',
            '#9966ff', '#ff9f40', '#8dd3c7', '#ffffb3', '#bebada'
        ];

        // Tạo datasets cho mỗi loại emoji
        const datasets = Array.from(allEmojis).map((emoji, index) => {
            const color = niceColors[index % niceColors.length];

            return {
                label: emoji,
                data: labels.map(year => groupedData[year][emoji] || 0),
                fill: false,
                borderColor: color,
                backgroundColor: color,
                tension: 0.2,
                pointRadius: 5,
                pointHoverRadius: 7
            };
        });

        bieu_do_bien_dong_emoji = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Biểu đồ biến động emoji theo năm',
                        color: '#333',
                        font: {
                            size: 28
                        }
                    },
                    legend: {
                        labels: {
                            color: '#333'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#333'
                        },
                        title: {
                            display: true,
                            text: 'Năm',
                            color: '#333'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#333'
                        },
                        title: {
                            display: true,
                            text: 'Số lượng',
                            color: '#333'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }



    function show_bieu_do_tot_xau_tren_comment(tot, xau) {
        if (bieu_do_tot_xau_tren_comment) bieu_do_tot_xau_tren_comment.destroy();

        const ctx = document.getElementById('so_luong_tot_xau_tren_comment').getContext('2d');

        bieu_do_tot_xau_tren_comment = new Chart(ctx, {
            type: 'boxplot',
            data: {
                labels: ['Từ Tốt', 'Từ Xấu'],
                datasets: [{
                    label: 'Số lượng từ trên mỗi comment',
                    backgroundColor: ['#a3e4d7', '#f5b7b1'],
                    borderColor: ['#16a085', '#c0392b'],
                    borderWidth: 1,
                    outlierColor: '#999',
                    padding: 10,
                    itemRadius: 0,
                    data: [
                        tot,
                        xau
                    ]
                }]
            },
            options: optionsWordChart("Biểu đồ thể hiện trung bình từ tốt xáu trên mỗi comment")

        });
    }

    function show_bieu_do_phan_bo_cam_xuc_theo_tu_khoa(data) {
        if (bieu_do_cam_xuc_theo_tu_khoa) bieu_do_cam_xuc_theo_tu_khoa.destroy();
        const keywords = data.map(item => item.keyword);
        const positives = data.map(item => item.positive);
        const negatives = data.map(item => item.negative);

        const ctx = document.getElementById('cam_xuc_theo_tu_khoa').getContext('2d');

        bieu_do_cam_xuc_theo_tu_khoa = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: keywords,
                datasets: [{
                        label: 'Từ Tốt',
                        data: positives,
                        backgroundColor: 'rgba(46, 204, 113, 0.7)', // xanh lá
                        borderColor: 'rgba(39, 174, 96, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Từ Xấu',
                        data: negatives,
                        backgroundColor: 'rgba(231, 76, 60, 0.7)', // đỏ
                        borderColor: 'rgba(192, 57, 43, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: optionsWordChart("Biểu đồ phân bố cảm xúc theo từ khoá")
        });
    }





    function groupEmotionByDate(data) {
        const grouped = {};

        for (const {
                date_comment,
                comment_data_llm
            }
            of data) {
            const date = date_comment.slice(0, 10);
            const gpt = comment_data_llm?.GPT || {};
            const pos = parseFloat(gpt.phan_tram_tot) || 0;
            const neg = parseFloat(gpt.phan_tram_xau) || 0;

            if (!grouped[date]) grouped[date] = {
                total: 0,
                sumPos: 0,
                sumNeg: 0
            };
            grouped[date].total++;
            grouped[date].sumPos += pos;
            grouped[date].sumNeg += neg;
        }

        return Object.entries(grouped)
            .map(([date, {
                total,
                sumPos,
                sumNeg
            }]) => ({
                date,
                positive: (sumPos / total).toFixed(2),
                negative: (sumNeg / total).toFixed(2)
            }))
            .sort((a, b) => new Date(a.date) - new Date(b.date));
    }

    function groupEmojiByYear(data) {
        const grouped = {};

        for (const post of data) {
            const year = post.date_comment.slice(0, 4); // chỉ lấy năm
            const postData = post.post_data || [];

            for (const emotion of postData) {
                const cam_xuc = emotion.cam_xuc;
                const so_luong = parseInt(emotion.so_luong) || 0;

                if (cam_xuc === "Tất cả") continue;

                if (!grouped[year]) grouped[year] = {};
                if (!grouped[year][cam_xuc]) grouped[year][cam_xuc] = 0;

                grouped[year][cam_xuc] += so_luong;
            }
        }

        return grouped; // { '2023': { 'Thích': 2, 'Haha': 1 }, '2024': { ... } }
    }



    function groupEmotionByYear(data) {
        const grouped = {};

        for (const {
                date_comment,
                comment_data_llm
            }
            of data) {
            const year = new Date(date_comment).getFullYear(); // Lấy năm
            const gpt = comment_data_llm?.GPT || {};
            const pos = parseFloat(gpt.phan_tram_tot) || 0;
            const neg = parseFloat(gpt.phan_tram_xau) || 0;

            if (!grouped[year]) grouped[year] = {
                total: 0,
                sumPos: 0,
                sumNeg: 0
            };

            grouped[year].total++;
            grouped[year].sumPos += pos;
            grouped[year].sumNeg += neg;
        }

        return Object.entries(grouped)
            .map(([year, {
                total,
                sumPos,
                sumNeg
            }]) => ({
                year,
                positive: (sumPos / total).toFixed(2),
                negative: (sumNeg / total).toFixed(2)
            }))
            .sort((a, b) => a.year - b.year);
    }



    function countCommentsByDate(data) {
        const dateCount = {};

        for (const {
                date_comment
            }
            of data) {
            const date = date_comment.slice(0, 10);
            dateCount[date] = (dateCount[date] || 0) + 1;
        }

        return {
            dates: Object.keys(dateCount),
            counts: Object.values(dateCount)
        };
    }

    function tinh_cam_xuc_theo_tu_khoa(data_tong) {
        const groupedData = {};

        for (const {
                word_search = 'Không xác định', comment_data_llm
            }
            of data_tong) {
            const tu_tot = comment_data_llm?.danh_sach_tu_tot?.length || 0;
            const tu_xau = comment_data_llm?.danh_sach_tu_xau?.length || 0;

            if (!groupedData[word_search]) groupedData[word_search] = {
                positive: 0,
                negative: 0
            };
            groupedData[word_search].positive += tu_tot;
            groupedData[word_search].negative += tu_xau;
        }

        return Object.entries(groupedData).map(([keyword, {
            positive,
            negative
        }]) => ({
            keyword,
            positive,
            negative
        }));
    }

    function get_top_comments(data_tong) {
        const commentsWithScores = data_tong.map(({
            comment,
            comment_data_llm
        }) => ({
            comment,
            positiveCount: comment_data_llm?.danh_sach_tu_tot?.length || 0,
            negativeCount: comment_data_llm?.danh_sach_tu_xau?.length || 0
        }));

        const sortedByPositive = [...commentsWithScores].sort((a, b) => b.positiveCount - a.positiveCount);
        const sortedByNegative = [...commentsWithScores].sort((a, b) => b.negativeCount - a.negativeCount);

        return {
            topPositiveComments: sortedByPositive.slice(0, 5),
            topNegativeComments: sortedByNegative.slice(0, 5)
        };
    }


    // === GỌI API & XỬ LÝ ===
    async function evaluateBrand() {
        const brandInput = document.getElementById('brandInput');
        const phan_tram_tot = document.getElementById('phan_tram_tot');
        const phan_tram_xau = document.getElementById('phan_tram_xau');
        const brand_card = document.getElementById('brand_name');
        const word_search_card = document.getElementById('word_search');
        const do_tin_cay = document.getElementById('do_tin_cay');
        const tong_binh_luan = document.getElementById('tong_binh_luan');
        const tu_tot_nhieu_nhat = document.getElementById('tu_tot_nhieu_nhat');
        const tu_xau_nhieu_nhat = document.getElementById('tu_xau_nhieu_nhat');
        const tong_so_reaction = document.getElementById('tong_so_reaction');
        const cam_xuc_tich_cuc_emoji = document.getElementById('cam_xuc_tich_cuc_emoji');
        const cam_xuc_tieu_cuc_emoji = document.getElementById('cam_xuc_tieu_cuc_emoji');
        const brandName = brandInput.value.toLowerCase().trim();
        const wordSearchInput = document.getElementById('wordSearchInput');
        const wordSearch = wordSearchInput.value.toLowerCase().trim();

        const resultDiv = document.getElementById('result-brand');
        const chartGrid = document.getElementById('chart_grid_id');

        if (!brandName) return alert("Vui lòng nhập tên thương hiệu.");

        resultDiv.innerHTML = `<h2 style="text-align: center;">Đang xử lý...</h2>`;

        const formData = new FormData();
        formData.append("brand_name", brandName);
        formData.append("word_search", wordSearch);
        formData.append("user_id", '{{Auth::id()}}');

        try {
            const response = await fetch('{{ config("services.api_url") }}/danh_gia_thuong_hieu/thuong_hieu/word', {
                method: "POST",
                headers: {
                    "API-Key": '{{ config("services.crawl_api.key") }}'
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok && result.data) {
                const data_tong = result.data
                console.log(data_tong)

                const data = result.data[0];
                const tyletot = parseFloat(data.brand_data_llm.GPT.phan_tram_tot).toFixed(2)
                const tylexau = parseFloat(data.brand_data_llm.GPT.phan_tram_xau).toFixed(2)
                phan_tram_tot.innerText = tyletot + "%"
                phan_tram_xau.innerText = tylexau + "%"
                const tinhDoTinCay = parseFloat(((tyletot - tylexau) / 100 + 1) / 2);
                do_tin_cay.innerText = tinhDoTinCay.toFixed(2)

                // brand name và wordsearch
                brand_card.innerText = brandName
                word_search_card.innerText = wordSearch

                resultDiv.innerHTML = `<h2 style = "text-align: center;">Phân tích thương hiệu ${brandName}</h2>`;
                chartGrid.style.display = "block";

                // biểu đồ pie thể hiện tỷ lệ bài post từ group và page
                const uniquePostsMap = new Map();
                data_tong.forEach(post => {
                    if (!uniquePostsMap.has(post.post_content)) {
                        uniquePostsMap.set(post.post_content, post);
                    }
                });
                const uniquePosts = Array.from(uniquePostsMap.values());

                // Số lượng và tỷ lệ post trên group và fanpage
                const groupCount = uniquePosts.filter(post => post.is_group).length;
                const fanpageCount = uniquePosts.filter(post => post.is_fanpage).length;
                const ty_le_group = (groupCount / (groupCount + fanpageCount)) * 100
                const ty_le_page = (fanpageCount / (groupCount + fanpageCount)) * 100


                // tổng số cảm xúc của tất cả bài post của thương hiệu với word search
                const tongCamXuc = {};

                uniquePosts.forEach(item => {
                    const postData = item.post_data || [];
                    postData.forEach(({
                        cam_xuc,
                        so_luong
                    }) => {
                        tongCamXuc[cam_xuc] = (tongCamXuc[cam_xuc] || 0) + so_luong;
                    });
                });


                const groupEmoji = groupEmojiByYear(uniquePosts)
                let total_reaction = 0;

                for (const key in tongCamXuc) {
                    if (key !== "Tất cả") {
                        total_reaction += tongCamXuc[key];
                    }
                }

                if (total_reaction === 0) {
                    cam_xuc_tich_cuc_emoji.innerText = "Không có dữ liệu";
                    cam_xuc_tieu_cuc_emoji.innerText = "Không có dữ liệu";
                    tong_so_reaction.innerText = "0";

                } else {
                    tong_so_reaction.innerText = total_reaction;
                    cam_xuc_tich_cuc_emoji.innerText =
                        ((((tongCamXuc["Thích"] || 0) +
                            (tongCamXuc["Yêu thích"] || 0) +
                            (tongCamXuc["Haha"] || 0)) / total_reaction) * 100).toFixed(2) + "%";

                    cam_xuc_tieu_cuc_emoji.innerText =
                        ((((tongCamXuc["Phẫn nộ"] || 0) +
                            (tongCamXuc["Buồn"] || 0)) / total_reaction) * 100).toFixed(2) + "%";
                }

                show_bieu_do_bien_dong_emoji(groupEmoji)

                show_bieu_do_so_luong_cam_xuc_emoji(tongCamXuc) // biểu đồ cột thể hiện số lượng
                show_bieu_do_ty_le_cam_xuc_emoji(tongCamXuc) // biểu đồ tròn thể hiện tỷ lệ

                // biểu đò tỷ lệ bài post trong group và page đã lấy được
                show_bieu_do_pie_post_group_page(
                    parseFloat(ty_le_group),
                    parseFloat(ty_le_page),
                )

                // bar chart horizontal post group page
                show_bieu_do_horizontal_bar_chart_post_group_page(groupCount, fanpageCount)

                // biểu đồ thể hiện số lượng comment group hoặc fanpages
                // Không loại bỏ comment trùng
                const comment_group = data_tong.filter(comment => comment.is_group).length;
                const comment_page = data_tong.filter(comment => comment.is_fanpage).length;
                tong_binh_luan.innerText = (comment_page + comment_group)

                show_bieu_do_horizontal_bar_chart_comment_group_page(comment_group, comment_page)

                // biểu đồ thể hiện số lượng bài viết dựa trên word_search
                const wordSearchCount = {};

                uniquePosts.forEach(post => {
                    const word = post.word_search;
                    if (word) {
                        if (!wordSearchCount[word]) {
                            wordSearchCount[word] = 1;
                        } else {
                            wordSearchCount[word]++;
                        }
                    }
                });


                // Tạo dict gồm 2 list: words và values
                const dict_word_count = {
                    words: Object.keys(wordSearchCount),
                    values: Object.values(wordSearchCount)
                };
                show_bieu_do_horizontal_bar_chart_post_word_search(dict_word_count.words, dict_word_count.values)

                // Biểu đồ tròn hiển thị phần trăm cảm xúc
                showSentimentChart(
                    parseFloat(data.brand_data_llm.GPT.phan_tram_tot),
                    parseFloat(data.brand_data_llm.GPT.phan_tram_xau),
                    data.brand_name
                );

                // Lọc bài viết từ group và page
                const group_data = data_tong.filter(post => post.is_group === 1);
                const page_data = data_tong.filter(post => post.is_fanpage === 1);

                // Hàm tính trung bình % tốt và % xấu
                const calcAvgSentiment = (posts) => {
                    const valid = posts.filter(p => p.comment_data_llm?.GPT?.phan_tram_tot && p.comment_data_llm?.GPT?.phan_tram_xau);

                    const total = valid.length
                    const sumTot = valid.reduce((sum, p) => sum + parseFloat(p.comment_data_llm.GPT.phan_tram_tot), 0);
                    const sumXau = valid.reduce((sum, p) => sum + parseFloat(p.comment_data_llm.GPT.phan_tram_xau), 0);

                    return {
                        avgTot: (sumTot / total).toFixed(2),
                        avgXau: (sumXau / total).toFixed(2)
                    };
                };

                // Tính kết quả
                const groupSentiment = calcAvgSentiment(group_data);
                const pageSentiment = calcAvgSentiment(page_data);

                show_trung_binh_tot_xau_group_page(groupSentiment, pageSentiment)

                // danh sách tổng
                const danh_sach_tu_tot = data.brand_data_llm.danh_sach_tu_tot;
                const danh_sach_tu_xau = data.brand_data_llm.danh_sach_tu_xau;

                const countWordGood = {};
                const countWordBad = {};

                danh_sach_tu_tot.forEach(word => {
                    countWordGood[word] = (countWordGood[word] || 0) + 1;
                });

                danh_sach_tu_xau.forEach(word => {
                    countWordBad[word] = (countWordBad[word] || 0) + 1;
                });

                const dem_tu_tot = Object.entries(countWordGood).map(([word, weight]) => ({
                    word,
                    weight
                }));

                const dem_tu_xau = Object.entries(countWordBad).map(([word, weight]) => ({
                    word,
                    weight
                }));

                // sắp xếp lại số từ xuất hiện nhiều nhất từ cao xuống thấp
                const sorted_tu_tot = dem_tu_tot.sort((a, b) => b.weight - a.weight);
                const sorted_tu_xau = dem_tu_xau.sort((a, b) => b.weight - a.weight);

                if (sorted_tu_tot.length > 0) {
                    tu_tot_nhieu_nhat.innerText = sorted_tu_tot[0].word + ": " + sorted_tu_tot[0].weight;
                } else {
                    tu_tot_nhieu_nhat.innerText = "Không có dữ liệu";
                }

                if (sorted_tu_xau.length > 0) {
                    tu_xau_nhieu_nhat.innerText = sorted_tu_xau[0].word + ": " + sorted_tu_xau[0].weight;
                } else {
                    tu_xau_nhieu_nhat.innerText = "Không có dữ liệu";
                }



                // biểu đồ cột so sánh số lượng từ tốt và từ xấu
                showWordCountChart(
                    danh_sach_tu_tot,
                    danh_sach_tu_xau
                );

                // Biểu đồ wordChart 
                if (dem_tu_tot.length > 0) {
                    showWordCloudChartGood(dem_tu_tot);
                }

                if (dem_tu_xau.length > 0) {
                    showWordCloudChartBad(dem_tu_xau);
                }


                // Sắp xếp dữ liệu từ tiêu cực theo số lượng xuất hiện (weight) giảm dần và chọn top 10
                const top10NegativeWords = dem_tu_xau
                    .sort((a, b) => b.weight - a.weight) // Sắp xếp theo weight giảm dần
                    .slice(0, 10);
                // Lấy các từ và số lượng để vẽ biểu đồ
                const labels_xau = top10NegativeWords.map(item => item.word);
                const data_top_10_xau = top10NegativeWords.map(item => item.weight);
                show_top_10_xau(labels_xau, data_top_10_xau)


                const top10PositiveWords = dem_tu_tot
                    .sort((a, b) => b.weight - a.weight) // Sắp xếp theo weight giảm dần
                    .slice(0, 10);
                // Lấy các từ và số lượng để vẽ biểu đồ
                const labels_tot = top10PositiveWords.map(item => item.word);
                const data_top_10_tot = top10PositiveWords.map(item => item.weight);

                show_top_10_tot(labels_tot, data_top_10_tot)

                // Group những thời gian bình luận lại với nhau
                const dataGroup = groupEmotionByDate(data_tong)
                showEmotionOverTimeChart(dataGroup)

                const dataGroupYear = groupEmotionByYear(data_tong)
                show_bieu_do_cam_xuc_theo_nam(dataGroupYear)



                // show_bieu_do_line_so_comment_by_time(data )
                const countDate = countCommentsByDate(data_tong)
                show_bieu_do_line_so_comment_by_time(countDate)

                // phân bố  tốt xấu mỗi comment: 
                const tu_tot_moi_comment = data_tong.map(item => item.comment_data_llm.danh_sach_tu_tot.length);
                const tu_xau_moi_comment = data_tong.map(item => item.comment_data_llm.danh_sach_tu_xau.length);

                show_bieu_do_tot_xau_tren_comment(tu_tot_moi_comment, tu_xau_moi_comment)

                const data_cam_xuc = tinh_cam_xuc_theo_tu_khoa(data_tong);
                show_bieu_do_phan_bo_cam_xuc_theo_tu_khoa(data_cam_xuc);




                const {
                    topPositiveComments,
                    topNegativeComments
                } = get_top_comments(data_tong);

                console.log(topPositiveComments)
                show_top_5_tot_pho_bien(topPositiveComments)
                show_top_5_xau_pho_bien(topNegativeComments)
            } else {
                resultDiv.innerHTML = `<a href="{{ route('user.crawl') }}" class="text-primary link-underline-hover">Không có dữ liệu đánh giá. Sang trang yêu cầu đánh giá</a>`;
                [
                    bieu_do_pie_post_group_page,
                    bieu_do_ty_le_cam_xuc_emoji,
                    sentimentChart,
                    bieu_do_horizontal_bar_chart_post_group_page,
                    bieu_do_horizontal_bar_chart_comment_group_page,
                    bieu_do_trung_binh_tot_xau_group_page,
                    bieu_do_horizontal_bar_chart_post_word_search,
                    bieu_do_cam_xuc_theo_tu_khoa,
                    wordChartCoutChart,
                    bieu_do_top_10_tot,
                    bieu_do_top_10_xau,
                    bieu_do_tot_xau_tren_comment,
                    bieu_do_top_5_xau_pho_bien,
                    bieu_do_so_luong_cam_xuc_emoji,
                    wordCloudChartGood,
                    wordCloudChartBad,
                    lineChart,
                    bieu_do_line_chart_comment_time,
                    bieu_do_cam_xuc_theo_nam,
                    bieu_do_bien_dong_emoji,
                ].forEach(chart => chart?.destroy?.());
                phan_tram_tot.innerText = ""
                phan_tram_xau.innerText = ""
                do_tin_cay.innerText = ""
                brand_card.innerText = ""
                word_search_card.innerText = ""
                cam_xuc_tich_cuc_emoji.innerText = ""
                cam_xuc_tieu_cuc_emoji.innerText = ""
                tong_so_reaction.innerText = ""
                tong_so_reaction.innerText = ""
                cam_xuc_tich_cuc_emoji.innerText = ""
                cam_xuc_tieu_cuc_emoji.innerText = ""
                tong_binh_luan.innerText = ""
                tu_tot_nhieu_nhat.innerText = ""
                tu_tot_nhieu_nhat.innerText = ""
                tu_xau_nhieu_nhat.innerText = ""
                tu_xau_nhieu_nhat.innerText = ""
                chartGrid.style.display = "none";

            }
        } catch (error) {
            console.error(error);
            resultDiv.innerHTML = `<div class="alert alert-danger">Đã xảy ra lỗi trong quá trình gửi yêu cầu.</div>`;
        }
    }


    // === LẮNG NGHE SUBMIT FORM ===
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("evaluateForm").addEventListener("submit", async (e) => {
            e.preventDefault();
            Swal.showLoading();
            [
                bieu_do_pie_post_group_page,
                bieu_do_ty_le_cam_xuc_emoji,
                sentimentChart,
                bieu_do_horizontal_bar_chart_post_group_page,
                bieu_do_horizontal_bar_chart_comment_group_page,
                bieu_do_trung_binh_tot_xau_group_page,
                bieu_do_horizontal_bar_chart_post_word_search,
                bieu_do_cam_xuc_theo_tu_khoa,
                wordChartCoutChart,
                bieu_do_top_10_tot,
                bieu_do_top_10_xau,
                bieu_do_tot_xau_tren_comment,
                bieu_do_top_5_xau_pho_bien,
                bieu_do_so_luong_cam_xuc_emoji,
                wordCloudChartGood,
                wordCloudChartBad,
                lineChart,
                bieu_do_line_chart_comment_time,
                bieu_do_cam_xuc_theo_nam,
                bieu_do_bien_dong_emoji,
            ].forEach(chart => chart?.destroy?.());
            await evaluateBrand();
            Swal.close();
        });
    });
</script>