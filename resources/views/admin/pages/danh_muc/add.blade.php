@extends('layouts.admin')

@section("title", "Thêm danh mục")
@section("header", "Thêm danh mục tại đây")

@section("content")
<form action="{{ route('postAddDanhMuc') }}" method="post">
    @csrf
    @method('POST')
    <div class="mb-3">
        <label for="tieu_de" class="form-label">Tiêu Đề</label>
        <input type="text" name="tieu_de" class="form-control" value="" required>
    </div>
    <button type="submit" class="btn btn-success">Thêm</button>
</form>
@endsection