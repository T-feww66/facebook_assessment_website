@extends('layouts.admin')

@section("title", "Danh sách thương hiệu")
@section("header", "Quản lý thương hiệu")

@section('content')
@include("admin.includes.sidebar")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h2 class="card-title">Danh sách thương hiệu</h2>
                            <p class="card-title-desc">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi quos tempore aspernatur. Vero iste nisi reprehenderit labore error tempore neque quaerat beatae! Magnam, quia. Ad, sed dolores suscipit minima beatae fugiat soluta iure accusantium modi, adipisci ipsa. Exercitationem omnis aut similique necessitatibus sed quisquam, ea itaque! Provident dolor aliquam praesentium.
                            </p>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User yêu cầu</th>
                                        <th>Tên thương hiệu</th>
                                        <th>Từ khoá tìm kiếm</th>
                                        <th>File comment</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->id }}</td>
                                        <td>{{ $brand->user_id }}</td>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td>{{ $brand->word_search }}</td>
                                        <td>{{ $brand->comment_file }}</td>
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