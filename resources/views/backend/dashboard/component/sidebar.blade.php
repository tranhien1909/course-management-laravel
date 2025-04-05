<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="{{ asset('backend/img/profile_small.jpg') }}" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong
                                    class="font-bold">{{ Auth::user()->name }}</strong>

                            </span>
                            <span class="status online" style="color: limegreen;">● Online</span>
                            <span class="text-muted text-xs block">Admin <b class="caret"></b></span>

                        </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('dashboard.profile') }}">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    <img src="{{ asset('backend/img/smart_logo.png') }}" alt="" style="width: 60px;">
                </div>
            </li>
            <li class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}"><i class="fa-solid fa-home"></i> <span class="nav-label">Trang
                        chủ</span></a>
            </li>
            <li class="{{ request()->routeIs('course.index') ? 'active' : '' }}">
                <a href="{{ route('course.index') }}"><i class="fas fa-book"></i> <span class="nav-label">QL Khoá
                        học</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('class.index') ? 'active' : '' }}">
                <a href="{{ route('class.index') }}"><i class="fas fa-chalkboard"></i> <span class="nav-label">QL Lớp
                        học</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('teacher.index') ? 'active' : '' }}">
                <a href="{{ route('teacher.index') }}"><i class="fas fa-chalkboard-teacher"></i> <span
                        class="nav-label">QL Giảng
                        viên</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('student.index') ? 'active' : '' }}">
                <a href="{{ route('student.index') }}"><i class="fas fa-user-graduate"></i> <span class="nav-label">QL
                        Học viên</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('spending.index') ? 'active' : '' }}">
                <a href="{{ route('spending.index') }}"><i class="fas fa-edit"></i> <span class="nav-label">QL Thu
                        chi</span>
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
