@extends('layouts.user')

@section("title", "Tìm Kiếm Đánh Giá")

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Handle shapes</h4>

                        <div class="row">
                            <div class="col-xl-4 col-sm-6">
                                <div class="text-center mt-4">
                                    <h5 class="font-size-14 mb-4">Handle arrow</h5>

                                    <div dir="ltr">
                                        <div id="handle-arrow" class="rs-handle-arrow rs-range-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6">
                                <div class="text-center mt-4">
                                    <h5 class="font-size-14 mb-4">Handle arrow dashed </h5>

                                    <div dir="ltr">
                                        <div id="handle-arrow-dashed" class="rs-handle-arrow-dash rs-range-success"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Chartjs Charts</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Charts</a></li>
                            <li class="breadcrumb-item active">Chartjs Charts</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Line Chart</h4>

                        <canvas id="lineChart" height="300"></canvas>

                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Bar Chart</h4>

                        <canvas id="bar" height="300"></canvas>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Pie Chart</h4>

                        <canvas id="pie" height="260"></canvas>

                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Donut Chart</h4>

                        <canvas id="doughnut" height="260"></canvas>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Polar Chart</h4>

                        <canvas id="polarArea" height="300"> </canvas>

                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Radar Chart</h4>

                        <canvas id="radar" height="300"></canvas>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>
@endsection