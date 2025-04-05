@extends('layouts.admin')

@section("title", "Add Danh Muc")
@section("header", "Thêm danh mục tại đây")


@section("content")
<form action="{{ route('add_danh_muc') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <label for="tieu_de">Tieu De</label>
    <input type="text" name="tieu_de">
    <input type="submit" value="add danh muc">
</form>
@endsection