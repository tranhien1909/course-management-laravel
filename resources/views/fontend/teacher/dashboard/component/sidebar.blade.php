<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="backend/img/profile_small.jpg" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David
                                    Williams</strong>

                            </span>
                            <span class="status online" style="color: limegreen;">● Online</span>
                            <span class="text-muted text-xs block">Teacher <b class="caret"></b></span>

                        </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    <img src="{{ asset('backend/img/smart_logo.png') }}" alt="" style="width: 60px;">
                </div>
            </li>
            <li class="active">
                <a href="{{ route('dashboard.index') }}"><i class="fa-solid fa-home"></i> <span
                        class="nav-label">Dashboard</span></a>
            </li>
            <li>
                <a href="metrics.html"><i class="fa-solid fa-chalkboard"></i> <span class="nav-label">Lớp học của
                        tôi</span>
                </a>
            </li>
            <li>
                <a href="metrics.html"><i class="fa-solid fa-clipboard-user"></i> <span class="nav-label">Điểm
                        danh</span>
                </a>
            </li>
            <li>
                <a href="metrics.html"><i class="fa-solid fa-calendar-days"></i> <span class="nav-label">Lịch dạy
                        học</span>
                </a>
            </li>
            <li>
                <a href="metrics.html"><i class="fa-solid fa-print"></i> <span class="nav-label">Tài liệu giảng
                        dạy</span>
                </a>
            </li>
            <li>
                <a href="metrics.html"><i class="fa-solid fa-chart-line"></i> <span class="nav-label">Báo cáo & Thống
                        kê</span>
                </a>
            </li>
            <li>
                <a href="{{ route('auth.logout') }}"><i class="fa-solid fa-sign-out"></i><span
                        class="nav-label">Logout</span>
                </a>
            </li>

        </ul>

    </div>
</nav>
