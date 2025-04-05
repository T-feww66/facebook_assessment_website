@extends('layouts.admin')

@section("title", "Danh sách người dùng")
@section("header", "Quản lý người dùng")

@section('content')

@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error)
    <li class="text-danger"> {{ $error }}</li>
    @endforeach
</ul>
@endif

@if(session('notice'))
<div class="alert alert-success">
    {{ session('notice') }}
</div>
@endif

<form action="{{ route('update_user', $user->id) }}" method="post" class="mt-4">
    @csrf
    @method('POST')
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $user->email) }}" required>
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Tên đăng nhập</label>
        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
            value="{{ old('username', $user->username) }}" required>
        @error('username')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Họ và tên</label>
        <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror"
            value="{{ old('fullname', $user->fullname) }}" required>
        @error('fullname')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
</form>

<p class="mt-3 text-center text-muted">
    <a href="{{ route('admin.users') }}" class="text-primary">Quay lại danh sách người dùng</a>
</p>

@endsection