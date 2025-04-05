<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
    <!-- Sử dụng Bootstrap 5 -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .sidebar-item {
            transition: 0.3s;
        }

        .sidebar-item:hover {
            background-color: #f8f9fa !important;
            /* Màu nền sáng hơn */
            color: #212529 !important;
            /* Chữ đậm hơn */
        }
    </style>

</head>

<body class="bg-light">
    <!-- Header -->
    @include("admin.includes.header")
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="bg-primary text-white p-4 vh-100" style="width: 250px;">
            <a href="{{ route('admin.home') }}" class="text-white text-decoration-none">
                <h2 class="h4 fw-bold"><i class="bi bi-speedometer2"></i>Wellcome {{Auth::user()->username}}</h2>
            </a>
            <nav class="mt-4">
                <ul class="list-unstyled">
                    <li class="mt-2">
                        <a href="{{ route('admin.danhmuc') }}" class="d-flex align-items-center py-2 px-3 rounded text-white text-decoration-none sidebar-item">
                            <i class="bi bi-list me-2"></i> Quản lí danh mục
                        </a>
                    </li>
                    <li class="mt-2">
                        <a href="{{ route('admin.users') }}" class="d-flex align-items-center py-2 px-3 rounded text-white text-decoration-none sidebar-item">
                            <i class="bi bi-people-fill me-2"></i> Quản lí người dùng
                        </a>
                    </li>
                    <li class="mt-2">
                        <a href="{{ route('admin.pages') }}" class="d-flex align-items-center py-2 px-3 rounded text-white text-decoration-none sidebar-item">
                            <i class="bi bi-file-earmark-text me-2"></i> Quản lí trang
                        </a>
                    </li>
                    <li class="mt-2">
                        <a href="{{ route('admin.posts') }}" class="d-flex align-items-center py-2 px-3 rounded text-white text-decoration-none sidebar-item">
                            <i class="bi bi-newspaper me-2"></i> Quản lí bài viết
                        </a>
                    </li>
                    <li class="mt-2">
                        <a href="{{ route('admin.library') }}" class="d-flex align-items-center py-2 px-3 rounded text-white text-decoration-none sidebar-item">
                            <i class="bi bi-folder2 me-2"></i> Quản lí thư viện
                        </a>
                    </li>
                    <li class="mt-2">
                        <a href="{{ route('getLogout') }}" class="d-flex align-items-center py-2 px-3 rounded text-white text-decoration-none sidebar-item">
                            <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    @include("admin.includes.footer")
</body>

</html>