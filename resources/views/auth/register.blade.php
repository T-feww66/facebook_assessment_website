<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="d-flex align-items-center justify-content-center vh-100 bg-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="text-center text-dark fw-bold">Đăng kí</h2>

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

                        <form action="{{ route('postRegister') }}" method="post" class="mt-4">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tên đăng nhập</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Nhập vào tên đăng nhập" value="{{ old('username') }}">
                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" placeholder="Nhập vào họ và tên" value="{{ old('fullname') }}">
                                @error('fullname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập vào mật khẩu của bạn">
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
                        <p class="mt-3 text-center text-muted">
                            Bạn đã có tài khoản? <a href="{{ route('getLogin') }}" class="text-primary">Đăng nhập</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>