<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu site-bar-black">
    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="mt-3">
                <h3 class="font-size-28 mb-1 color-b">Admin panel</h3>
                <h4 class="font-size-16 mb-1 color-b">{{Auth::user()->username}}</h4>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('settings.index') }}" class=" waves-effect">
                        <i class="ri-home-line"></i>
                        <span>Cấu hình hệ thống</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class=" waves-effect">
                        <i class="ri-folder-user-line"></i>
                        <span>Quản lí người dùng</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.brands') }}" class=" waves-effect">
                        <i class="ri-donut-chart-line"></i>
                        <span>Quản lí thương hiệu đánh giá</span>
                    </a>
                </li>
                <li>
                    <a href="/" class=" waves-effect">
                        <i class="ri-map-pin-user-line"></i>
                        <span>Sang trang người dùng</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('getLogout') }}" class=" waves-effect">
                        <i class="ri-logout-box-line"></i>
                        <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

<!-- end sidebar  -->