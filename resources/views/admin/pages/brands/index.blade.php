@extends('layouts.admin')

@section("title", "Danh sách thương hiệu")
@section("header", "Quản lý thương hiệu")

@section('content')
<h2 class="h2 fw-bold">Danh Sách Thương Hiệu</h2>

@if (count($errors) >0)
<ul>
    @foreach($errors->all() as $error)
    <li class="text-danger"> {{ $error }}</li>
    @endforeach
</ul>
@endif

@if (session('status'))
<ul>
    <li class="text-danger"> {{ session('status') }}</li>
</ul>
@endif

@if(session('notice'))
<div class="alert alert-success">
    {{ session('notice') }}
</div>
@endif
<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên thương hiệu</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($brands as $brand)
        <tr>
            <td>{{ $brand->id }}</td>
            <td>{{ $brand->brand_name }}</td>
            <!-- <td>
                <a href="{{ route('edit_brand', $brand->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                <form action="{{ route('delete_brand', $brand->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                </form>
            </td> -->
        </tr>
        @endforeach
    </tbody>
</table>
@endsection