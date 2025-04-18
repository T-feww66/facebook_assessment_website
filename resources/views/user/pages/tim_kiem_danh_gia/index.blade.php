@extends('layouts.user')

@section("title", "Tìm Kiếm Đánh Giá")

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-white">Tìm Kiếm Đánh Giá</h2>
        <p class="text-white-50">Nhập từ khóa để tra cứu đánh giá của thương hiệu bạn quan tâm.</p>
    </div>

    <!-- Thương hiệu nổi bật -->
    <div class="mb-4">
        <h5 class="text-white mb-3">Thương hiệu nổi bật:</h5>
        <ul class="list-unstyled d-flex flex-wrap gap-2">
            @foreach($brands as $brand)
            <li class="brands">
                <a class="badge bg-white text-primary px-3 py-2 {{ $brand->brand_name }}">{{ $brand->brand_name }}</a>
            </li>
            @endforeach
        </ul>
    </div>


    <!-- Form tìm kiếm -->
    <form id="evaluateForm" class="d-flex mb-3">
        <input id="brandInput" class="form-control me-1" type="search" placeholder="🔍 Nhập tên thương hiệu..."
            aria-label="Tìm kiếm">
        <button class="btn btn-success" type="submit">Search</button>
    </form>

    <h2 id="result-brand" style="text-align: center; color: #fff"></h2>


    <div class="chart-grid" id="chart_grid_id">
        <div class="chart-card">
            <canvas width="500" height="500" id="pieChart"></canvas>
        </div>

        <div class="chart-card">
            <canvas width="500" height="500" id="wordChart"></canvas>
        </div>

        <div class="chart-card">
            <canvas width="500" height="500" id="wordCloudChartGood"></canvas>
        </div>

        <div class="chart-card">
            <canvas width="500" height="500" id="wordCloudChartBad"></canvas>
        </div>

        <div class="chart-card">
            <canvas width="500" height="500" id="lineChart"></canvas>
        </div>
    </div>
</div>
@endsection



<script>
    let sentimentChart = null;
    let wordChartCoutChart = null;
    let wordCloudChartGood = null;
    let wordCloudChartBad = null;
    let lineChart = null;


    // === CẤU HÌNH CHUNG ===
    const titleConfig = (text, size = 24) => ({
        display: true,
        text,
        color: '#fff',
        font: {
            size
        }
    });

    const axisConfig = (label) => ({
        title: {
            display: true,
            text: label,
            color: '#fff',
            font: {
                size: 16
            }
        },
        ticks: {
            color: '#fff'
        }
    });

    const optionsWordChart = (label, size = 28) => ({
        color: '#fff',
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: label,
                color: '#fff',
                font: {
                    size
                }
            },
        }
    })

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
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: value => typeof value === "number" ? value.toFixed(2) + '%' : value
                    },
                    legend: {
                        labels: {
                            color: '#fff'
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
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                    borderColor: ['rgb(75, 192, 192)', 'rgb(54, 162, 235)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        color: '#fff',
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

        if (wordCloudChartGood) wordCloudChartGood.destroy();

        const ctx = document.getElementById("wordCloudChartGood");
        wordCloudChartGood = new Chart(ctx, {
            type: "wordCloud",
            data: {
                labels: words.map(w => w.word),
                datasets: [{
                    label: 'Từ tích cực phổ biến',
                    data: words.map((d) => d.weight * 10),
                }]
            },
            options: optionsWordChart("Biểu đồ WordChart tích cực phổ biến")
        });
    }

    function showWordCloudChartBad(words) {

        if (wordCloudChartBad) wordCloudChartBad.destroy();

        const ctx = document.getElementById("wordCloudChartBad");
        wordCloudChartBad = new Chart(ctx, {
            type: "wordCloud",
            data: {
                labels: words.map(w => w.word),
                datasets: [{
                    label: 'Từ tiêu cực phổ biến',
                    data: words.map((d) => d.weight * 10),
                }]
            },
            options: optionsWordChart("Biểu đồ WordChart tiêu cực phổ biến")
        });
    }

    //
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
                        borderColor: '#efe190',
                        borderWidth: 2,
                        backgroundColor: '#efe19044',
                        fill: false,
                        tension: 0.3
                    },
                    {
                        label: 'Từ Xấu (%)',
                        data: negativeData,
                        borderColor: '#e3c0fd',
                        borderWidth: 2,
                        backgroundColor: '#e3c0fd44',
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
                        color: '#fff',
                        font: {
                            size: 28
                        }
                    },
                    legend: {
                        labels: {
                            color: '#fff'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#fff'
                        },
                        title: {
                            display: true,
                            text: 'Ngày',
                            color: '#fff'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#fff'
                        },
                        title: {
                            display: true,
                            text: 'Phần trăm (%)',
                            color: '#fff'
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


    // === GỌI API & XỬ LÝ ===
    async function evaluateBrand() {
        const brandInput = document.getElementById('brandInput');
        const brandName = brandInput.value.trim();

        const resultDiv = document.getElementById('result-brand');
        const chartGrid = document.getElementById('chart_grid_id');

        if (!brandName) return alert("Vui lòng nhập tên thương hiệu.");

        resultDiv.innerText = 'Đang xử lý...';

        const formData = new FormData();
        formData.append("brand", brandName);

        try {
            const response = await fetch('http://localhost:60074/danh_gia_thuong_hieu/thuong_hieu', {
                method: "POST",
                headers: {
                    "API-Key": '{{ config("services.crawl_api.key") }}'
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok && result.data) {
                const data = result.data[0];
                resultDiv.innerText = `Phân tích thương hiệu ${brandName}`;
                chartGrid.style.display = "grid";

                showSentimentChart(
                    parseFloat(data.brand_data_llm.GPT.phan_tram_tot),
                    parseFloat(data.brand_data_llm.GPT.phan_tram_xau),
                    data.brand_name
                );

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

                showWordCountChart(
                    danh_sach_tu_tot,
                    danh_sach_tu_xau
                );

                showWordCloudChartGood(dem_tu_tot);
                showWordCloudChartBad(dem_tu_xau);

                // Group những thời gian bình luận lại với nhau
                const dataGroup = groupEmotionByDate(result.data)
                showEmotionOverTimeChart(dataGroup)


                brandInput.value = ""
            } else {
                resultDiv.innerHTML = `<div class="alert alert-warning">${result.detail || "Không có dữ liệu đánh giá."}</div>`;
                sentimentChart?.destroy();
                wordChartCoutChart?.destroy();
                wordCloudChartGood?.destroy();
                wordCloudChartBad?.destroy();
                lineChart?.destroy();
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
            await evaluateBrand();
        });
    });
</script>