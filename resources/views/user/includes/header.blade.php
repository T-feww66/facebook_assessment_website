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
                        <a class="nav-link text-white {{ request()->is('user') ? 'active' : '' }}" aria-current="page" href="/user">Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->is('user/gioi-thieu') ? 'active' : '' }}" href="{{ route('user.gioithieu') }}">Giới Thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->is('user/tim-kiem') ? 'active' : '' }}" href="{{ route('user.timkiem') }}">Tìm Kiếm Đánh Giá</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->is('user/crawl') ? 'active' : '' }}" href="{{ route('user.crawl') }}">Tìm kiếm và đánh giá 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->is('user/so-sanh') ? 'active' : '' }}" href="{{ route('user.sosanh') }}">So Sánh Đánh Giá Thương Hiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->is('user/profile') ? 'active' : '' }}" href="{{ route('user.trang_ca_nhan') }}">Trang cá nhân</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>