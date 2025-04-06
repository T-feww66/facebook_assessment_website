<!-- resources/views/admin/users.blade.php -->
@extends('layouts.admin')

@section("title", "Danh Muc")
@section("header", "Danh Sach Danh Muc")

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<h2 class="h2 text-dark fw-bold">Danh Sách Danh Mục</h2>

<div class="mb-3">
    <a href="{{ route('getAddDanhMuc') }}" class="btn btn-primary btn-lg rounded-pill">
        <i class="bi bi-plus-circle"></i> Thêm Danh Mục
    </a>
</div>
<table class="table table-dark table-striped table-bordered mt-4">
    <thead>
        <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Tiêu Đề</th>
            <th class="px-4 py-2">Link</th>
            <th class="px-4 py-2">Ngày Tạo</th>
            <th class="px-4 py-2">Ngày Cập Nhật</th>
            <th class="px-4 py-2">Trạng Thái</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($danhmuc as $item)
        <tr>
            <td class="px-4 py-2">{{ $item->id }}</td>
            <td class="px-4 py-2">{{ $item->tieu_de }}</td>
            <td class="px-4 py-2">{{ $item->link }}</td>
            <td class="px-4 py-2">{{ $item->created_at }}</td>
            <td class="px-4 py-2">{{ $item->updated_at }}</td>
            <td class="px-4 py-2">{{ $item->status ? 'Active' : 'Inactive' }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('edit_danhmuc', $item->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                <form action="{{ route('delete_danhmuc', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                </form>
            </td>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection