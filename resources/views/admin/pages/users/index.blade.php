@extends('layouts.admin')

@section("title", "Danh sách người dùng")
@section("header", "Quản lý người dùng")

@section('content')
@include("admin.includes.sidebar")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

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
                            <p class="card-title-desc">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi quos tempore aspernatur. Vero iste nisi reprehenderit labore error tempore neque quaerat beatae! Magnam, quia. Ad, sed dolores suscipit minima beatae fugiat soluta iure accusantium modi, adipisci ipsa. Exercitationem omnis aut similique necessitatibus sed quisquam, ea itaque! Provident dolor aliquam praesentium.
                            </p>

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
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
                                            @if ($user->level == 0)
                                            <form action="{{ route('delete_user', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                                            </form>
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