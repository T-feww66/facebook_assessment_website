@extends('layouts.admin')

@section("title", "Danh sách người dùng")
@section("header", "Quản lý người dùng")

@section('content')
<h2 class="h2 fw-bold">Danh Sách Người Dùng</h2>

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

<a href="{{ route('getAddUser') }}" class="btn btn-primary rounded-pill">
    <i class="bi bi-plus-circle"></i> Thêm user admin
</a>

<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Họ và Tên</th>
            <th>Email</th>
            <th>Level</th>
            <th>Số Điện Thoại</th>
            <th>Địa Chỉ</th>
            <th>Trạng Thái</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->level }}</td>
            <td>{{ $user->sdt }}</td>
            <td>{{ $user->dia_chi }}</td>
            <td>
                @if($user->status)
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('edit_user', $user->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                <form action="{{ route('delete_user', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection