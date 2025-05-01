@extends('layouts.user')

@section("title", "Trang cá nhân")
@section("header", "Thông tin cá nhân của bạn")

@section('content')
@include("user.includes.sidebar")

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('notice'))
            <div class="alert alert-success">
                {{ session('notice') }}
            </div>
            @endif

            <form action=" {{ route('user.update_user', $user->id) }}" method="post" class="mt-4">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email của bạn" value="{{ $user->email }}" readonly>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên đăng nhập</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                        placeholder="Tên đăng nhập" value="{{ $user->username }}" require>
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="sdt" class="form-control @error('sdt') is-invalid @enderror"
                        placeholder="Số điện thoại" value="{{ $user->sdt }}" require min="10" max="10">
                    @error('sdt')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" name="dia_chi" class="form-control @error('dia_chi') is-invalid @enderror"
                        placeholder="Địa chỉ hiện tại" value="{{ $user->dia_chi }}" require>
                    @error('dia_chi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror"
                        placeholder="Họ và tên đầy đủ" value="{{ $user->fullname }}" require>
                    @error('fullname')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success w-100">Lưu thay đổi</button>
            </form>

            <p class="mt-3 text-center text-white">
                <a href="/user" class="text-decoration-none">← Quay lại trang chính</a>
            </p>
        </div>
    </div>
</div>

@endsection