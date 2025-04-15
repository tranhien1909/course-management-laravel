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
                            <span class="status online" style="color: limegreen;">● Teacher</span>

                        </span> </a>
                </div>
                <div class="logo-element">
                    <img src="{{ asset('backend/img/smart_logo.png') }}" alt="" style="width: 60px;">
                </div>
            </li>
            <li class="{{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                <a href="{{ route('teacher.dashboard') }}"><i class="fa-solid fa-home"></i> <span
                        class="nav-label">Dashboard</span></a>
            </li>
            <li class="{{ request()->routeIs('teacher.class') ? 'active' : '' }}">
                <a href="{{ route('teacher.class') }}"><i class="fa-solid fa-chalkboard"></i> <span
                        class="nav-label">Lớp học
                        của
                        tôi</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('teacher.lichhoc') ? 'active' : '' }}">
                <a href="{{ route('teacher.lichhoc') }}"><i class="fa-solid fa-calendar-days"></i> <span
                        class="nav-label">Lịch dạy
                        học</span>
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
