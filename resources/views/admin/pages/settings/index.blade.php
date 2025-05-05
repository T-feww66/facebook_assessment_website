@extends('layouts.admin')

@section("title", "Cấu hình hệ thống")
@section("header", "Cấu hình hệ thống")

@section('content')
@include("admin.includes.sidebar")

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            
                            <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                                @csrf

                                <h5 class="mb-3">🛠️ Metadata Website</h5>
                                <div class="mb-3">
                                    <label class="form-label">Tiêu đề website</label>
                                    <input type="text" name="site_title" class="form-control" value="{{ $settings['site_title'] ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mô tả</label>
                                    <textarea name="meta_description" class="form-control" rows="2">{{ $settings['meta_description'] ?? '' }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Từ khóa</label>
                                    <input type="text" name="meta_keywords" class="form-control" value="{{ $settings['meta_keywords'] ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Favicon</label>
                                    <input type="file" name="favicon" class="form-control">
                                    @if(!empty($settings['favicon']))
                                    <img src="{{ asset($settings['favicon']) }}" width="100" height="100" class="mt-2">
                                    @endif
                                </div>
                                <hr>

                                <h5 class="mb-3">🤖 Cấu hình tài khoản FB</h5>
                                <p class="red">***Lưu ý: Bạn cần xoá cookies file trước khi đăng nhập vào tài khoản mới <button type="button" class="btn btn-danger btn-sm" onclick="deleteFile()">Xoá</button></p>
                                <div class="mb-3">
                                    <label class="form-label">Email đăng nhập</label>
                                    <input type="email" name="email" class="form-control" value="{{ $settings['email'] ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mật khẩu đăng nhập</label>
                                    <input type="text" name="password" class="form-control" value="{{ $settings['password'] ?? '' }}">
                                </div>
                                <hr>

                                <h5 class="mb-3">🤖 Cấu hình AI API</h5>

                                <div class="mb-3">
                                    <label class="form-label d-block">Mô hình sử dụng</label>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ai_provider" id="provider_openai" value="openai"
                                            @if(($settings['ai_provider'] ?? '' )=='openai' ) checked @endif>
                                        <label class="form-check-label" for="provider_openai">OpenAI</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ai_provider" id="provider_gemini" value="gemini"
                                            @if(($settings['ai_provider'] ?? '' )=='gemini' ) checked @endif>
                                        <label class="form-check-label" for="provider_gemini">Gemini</label>
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">API Key</label>
                                    <input type="text" name="ai_api_key" class="form-control" value="{{ $settings['ai_api_key'] ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tên model LLM</label>
                                    <input type="text" name="model_llm" class="form-control" value="{{ $settings['model_llm'] ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">NUM DOC (không bắt buộc)</label>
                                    <input type="text" name="num_doc" class="form-control" value="{{ $settings['num_doc'] ?? '' }}">
                                </div>

                                <hr>

                                <h5 class="mb-3">🔍 Cấu hình SEO</h5>

                                <div class="mb-3">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" value="{{ $settings['meta_title'] ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">OG Title</label>
                                    <input type="text" name="og_title" class="form-control" value="{{ $settings['og_title'] ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">OG Description</label>
                                    <textarea name="og_description" class="form-control" rows="2">{{ $settings['og_description'] ?? '' }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">OG Image</label>
                                    <input type="file" name="og_image" class="form-control">
                                    @if(!empty($settings['og_image']))
                                    <img src="{{ asset($settings['og_image']) }}" width="100" class="mt-2">
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nội dung robots.txt</label>
                                    <textarea name="robots_content" class="form-control" rows="3">{{ $settings['robots_content'] ?? '' }}</textarea>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">💾 Lưu cấu hình</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>
@endsection
<script>
    function deleteFile() {
        if (!confirm(`Bạn có chắc chắn muốn xoá cookies file"?`)) return;
        fetch(`http://localhost:60074/crawl/delete-all-cookies-files`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert('Lỗi khi xoá file.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Lỗi kết nối đến API.');
            });
    }
</script>