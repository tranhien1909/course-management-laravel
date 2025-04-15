<style>
    .info-card {
        padding: 20px;
        margin-bottom: 20px;
        text-align: center;
    }

    .info-card h2 {
        font-size: 36px;
        margin: 0;
        color: white;
        font-weight: bolder;
    }

    .info-card p {
        font-size: 18px;
        color: white;
        margin: 10px 0 0;
        font-weight: bolder;
    }

    .info-card .more-info {
        color: #337ab7;
        font-size: 14px;
        margin-top: 10px;
        display: block;
    }

    .info-card .more-info:hover {
        text-decoration: underline;
    }

    .d-flex {
        display: flex;
        align-items: center;
        border-radius: 0.375rem;
        justify-content: center;
        transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        /* Hiệu ứng mượt mà */
        box-shadow: 0 0 1px rgba(var(--bs-body-color-rgb), 0.125), 0 1px 3px rgba(var(--bs-body-color-rgb), 0.2)
    }

    .d-flex:hover {
        background-color: #FFA000;
        /* Màu nền khi hover */
        transform: scale(1.05);
        /* Phóng to nhẹ */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Đổ bóng */
    }

    .d-flex img {
        width: 80px;
        padding-bottom: 27px;

    }
</style>

<div class="wrapper wrapper-content">
    <div class="row" style="margin-bottom: 20px;">
        <!-- Khoá học -->
        <div class="col-md-3">
            <a href="{{ route('course.index') }}">
                <div class="d-flex" style="background: #5191c9">
                    <div class="info-card">
                        <h2>{{ $thongKe['khoa_hoc'] }}</h2>
                        <p>Khoá học</p>
                    </div>
                    <div class="card-img">
                        <img src="{{ asset('backend/img/online-course.png') }}" alt="">
                    </div>
                </div>
            </a>
        </div>


        <!-- Lớp học -->
        <div class="col-md-3">
            <a href="{{ route('class.index') }}">
                <div class="d-flex" style="background: #ed6556">
                    <div class="info-card">
                        <h2>{{ $thongKe['lop_hoc'] }}</h2>
                        <p>Lớp học</p>
                    </div>
                    <div class="card-img">
                        <img src="{{ asset('backend/img/school.png') }}" alt="">
                    </div>
                </div>
            </a>
        </div>

        <!-- Giảng viên -->
        <div class="col-md-3">
            <a href="{{ route('teacher.index') }}">
                <div class="d-flex" style="background: #d6ea56">
                    <div class="info-card">
                        <h2>{{ $thongKe['giang_vien'] }}</h2>
                        <p>Giảng viên</p>
                    </div>
                    <div class="card-img">
                        <img src="{{ asset('backend/img/teacher.png') }}" alt="">
                    </div>
                </div>
            </a>
        </div>

        <!-- Học viên -->
        <div class="col-md-3">
            <a href="{{ route('student.index') }}">
                <div class="d-flex" style="background: #60eaa7">
                    <div class="info-card">
                        <h2>{{ $thongKe['hoc_vien'] }}</h2>
                        <p>Học viên</p>
                    </div>
                    <div class="card-img">
                        <img src="{{ asset('backend/img/graduated.png') }}" alt="">
                    </div>
                </div>
            </a>
        </div>
    </div>

    @include($pageTask)



</div>
