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
                    <!-- Hiển thị lỗi nếu có -->
                    @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li class="text-danger"> {{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    <!-- Hiển thị thông báo thành công nếu có -->
                    @if(session('notice'))
                    <div class="alert alert-success">
                        {{ session('notice') }}
                    </div>
                    @endif

                    <form action="{{ route('postAddUser') }}" method="post" class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tên đăng nhập</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Nhập vào tên đăng nhập" autocomplete="off">
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="sdt" class="form-control @error('sdt') is-invalid @enderror" placeholder="Nhập số điện thoại">
                            @error('sdt')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" name="dia_chi" class="form-control @error('dia_chi') is-invalid @enderror" placeholder="Nhập địa chỉ">
                            @error('dia_chi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" placeholder="Nhập vào họ và tên">
                            @error('fullname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập vào mật khẩu của bạn" autocomplete="off">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" name="comfirm_password" class="form-control @error('comfirm_password') is-invalid @enderror" placeholder="Nhập vào mật khẩu xác nhận">
                            @error('comfirm_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Đăng kí</button>
                    </form>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>
@endsection