@extends('layouts.admin')

@section("title", "Edit Danh Muc")
@section("header", "Chỉnh sửa danh mục tại đây")

@section("content")
<form action="{{ route('update_danhmuc', $danhmuc->id) }}" method="post">
    @csrf
    @method('POST')
    <div class="mb-3">
        <label for="tieu_de" class="form-label">Tiêu Đề</label>
        <input type="text" name="tieu_de" class="form-control" value="{{ $danhmuc->tieu_de }}" required>
    </div>

    <button type="submit" class="btn btn-success">Cập nhật</button>
</form>
@endsection