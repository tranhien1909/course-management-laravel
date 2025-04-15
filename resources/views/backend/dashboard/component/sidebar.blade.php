<style>
    .btn-logout {
        background: none;
        border: none;
        color: #a7b1c2;
        text-align: left;
        width: 100%;
        padding: 10px 24px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    .btn-logout:hover {
        background-color: #293846;
        color: white;
    }
</style>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle"
                            src="{{ Auth::check() ? Auth::user()->avatar : asset('backend/img/profile_small.jpg') }}"
                            style="width: 96px; height: 96px;" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong
                                    class="font-bold">{{ Auth::check() ? Auth::user()->fullname : 'Khách' }}</strong>

                            </span>
                            <span class="status online" style="color: limegreen;">● Admin</span>

                        </span> </a>
                </div>
                <div class="logo-element">
                    <img src="{{ asset('backend/img/smart_logo.png') }}" alt="" style="width: 60px;">
                </div>
            </li>
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-home"></i> <span class="nav-label">Trang
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
            <li class="{{ request()->routeIs('dashboard.thongke') ? 'active' : '' }}">
                <a href="{{ route('dashboard.thongke') }}"><i class="fa-solid fa-chart-line"></i> <span
                        class="nav-label">Báo cáo & Thống
                        kê</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.notifications.create') ? 'active' : '' }}">
                <a href="{{ route('admin.notifications.create') }}"><i class="fa-solid fa-bell"></i> <span
                        class="nav-label">Thông báo</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('dashboard.profile') ? 'active' : '' }}">
                <a href="{{ route('dashboard.profile') }}"><i class="fa-solid fa-chart-line"></i> <span
                        class="nav-label">Profile</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('auth.logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fa-solid fa-sign-out"></i> <span class="nav-label">Logout</span>
                    </button>
                </form>
            </li>

        </ul>

    </div>
</nav>
