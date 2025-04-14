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
                            <span class="status online" style="color: limegreen;">● Student</span>

                        </span> </a>
                </div>
                <div class="logo-element">
                    <img src="{{ asset('backend/img/smart_logo.png') }}" alt="" style="width: 60px;">
                </div>
            </li>
            <li class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                <a href="{{ route('student.dashboard') }}"><i class="fa-solid fa-home"></i> <span
                        class="nav-label">Dashboard</span></a>
            </li>
            <li class="{{ request()->routeIs('student.class') ? 'active' : '' }}">
                <a href="{{ route('student.class') }}"><i class="fa-solid fa-chalkboard"></i> <span
                        class="nav-label">Lớp học
                        của
                        tôi</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('student.diemdanh') ? 'active' : '' }}">
                <a href="{{ route('student.diemdanh') }}"><i class="fa-solid fa-clipboard-user"></i> <span
                        class="nav-label">Điểm
                        danh</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('student.lichhoc') ? 'active' : '' }}">
                <a href="{{ route('student.lichhoc') }}"><i class="fa-solid fa-calendar-days"></i> <span
                        class="nav-label">Lịch học</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('student.kqht') ? 'active' : '' }}">
                <a href="{{ route('student.kqht') }}"><i class="fa-solid fa-print"></i> <span class="nav-label">Kết quả
                        học tập</span>
                </a>
            </li>
            <li>
                <a href="metrics.html"><i class="fa-solid fa-money-check-dollar"></i> <span class="nav-label">Công
                        nợ</span>
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

<script>
    // Lấy tất cả các thẻ <li> trong menu
    const menuItems = document.querySelectorAll('#side-menu li');

    // Lặp qua từng thẻ <li> để thêm sự kiện click
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            // Xóa class 'active' khỏi tất cả các thẻ <li>
            menuItems.forEach(li => li.classList.remove('active'));

            // Thêm class 'active' vào thẻ <li> được click
            this.classList.add('active');
        });
    });
</script>
