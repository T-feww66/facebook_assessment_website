<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            @if (request()->is('user/trang-ca-nhan') || request()->is('user/trang-ca-nhan/lich-su'))
            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
            @endif

        </div>
        <nav>
            <!-- LOGO -->
            <ul class="navbar-nav d-flex flex-row align-items-center list-unstyled m-0 p-0">
                <li class="px-2">
                    <a class="nav-link text-white {{ request()->is('user') ? 'active' : '' }}" href="/user">Trang Chủ</a>
                </li>
                <li class="px-2">
                    <a class="nav-link text-white {{ request()->is('user/gioi-thieu') ? 'active' : '' }}" href="{{ route('user.gioithieu') }}">Giới Thiệu</a>
                </li>
                <li class="px-2">
                    <a class="nav-link text-white {{ request()->is('user/crawl') ? 'active' : '' }}" href="{{ route('user.crawl') }}">Tìm kiếm và đánh giá </a>
                </li>
                <li class="px-2">
                    <a class="nav-link text-white {{ request()->is('user/so-sanh') ? 'active' : '' }}" href="{{ route('user.sosanh') }}">So Sánh Đánh Giá Thương Hiệu</a>
                </li>
                <li class="px-2">
                    <a class="nav-link text-white {{ request()->is('user/truc-quan') ? 'active' : '' }}" href="{{ route('user.timkiem') }}">Trực quan</a>
                </li>
                <li class="px-2">
                    <a class="nav-link text-white {{ request()->is('user/trang-ca-nhan') ? 'active' : '' }}" href="{{ route('user.trang_ca_nhan') }}">Trang cá nhân</a>
                </li>
            </ul>
        </nav>

    </div>
</header>