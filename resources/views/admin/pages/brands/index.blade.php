@extends('layouts.admin')

@section("title", "Danh sách thương hiệu")
@section("header", "Quản lý thương hiệu")

@section('content')
<h2 class="h2 fw-bold">Danh Sách Thương Hiệu</h2>
<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên thương hiệu</th>
            <th>File comment</th>
        </tr>
    </thead>
    <tbody>
        @foreach($brands as $brand)
        <tr>
            <td>{{ $brand->id }}</td>
            <td>{{ $brand->brand_name }}</td>
            <td>{{ $brand->comment_file }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{route('admin.brands.evaluate') }}">Đến trang đánh giá thương hiệu</a>
@endsection