@extends('layouts.user')

@section("title", "Tìm Kiếm Đánh Giá")

@section('content')
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

        <div id="chart_grid_id" class="none">
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
                                <canvas width="700" height="500" id="so_luong_bai_viet_group_page"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ horizontal-bar-chart số lượng comment group và pages  -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-card">
                                <canvas width="700" height="500" id="so_luong_comment_group_page"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ horizontal-bar-chart số lượng bài viết theo word_search -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-card">
                                <canvas width="500" height="" id="so_luong_bai_viet_word_search"></canvas>
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

                <!-- Biểu đồ lineChart thể hiện tỷ lệ cảm xúc theo thời gian -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-card">
                                <canvas width="" height="300" id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ lineChart thể hiện số lượng comment theo thời gian -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-card">
                                <canvas width="" height="300" id="so_luong_comment_theo_thoi_gian"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ box-plot thể hiện số lượng tốt xấu trung bình trên mỗi comment -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-card">
                                <canvas width="" height="300" id="so_luong_tot_xau_tren_comment"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ Stacked bar chart thể hiện Phân bổ cảm xúc theo từng từ khoá tìm kiếm -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-card">
                                <canvas width="" height="300" id="cam_xuc_theo_tu_khoa"></canvas>
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

    // === BIỂU ĐỒ PIE: số lượng bài viết từ group và page ===
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
            options: optionsWordChart("Biểu đồ WordChart tích cực phổ biến")
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
            options: optionsWordChart("Biểu đồ WordChart tiêu cực phổ biến")
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
                        text: 'Biểu đồ thể hiện số lượng từ tiêu cực',
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
                        text: 'Biểu đồ thể hiện số lượng từ tiêu cực',
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
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Phân bổ cảm xúc theo từng từ khoá tìm kiếm'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                        title: {
                            display: true,
                            text: 'Từ khoá'
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Số lượng từ'
                        }
                    }
                }
            }
        });
    }





    // Hàm Group thời gian bình luận
    function groupEmotionByDate(data) {
        const grouped = {};

        data.forEach(item => {
            const date = item.date_comment.slice(0, 10); // YYYY-MM-DD
            const pos = parseFloat(item.comment_data_llm?.GPT?.phan_tram_tot || 0);
            const neg = parseFloat(item.comment_data_llm?.GPT?.phan_tram_xau || 0);

            if (!grouped[date]) {
                grouped[date] = {
                    total: 0,
                    sumPos: 0,
                    sumNeg: 0
                };
            }

            grouped[date].total += 1;
            grouped[date].sumPos += pos;
            grouped[date].sumNeg += neg;
        });

        // Tính trung bình mỗi ngày
        const result = Object.entries(grouped).map(([date, {
            total,
            sumPos,
            sumNeg
        }]) => ({
            date,
            positive: (sumPos / total).toFixed(2),
            negative: (sumNeg / total).toFixed(2)
        }));

        return result.sort((a, b) => new Date(a.date) - new Date(b.date));
    }

    function countCommentsByDate(data) {
        const dateCount = {};

        data.forEach(item => {
            const date = item.date_comment.slice(0, 10); // Lấy yyyy-mm-dd

            if (!dateCount[date]) {
                dateCount[date] = 1;
            } else {
                dateCount[date]++;
            }
        });

        const result = {
            dates: Object.keys(dateCount),
            counts: Object.values(dateCount)
        };

        return result;
    }

    function tinh_cam_xuc_theo_tu_khoa(data_tong) {
        const groupedData = {};

        data_tong.forEach(item => {
            const keyword = item.word_search || 'Không xác định';
            const tu_tot = item.comment_data_llm?.danh_sach_tu_tot?.length || 0;
            const tu_xau = item.comment_data_llm?.danh_sach_tu_xau?.length || 0;

            if (!groupedData[keyword]) {
                groupedData[keyword] = {
                    positive: 0,
                    negative: 0
                };
            }

            groupedData[keyword].positive += tu_tot;
            groupedData[keyword].negative += tu_xau;
        });

        // Chuyển sang mảng
        return Object.entries(groupedData).map(([keyword, values]) => ({
            keyword,
            positive: values.positive,
            negative: values.negative
        }));
    }





    // === GỌI API & XỬ LÝ ===
    async function evaluateBrand() {
        const brandInput = document.getElementById('brandInput');
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
            const response = await fetch('http://localhost:60074/danh_gia_thuong_hieu/thuong_hieu', {
                method: "POST",
                headers: {
                    "API-Key": '{{ config("services.crawl_api.key") }}'
                },
                body: formData
            });

            const result = await response.json();
            console.log(result.data)

            if (response.ok && result.data) {
                const data_tong = result.data
                const data = result.data[0];
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

                // Đếm lại
                const groupCount = uniquePosts.filter(post => post.is_group).length;
                const fanpageCount = uniquePosts.filter(post => post.is_fanpage).length;
                const ty_le_group = (groupCount / (groupCount + fanpageCount)) * 100
                const ty_le_page = (fanpageCount / (groupCount + fanpageCount)) * 100

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


                // show_bieu_do_line_so_comment_by_time(data )
                const countDate = countCommentsByDate(data_tong)
                show_bieu_do_line_so_comment_by_time(countDate)

                // phân bố  tốt xấu mỗi comment: 
                const tu_tot_moi_comment = data_tong.map(item => item.comment_data_llm.danh_sach_tu_tot.length);
                const tu_xau_moi_comment = data_tong.map(item => item.comment_data_llm.danh_sach_tu_xau.length);

                show_bieu_do_tot_xau_tren_comment(tu_tot_moi_comment, tu_xau_moi_comment)

                const data_cam_xuc = tinh_cam_xuc_theo_tu_khoa(data_tong);
                show_bieu_do_phan_bo_cam_xuc_theo_tu_khoa(data_cam_xuc);


                brandInput.value = ""
                wordSearchInput.value = ""
            } else {
                resultDiv.innerHTML = `<a href="{{ route('user.gui_danh_gia') }}?brand=${brandName}" class="link_request link-light link-offset-2 link-underline link-underline-opacity-100">${result.detail || "Không có dữ liệu đánh giá."} sang trang yêu cầu đánh giá</a>`;
                bieu_do_pie_post_group_page?.destroy();
                bieu_do_horizontal_bar_chart_post_group_page?.destroy();
                bieu_do_horizontal_bar_chart_post_word_search?.destroy();
                sentimentChart?.destroy();
                wordChartCoutChart?.destroy();
                wordCloudChartGood?.destroy();
                wordCloudChartBad?.destroy();
                bieu_do_top_10_xau?.destroy();
                bieu_do_top_10_tot?.destroy();
                lineChart?.destroy();
                bieu_do_line_chart_comment_time?.destroy();
                bieu_do_horizontal_bar_chart_comment_group_page?.destroy();
                bieu_do_tot_xau_tren_comment?.destroy();
                bieu_do_cam_xuc_theo_tu_khoa?.destroy();
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
            bieu_do_pie_post_group_page?.destroy();
            bieu_do_horizontal_bar_chart_post_group_page?.destroy();
            bieu_do_horizontal_bar_chart_post_word_search?.destroy();
            sentimentChart?.destroy();
            wordChartCoutChart?.destroy();
            wordCloudChartGood?.destroy();
            wordCloudChartBad?.destroy();
            bieu_do_top_10_xau?.destroy();
            bieu_do_top_10_tot?.destroy();
            lineChart?.destroy();
            bieu_do_line_chart_comment_time?.destroy();
            bieu_do_horizontal_bar_chart_comment_group_page?.destroy();
            bieu_do_tot_xau_tren_comment?.destroy();
            bieu_do_cam_xuc_theo_tu_khoa?.destroy();
            await evaluateBrand();
            Swal.close();
        });
    });
</script>