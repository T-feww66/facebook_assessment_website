@extends('layouts.user')

@section("title", "Gửi đánh giá")

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-white">Gửi Đánh Giá</h2>
        <p class="text-white-50">Nhập từ khóa để gửi yêu cầu đánh giá của thương hiệu bạn quan tâm.</p>
    </div>

    <!-- Form gửi yêu cầu đánh giá thương hiệu -->
    <form id="sendRequest" action="{{ route('user.post_gui_danh_gia') }}" method="post" class="d-flex mb-3">
        @csrf
        <input id="email_request" class="form-control me-1" type="email" name="email" placeholder="🔍 Nhập vào email..."
            aria-label="Gửi yêu cầu" required>
        <input type="hidden" name="brand_name" value="{{$brandName}}">
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <button class="btn btn-success" type="submit">Gửi yêu cầu</button>
    </form>

    @if (session('notice'))
    <div class="alert alert-success">
        {{ session('notice') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif


    <h2 id="result-brand" style="text-align: center; color: #fff"></h2>
</div>
@endsection