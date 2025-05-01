@extends('layouts.user')

@section("title", "So Sánh Thương Hiệu")

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-white">So Sánh Thương Hiệu</h2>
            <p class="text-white-50">Chọn các thương hiệu để xem bảng so sánh đánh giá tổng quan.</p>
        </div>

        <!-- Form so sánh -->
        <form id="evaluateCompareForm">
            <div class="row g-3 mb-4">
                <div class="col-md-5">
                    <select name="brand_1" id="brand_1" class="form-select" required>
                        <option value="">-- Chọn thương hiệu 1 --</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->brand_name }}">{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <select name="brand_2" id="brand_2" class="form-select" required>
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

        <div id="result-brand"></div>

        <div class="chart-grid" id="chart_grid_id">
            <div class="chart-card">
                <canvas width="500" height="500" id="wordChart"></canvas>
            </div>

            <div class="chart-card">
                <canvas width="500" height="500" id="lineChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    let wordChart = null;
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

    // === BIỂU ĐỒ CẢM XÚC THEO THỜI GIAN ===
    function showEmotionOverTimeChart(data1, data2) {
        if (lineChart) lineChart.destroy();

        const ctx = document.getElementById('lineChart').getContext('2d');

        const labels1 = data1.map(entry => entry.date);
        const labels2 = data2.map(entry => entry.date);
        const labels = [...new Set([...labels1, ...labels2])]; // Hợp nhất ngày không trùng lặp

        // Tạo map để tra cứu theo ngày
        const mapData = (data, labelSet) => {
            const map = {};
            data.forEach(entry => {
                map[entry.date] = entry;
            });
            return labelSet.map(date => map[date] ? map[date].positive : 0);
        };

        const mapNegative = (data, labelSet) => {
            const map = {};
            data.forEach(entry => {
                map[entry.date] = entry;
            });
            return labelSet.map(date => map[date] ? map[date].negative : 0);
        };

        const positiveData1 = mapData(data1, labels);
        const negativeData1 = mapNegative(data1, labels);
        const positiveData2 = mapData(data2, labels);
        const negativeData2 = mapNegative(data2, labels);

        lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                        label: 'Thương hiệu 1 - Tốt (%)',
                        data: positiveData1,
                        borderColor: '#ed7c7c',
                        backgroundColor: '#ed7c7c44',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.3
                    },
                    {
                        label: 'Thương hiệu 1 - Xấu (%)',
                        data: negativeData1,
                        borderColor: '#db90ef',
                        backgroundColor: '#db90ef44',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.3
                    },
                    {
                        label: 'Thương hiệu 2 - Tốt (%)',
                        data: positiveData2,
                        borderColor: '#efe095',
                        backgroundColor: '#efe09544',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.3
                    },
                    {
                        label: 'Thương hiệu 2 - Xấu (%)',
                        data: negativeData2,
                        borderColor: '#91daf7',
                        backgroundColor: '#91daf744',
                        borderWidth: 2,
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
                        text: 'Biến động cảm xúc theo thời gian giữa 2 thương hiệu',
                        color: '#fff',
                        font: {
                            size: 24
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

    // === BIỂU ĐỒ CỘT: TỪ TỐT/XẤU ===
    function showWordCountChart(totXau1, totXau2, brand_1, brand_2) {
        if (wordChart) wordChart.destroy();

        const ctx = document.getElementById('wordChart').getContext('2d');
        wordChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Từ Tốt', 'Từ Xấu'],
                datasets: [{
                        label: brand_1,
                        data: [totXau1[0], totXau1[1]],
                        backgroundColor: ['rgba(75, 192, 182, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                        borderColor: ['rgb(75, 192, 192)', 'rgb(54, 162, 235)'],
                        borderWidth: 1
                    },
                    {
                        label: brand_2,
                        data: [totXau2[0], totXau2[1]],
                        backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                        borderColor: ['rgb(75, 192, 192)', 'rgb(54, 162, 235)'],
                        borderWidth: 1
                    },
                ]
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
                        formatter: value => typeof value === "number" ? value.toFixed(2) + '%' : value
                    },
                    title: titleConfig('Biểu đồ so sánh phần trăm tốt xấu', 24),
                    legend: {
                        display: true,
                        labels: {
                            color: '#fff'
                        }
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

    async function evaluateCompareBrand(e) {
        const brand1Input = document.getElementById('brand_1');
        const brand2Input = document.getElementById('brand_2');
        const brand_1 = brand1Input.value.toLowerCase().trim();
        const brand_2 = brand2Input.value.toLowerCase().trim();

        const form = e.target;
        const formData = new FormData(form);
        const resultDiv = document.getElementById('result-brand');
        const chartGrid = document.getElementById('chart_grid_id');

        // Hiển thị đang xử lý
        resultDiv.innerHTML = `<h2 style="text-align: center; color: #fff">Đang xử lý...</h2>`;

        try {
            const response = await fetch("http://localhost:60074/danh_gia_thuong_hieu/so_sanh_thuong_hieu", {
                method: "POST",
                headers: {
                    "API-Key": '{{ config("services.crawl_api.key") }}'
                },
                body: formData
            });

            var result = await response.json();
            if (!response.ok) {
                wordChart?.destroy();
                lineChart?.destroy();
                resultDiv.innerHTML = `<a href="{{ route('user.gui_danh_gia') }}?brand_1=${brand_1}?brand_2=${brand_2}" class="link_request link-light link-offset-2 link-underline link-underline-opacity-100">${result.detail || "Không có dữ liệu đánh giá."} sang trang yêu cầu đánh giá</a>`;
            }

            chartGrid.style.display = "grid";
            resultDiv.innerHTML = `<h2 style = "text-align: center; color: #fff">So sánh ${brand_1} VS ${brand_2}</h2>`;


            const data1 = result.data[0].data_brand1;
            const data2 = result.data[1].data_brand2;

            const phan_tram_tot_xau1 = [parseFloat(data1[0].brand_data_llm.GPT.phan_tram_tot), parseFloat(data1[0].brand_data_llm.GPT.phan_tram_xau)];
            const phan_tram_tot_xau2 = [parseFloat(data2[0].brand_data_llm.GPT.phan_tram_tot), parseFloat(data2[0].brand_data_llm.GPT.phan_tram_xau)];
            showWordCountChart(
                phan_tram_tot_xau1,
                phan_tram_tot_xau2,
                brand_1,
                brand_2
            );

            // Group những thời gian bình luận lại với nhau
            const dataGroup1 = groupEmotionByDate(data1)
            const dataGroup2 = groupEmotionByDate(data2)
            showEmotionOverTimeChart(dataGroup1, dataGroup2)

        } catch (error) {
            resultDiv.innerHTML = `<div class="alert alert-danger">Lỗi: ${result.detail}</div>`;
        }
    }

    // === LẮNG NGHE SUBMIT FORM ===
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("evaluateCompareForm").addEventListener("submit", async (e) => {
            e.preventDefault();
            wordChart?.destroy();
            lineChart?.destroy();
            await evaluateCompareBrand(e);
        });
    });
</script>