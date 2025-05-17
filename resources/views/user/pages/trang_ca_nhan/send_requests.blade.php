@extends('layouts.user')

@section("title", "Trang cá nhân")
@section("header", "Lịch sữ yêu cầu đánh giá")

@section('content')
@include("user.includes.sidebar")

<!-- table data  -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Lịch sử yêu cầu đánh giá</h4>
                            <p class="card-title-desc">Danh sách các yêu cầu bạn đã gửi để đánh giá thương hiệu và trạng thái xử lý của hệ thống.</p>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Từ khóa tìm kiếm</th>
                                        <th>Tên thương hiệu</th>
                                        <th>Trạng thái</th>
                                        <th>Cập nhật lúc</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($send_requests as $index => $request)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $request->word_search ?? 'Không có' }}</td>
                                        <td>{{ $request->brand_name }}</td>
                                        <td>
                                            @if ($request->status == 0)
                                            <span class="badge bg-warning">Đang xử lý</span>
                                            @elseif ($request->status == 1)
                                            <span class="badge bg-success">Xử lý xong</span>
                                            @elseif ($request->status == 2)
                                            <span class="badge bg-danger">Không có dữ liệu</span>
                                            @else
                                            <span class="badge bg-secondary">Không xác định</span>
                                            @endif
                                        </td>
                                        <td>{{ $request->updated_at}}</td>
                                        <td>
                                            @if ($request->status == 1)
                                            <a href="{{ route('user.timkiem', ['brand_name' => $request->brand_name, 'word_search' => $request->word_search]) }}" class="btn btn-primary">
                                                Trực quan
                                            </a>
                                            @else
                                            <span class="text-muted">Chờ xử lý</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>
@endsection