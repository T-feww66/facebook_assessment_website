<!-- resources/views/user/includes/header.blade.php -->
<header>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="#" style="transition: color 0.3s ease;">Hệ thống Đánh Giá Thương Hiệu</a>
            <button class="navbar-toggler text-white border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white active" aria-current="page" href="/user">Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('user.gioithieu') }}">Giới Thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('user.timkiem') }}">Tìm Kiếm Đánh Giá</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('user.sosanh') }}">So Sánh Đánh Giá Thương Hiệu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>