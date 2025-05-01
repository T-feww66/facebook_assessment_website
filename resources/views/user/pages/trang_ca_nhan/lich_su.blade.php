@extends('layouts.user')

@section("title", "Trang cá nhân")
@section("header", "Thông tin cá nhân của bạn")

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

                            <h4 class="card-title">Lịch sử đánh giá</h4>
                            <p class="card-title-desc">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi quos tempore aspernatur. Vero iste nisi reprehenderit labore error tempore neque quaerat beatae! Magnam, quia. Ad, sed dolores suscipit minima beatae fugiat soluta iure accusantium modi, adipisci ipsa. Exercitationem omnis aut similique necessitatibus sed quisquam, ea itaque! Provident dolor aliquam praesentium.
                            </p>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Từ khóa tìm kiếm</th>
                                        <th>Tên thương hiệu</th>
                                        <th>File bình luận</th>
                                        <th>Cập nhật lúc</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($brands as $index => $brand)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $brand->word_search ?? 'Không có' }}</td>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td>{{ $brand->comment_file ?? 'Chưa có' }}</td>
                                        <td>{{ $brand->updated_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <form action="{{ route('user.timkiem') }}" method="POST" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="brand_name" value="{{ $brand->brand_name }}">
                                                <input type="hidden" name="word_search" value="{{ $brand->word_search }}">
                                                <button type="submit" class="btn btn-sm btn-primary">Trực quan</button>
                                            </form>

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