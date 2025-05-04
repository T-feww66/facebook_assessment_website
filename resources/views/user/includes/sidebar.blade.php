<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu site-bar-black">
    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('assets/images/users/avatar-1.jpg')}}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1 color-b">{{Auth::user()->username}}</h4>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="/" class=" waves-effect">
                        <i class="ri-home-line"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.gioithieu') }}" class=" waves-effect">
                        <i class="ri-information-line"></i>
                        <span>Giới thiệu</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.crawl') }}" class=" waves-effect">
                        <i class="ri-donut-chart-line"></i>
                        <span>Tìm kiếm và đánh giá</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.sosanh') }}" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Đánh giá thương hiệu</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.timkiem') }}" class=" waves-effect">
                        <i class="ri-line-chart-line"></i>
                        <span>Trực quan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.trang_ca_nhan') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Trang cá nhân</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.lich_su') }}" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Lịch sử</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

<!-- end sidebar  -->