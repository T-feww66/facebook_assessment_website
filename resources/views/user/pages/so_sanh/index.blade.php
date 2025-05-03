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
                        {{ $brand_name ? 'readonly' : '' }}>
                </div>
                <button class="btn btn-success" type="submit">Search</button>
            </form>

            <div id="result-brand"></div>

            <div id="chart_grid_id" class="none mt-5">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Phần trăm tốt</p>
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

                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Phần trăm xấu</p>
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
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Độ tin cậy</p>
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

                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Bình luận</p>
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

                </div><!-- end row -->
                <div class="row">
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    "use strict";

    let bieu_do_pie_post_group_page = null;
    let bieu_do_horizontal_bar_chart_post_group_page = null
    let bieu_do_horizontal_bar_chart_post_word_search = null
    let bieu_do_line_chart_comment_time = null
    let bieu_do_horizontal_bar_chart_comment_group_page = null
    let sentimentChart = null;
    let wordChartCoutChart = null;
    let wordCloudChartGood = null;
    let wordCloudChartBad = null;
    let bieu_do_top_10_tot = null
    let bieu_do_top_10_xau = null
    let bieu_do_tot_xau_tren_comment = null
    let bieu_do_cam_xuc_theo_tu_khoa = null
    let bieu_do_top_5_tot_pho_bien = null
    let bieu_do_top_5_xau_pho_bien = null
    let bieu_do_cam_xuc_theo_nam = null
    let bieu_do_trung_binh_tot_xau_group_page = null
    let lineChart = null;


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
        bieu_do_pie_post_group_page = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Group', 'Fanpage'],
                datasets: [{
                    data: [group, page],
                    backgroundColor: ['#ff81b7', '#9792e8'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    datalabels: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: value => typeof value === "number" ? value.toFixed(2) + '%' : value
                    },
                    legend: {
                        labels: {
                            color: '#333'
                        }
                    },
                    title: titleConfig(`Biểu đồ thể hiện tỷ lệ bài viết trong Group và Fanpages`, 28)
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
        sentimentChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Tích cực', 'Tiêu cực'],
                datasets: [{
                    data: [positive, negative],
                    backgroundColor: ['#ff81b7', '#9792e8'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    datalabels: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: value => typeof value === "number" ? value.toFixed(2) + '%' : value
                    },
                    legend: {
                        labels: {
                            color: '#333'
                        }
                    },
                    title: titleConfig(`Biểu đồ thể hiện tỷ lệ cảm xúc`, 28)
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
                    data: [tuTot, tuXau],
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

    // === BIỂU ĐỒ WordCloud: TỪ TỐT/XẤU ===
    function showWordCloudChartGood(words) {
        const weights = words.map(d => d.weight);
        const min = Math.min(...weights);
        const max = Math.max(...weights);

        // Scale về 10–40:
        const scaledWeights = weights.map(w => {
            const normalized = (w - min) / (max - min);
            return 20 + normalized * 20; // font size từ 10 đến 40
        });

        wordCloudChartGood?.destroy();
        const ctx = document.getElementById("wordCloudChartGood");
        wordCloudChartGood = new Chart(ctx, {
            type: "wordCloud",
            data: {
                labels: words.map(w => w.word),
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
        const weights = words.map(d => d.weight);
        const min = Math.min(...weights);
        const max = Math.max(...weights);

        // Scale về 10–40:
        const scaledWeights = weights.map(w => {
            const normalized = (w - min) / (max - min);
            return 20 + normalized * 20; // font size từ 10 đến 40
        });
        wordCloudChartBad?.destroy();

        const ctx = document.getElementById("wordCloudChartBad");
        wordCloudChartBad = new Chart(ctx, {
            type: "wordCloud",
            data: {
                labels: words.map(w => w.word),
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
                        text: 'Top 10 từ tiêu cực xuất hiện nhiều nhất',
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
        // Kiểm tra và hủy biểu đồ cũ nếu có
        if (bieu_do_top_5_tot_pho_bien) bieu_do_top_5_tot_pho_bien.destroy();

        // Rút ngắn bình luận để tránh quá dài
        var shortComments = topPositiveComments.map(item => {
            const truncated = item.comment.length > 50 ? item.comment.substring(0, 10) + '...' : item.comment;
            return truncated;
        });

        // Vẽ biểu đồ
        const ctx = document.getElementById('top_5_tot_pho_bien').getContext('2d');
        bieu_do_top_5_tot_pho_bien = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: shortComments,
                datasets: [{
                    label: 'Từ tích cực',
                    data: topPositiveComments.map(item => item.positiveCount),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Màu nền nhẹ nhàng với sắc hồng
                    borderColor: 'rgba(255, 99, 132, 1)', // Màu viền đậm hơn với sắc hồng
                    borderWidth: 1, // Độ dày viền
                    hoverBackgroundColor: 'rgba(255, 99, 132, 0.6)', // Màu nền khi hover đậm hơn

                }]
            },
            options: {
                ...optionsWordChart("Top 5 bình luận tích cực phổ biến nhất"),
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        // Lấy chỉ mục của phần tử đã click
                        const index = elements[0].index;
                        const fullComment = topPositiveComments[index].comment;

                        // Hiển thị bình luận đầy đủ (có thể thay thế bằng việc update div/modal)
                        alert(`Bình luận đầy đủ: ${fullComment}`);

                    }
                }
            }
        });
    }

    // === BIỂU ĐỒ: TOP 5 TỪ TÍCH CỰC PHỔ BIẾN NHẤT ===
    function show_top_5_xau_pho_bien(topNegativeComments) {
        // Kiểm tra và hủy biểu đồ cũ nếu có
        if (bieu_do_top_5_xau_pho_bien) bieu_do_top_5_xau_pho_bien.destroy();

        // Rút ngắn bình luận để tránh quá dài
        var shortComments = topNegativeComments.map(item => {
            const truncated = item.comment.length > 50 ? item.comment.substring(0, 10) + '...' : item.comment;
            return truncated;
        });

        // Vẽ biểu đồ
        const ctx = document.getElementById('top_5_xau_pho_bien').getContext('2d');
        bieu_do_top_5_xau_pho_bien = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: shortComments,
                datasets: [{
                    label: 'Từ tích cực',
                    data: topNegativeComments.map(item => item.negativeCount),
                    backgroundColor: 'rgba(66, 133, 244, 0.2)',
                    borderColor: 'rgba(66, 133, 244, 1)',
                    borderWidth: 1,
                    hoverBackgroundColor: 'rgba(66, 133, 244, 0.6)',

                }]
            },
            options: {
                ...optionsWordChart("Top 5 bình luận tiêu cực phổ biến nhất"),
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        // Lấy chỉ mục của phần tử đã click
                        const index = elements[0].index;
                        const fullComment = topNegativeComments[index].comment;

                        // Hiển thị bình luận đầy đủ (có thể thay thế bằng việc update div/modal)
                        alert(`Bình luận đầy đủ: ${fullComment}`);
                    }
                }
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

        lineChart = new Chart(ctx, {
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
            options: {
                ...optionsWordChart("Biểu đồ thể hiện trung bình từ tốt xấu trên mỗi comment"),
                scales: {
                    y: {
                        type: 'logarithmic',
                        min: 0.1,
                        max: 6,
                        ticks: {
                            callback: function(value) {
                                return Number(value.toString());
                            }
                        }
                    }
                }
            }
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

    // Group cảm xúc theo ngày
    function groupEmotionByDate(data) {
        const grouped = {};
        data.forEach(item => {
            const date = item.date_comment.slice(0, 10);
            const pos = parseFloat(item.comment_data_llm?.GPT?.phan_tram_tot || 0);
            const neg = parseFloat(item.comment_data_llm?.GPT?.phan_tram_xau || 0);
            grouped[date] = grouped[date] || {
                total: 0,
                sumPos: 0,
                sumNeg: 0
            };
            grouped[date].total++;
            grouped[date].sumPos += pos;
            grouped[date].sumNeg += neg;
        });
        return Object.entries(grouped).map(([date, {
            total,
            sumPos,
            sumNeg
        }]) => ({
            date,
            positive: (sumPos / total).toFixed(2),
            negative: (sumNeg / total).toFixed(2)
        })).sort((a, b) => new Date(a.date) - new Date(b.date));
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

    // Đếm số comment theo ngày
    function countCommentsByDate(data) {
        const count = {};
        data.forEach(item => {
            const date = item.date_comment.slice(0, 10);
            count[date] = (count[date] || 0) + 1;
        });
        return {
            dates: Object.keys(count),
            counts: Object.values(count)
        };
    }

    // Phân tích cảm xúc theo từ khóa
    function tinh_cam_xuc_theo_tu_khoa(data) {
        const grouped = {};
        data.forEach(item => {
            const keyword = item.word_search || 'Không xác định';
            const tu_tot = item.comment_data_llm?.danh_sach_tu_tot?.length || 0;
            const tu_xau = item.comment_data_llm?.danh_sach_tu_xau?.length || 0;
            const {
                danh_sach_tu_tot = [], danh_sach_tu_xau = [], GPT = {}
            } = item.brand_data_llm || {};
            if (!grouped[keyword]) {
                grouped[keyword] = {
                    positive: 0,
                    negative: 0,
                    danh_sach_tu_tot,
                    danh_sach_tu_xau,
                    phan_tram_tot: GPT.phan_tram_tot || 0,
                    phan_tram_xau: GPT.phan_tram_xau || 0,
                };
            }
            grouped[keyword].positive += tu_tot;
            grouped[keyword].negative += tu_xau;
        });
        return Object.entries(grouped).map(([keyword, v]) => ({
            keyword,
            ...v
        }));
    }

    // Lấy top comment tốt và xấu
    function get_top_comments(data) {
        const scored = data.map(item => ({
            comment: item.comment,
            positiveCount: item.comment_data_llm?.danh_sach_tu_tot?.length || 0,
            negativeCount: item.comment_data_llm?.danh_sach_tu_xau?.length || 0
        }));
        return {
            topPositiveComments: [...scored].sort((a, b) => b.positiveCount - a.positiveCount).slice(0, 5),
            topNegativeComments: [...scored].sort((a, b) => b.negativeCount - a.negativeCount).slice(0, 5)
        };
    }


    // === GỌI API & XỬ LÝ ===
    async function evaluateBrand() {
        const brandInput = document.getElementById('brandInput');
        const brandName = brandInput.value.toLowerCase().trim();
        const resultDiv = document.getElementById('result-brand');
        const chartGrid = document.getElementById('chart_grid_id');
        const phan_tram_tot = document.getElementById('phan_tram_tot');
        const phan_tram_xau = document.getElementById('phan_tram_xau');
        const do_tin_cay = document.getElementById('do_tin_cay');
        const tong_binh_luan = document.getElementById('tong_binh_luan');

        if (!brandName) return alert("Vui lòng nhập tên thương hiệu.");

        resultDiv.innerHTML = `<h2 style="text-align: center;">Đang xử lý...</h2>`;
        const formData = new FormData();
        formData.append("brand_name", brandName);
        formData.append("user_id", '{{Auth::id()}}');

        try {
            const response = await fetch('http://localhost:60074/danh_gia_thuong_hieu/thuong_hieu', {
                method: "POST",
                headers: {
                    "API-Key": '{{ config("services.crawl_api.key") }}'
                },
                body: formData
            });

            const result = await response.json();
            const data_tong = result?.data;
            if (!response.ok || !data_tong || !Array.isArray(data_tong)) throw new Error();

            const data_cam_xuc = tinh_cam_xuc_theo_tu_khoa(data_tong);
            const avg = (key) => data_cam_xuc.reduce((sum, i) => sum + parseFloat(i[key]), 0) / data_cam_xuc.length;
            const trung_binh_tot = avg("phan_tram_tot");
            const trung_binh_xau = avg("phan_tram_xau");
            const doTinCay = trung_binh_tot - trung_binh_xau;
            const tinhDoTinCay = parseFloat(((doTinCay) / 100 + 1) / 2);

            phan_tram_tot.innerText = trung_binh_tot.toFixed(2);
            phan_tram_xau.innerText = trung_binh_xau.toFixed(2);
            do_tin_cay.innerText = tinhDoTinCay.toFixed(2);

            resultDiv.innerHTML = `<h2 style="text-align: center;">Phân tích thương hiệu ${brandName}</h2>`;
            chartGrid.style.display = "block";

            const uniquePosts = [...new Map(data_tong.map(p => [p.post_content, p])).values()];
            const count = (arr, cond) => arr.filter(cond).length;
            const groupCount = count(uniquePosts, p => p.is_group);
            const fanpageCount = count(uniquePosts, p => p.is_fanpage);
            const comment_group = count(data_tong, c => c.is_group);
            const comment_page = count(data_tong, c => c.is_fanpage);

            tong_binh_luan.innerText = (comment_page + comment_group)

            show_bieu_do_pie_post_group_page(
                (groupCount / (groupCount + fanpageCount)) * 100,
                (fanpageCount / (groupCount + fanpageCount)) * 100
            );
            show_bieu_do_horizontal_bar_chart_post_group_page(groupCount, fanpageCount);
            show_bieu_do_horizontal_bar_chart_comment_group_page(comment_group, comment_page);

            const wordSearchCount = {};
            for (const post of uniquePosts) {
                if (post.word_search) wordSearchCount[post.word_search] = (wordSearchCount[post.word_search] || 0) + 1;
            }
            show_bieu_do_horizontal_bar_chart_post_word_search(
                Object.keys(wordSearchCount),
                Object.values(wordSearchCount)
            );

            // ========================= BIỂU DỒ TRUNG BÌNH TỐT XẤU CỦA PAGE VÀ GROUP
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

            const list_tu_tot = data_cam_xuc.flatMap(i => i.danh_sach_tu_tot);
            const list_tu_xau = data_cam_xuc.flatMap(i => i.danh_sach_tu_xau);
            const wordCounter = (list) => list.reduce((acc, word) => {
                acc[word] = (acc[word] || 0) + 1;
                return acc;
            }, {});
            const dem_tu_tot = Object.entries(wordCounter(list_tu_tot)).map(([word, weight]) => ({
                word,
                weight
            }));
            const dem_tu_xau = Object.entries(wordCounter(list_tu_xau)).map(([word, weight]) => ({
                word,
                weight
            }));

            showSentimentChart(trung_binh_tot, trung_binh_xau, data_tong[0].brand_name);
            showWordCountChart(list_tu_tot.length, list_tu_xau.length);
            if (dem_tu_tot.length) showWordCloudChartGood(dem_tu_tot);
            if (dem_tu_xau.length) showWordCloudChartBad(dem_tu_xau);

            const top10 = (arr) => arr.sort((a, b) => b.weight - a.weight).slice(0, 10);
            show_top_10_tot(top10(dem_tu_tot).map(i => i.word), top10(dem_tu_tot).map(i => i.weight));
            show_top_10_xau(top10(dem_tu_xau).map(i => i.word), top10(dem_tu_xau).map(i => i.weight));

            //line chart theo thời gian và theo năm
            showEmotionOverTimeChart(groupEmotionByDate(data_tong));
            show_bieu_do_cam_xuc_theo_nam(groupEmotionByYear(data_tong))

            show_bieu_do_line_so_comment_by_time(countCommentsByDate(data_tong));
            show_bieu_do_tot_xau_tren_comment(
                data_tong.map(i => i.comment_data_llm.danh_sach_tu_tot.length),
                data_tong.map(i => i.comment_data_llm.danh_sach_tu_xau.length)
            );

            show_bieu_do_phan_bo_cam_xuc_theo_tu_khoa(data_cam_xuc);

            const {
                topPositiveComments,
                topNegativeComments
            } = get_top_comments(data_tong);
            show_top_5_tot_pho_bien(topPositiveComments);
            show_top_5_xau_pho_bien(topNegativeComments);

            brandInput.value = "";
        } catch (err) {
            console.error(err);
            resultDiv.innerHTML = `<a href="{{ route('user.gui_danh_gia') }}?brand=${brandName}" class="link_request link-light link-offset-2 link-underline link-underline-opacity-100">Không có dữ liệu đánh giá. Sang trang yêu cầu đánh giá</a>`;
            [
                bieu_do_pie_post_group_page,
                bieu_do_horizontal_bar_chart_post_group_page,
                bieu_do_horizontal_bar_chart_post_word_search,
                sentimentChart,
                wordChartCoutChart,
                wordCloudChartGood,
                wordCloudChartBad,
                bieu_do_top_10_xau,
                bieu_do_top_10_tot,
                lineChart,
                bieu_do_line_chart_comment_time,
                bieu_do_horizontal_bar_chart_comment_group_page,
                bieu_do_tot_xau_tren_comment,
                bieu_do_cam_xuc_theo_tu_khoa,
                bieu_do_top_5_tot_pho_bien,
                bieu_do_top_5_xau_pho_bien,
                bieu_do_cam_xuc_theo_nam,
                bieu_do_trung_binh_tot_xau_group_page,
            ].forEach(chart => chart?.destroy?.());
        }
    }

    // === LẮNG NGHE SUBMIT FORM ===
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("evaluateForm").addEventListener("submit", async (e) => {
            e.preventDefault();
            Swal.showLoading();
            [
                bieu_do_pie_post_group_page,
                bieu_do_horizontal_bar_chart_post_group_page,
                bieu_do_horizontal_bar_chart_post_word_search,
                sentimentChart,
                wordChartCoutChart,
                wordCloudChartGood,
                wordCloudChartBad,
                bieu_do_top_10_xau,
                bieu_do_top_10_tot,
                lineChart,
                bieu_do_line_chart_comment_time,
                bieu_do_horizontal_bar_chart_comment_group_page,
                bieu_do_tot_xau_tren_comment,
                bieu_do_cam_xuc_theo_tu_khoa,
                bieu_do_top_5_tot_pho_bien,
                bieu_do_top_5_xau_pho_bien,
                bieu_do_cam_xuc_theo_nam,
                bieu_do_trung_binh_tot_xau_group_page,
            ].forEach(chart => chart?.destroy?.());
            await evaluateBrand();
            Swal.close();
        });
    });
</script>