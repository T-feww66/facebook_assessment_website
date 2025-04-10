<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h3 class="card-title text-center">Đăng Nhập</h3>

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

                        <form action="{{ route('userPostLogin') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3 d-grid">
                                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                            </div>
                        </form>
                        <p class="mt-3 text-center text-muted">
                            Bạn chưa có tài khoản? <a href="{{ route('userGetRegister') }}" class="text-primary">Đăng kí</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>