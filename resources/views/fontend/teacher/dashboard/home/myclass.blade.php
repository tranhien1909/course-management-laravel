@include('backend.dashboard.home.style-table')

<style>
    .card {
        margin-bottom: 20px;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        justify-content: center;
    }

    .my-class {
        transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        /* Hiệu ứng mượt mà */
    }

    .my-class:hover {
        background-color: #e8c17f;
        /* Màu nền khi hover */
        transform: scale(1.005);
        /* Phóng to nhẹ */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Đổ bóng */
    }

    .card-header {
        text-transform: uppercase;
        text-align: center;
        text-size: 30px;
        font-weight: bold;
        color: #0056b3;
    }

    .card-body {
        width: 65%;
        margin-left: 50px;
    }

    .class-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .d-flex {
        display: flex;
        align-items: center;
        justify-content: space-between;

    }

    .d-flex i {
        padding-bottom: 5px;
        font-size: 20px;
        margin-right: 20px;
    }

    .img-circle {
        width: 96px;
        height: 96px;
    }

    .progress {
        height: 20px;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .progress-bar {
        background-color: #007bff;
    }

    .btn-custom {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 5px 15px;
    }

    .btn-custom:hover {
        background-color: #0056b3;
    }

    .ct-perfect-fourth {
        height: 400px;
    }

    .profile-image {
        margin-top: 10px;
    }
</style>

<link href="backend/css/plugins/chartist/chartist.min.css" rel="stylesheet">

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="overlay" id="overlay" onclick="toggleForm()"></div>
        <div class="ibox float-e-margins">
            <div class="row wrapper border-bottom white-bg page-heading"
                style="margin-left: -9px; margin-bottom: 20px; position: relative;">
                <div class="col-lg-10">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('teacher.dashboard') }}">Trang chủ</a>
                        </li>
                        <li class="active">
                            <strong>Lớp học của tôi</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="filter-bar">

                <div class="search-container">
                    <form action="{{ route('course.index') }}" method="GET">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm kiếm theo mã hoặc tên lớp học" value="{{ request('search') }}">
                        <button type="submit" class="search-icon"
                            style="background-color: white; left: 8px; padding: 6px;"><i
                                class="fa-solid fa-magnifying-glass" style="color: #3b6db3;"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row" style="justify-items: center;">

            @forelse ($classes as $class)
                <li class="list-item" style="width: 90%;">
                    <a href="{{ route('myclass.detail', $class->id) }}">
                        <div class="ibox-content card my-class">
                            <div class="col-12">
                                <h3 class="card-header">[{{ $class->course->course_name ?? 'Không rõ' }}]
                                    <strong> Lớp:
                                        {{ $class->id }}</strong>
                                </h3>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="img-circle">
                                            <img src="{{ $class->course->image ?? 'https://people.com/thmb/CmsxPiMfak-G7Y5GI1rqgnBrPhc=/4000x0/filters:no_upscale():max_bytes(150000):strip_icc():focal(511x0:513x2):format(webp)/charlotte-triggs-headshot-7ef4504afc244ec99096e5fc0c1a3b63.jpg' }}"
                                                class="img-circle circle-border mb-3" alt="profile">
                                        </div>
                                        <div class="class-text">
                                            <div class="d-flex">
                                                <i class="fas fa-book"></i>
                                                <p class="mb-0">{{ $class->course->lessons }} bài học</p>
                                            </div>
                                            <div class="d-flex">
                                                <i class="fas fa-graduation-cap"></i>
                                                <p class="mb-0">{{ $class->number_of_student }} học viên</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 79%;">79%</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <li class="list-group-item text-muted">Bạn chưa phụ trách lớp nào.</li>
            @endforelse

        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Chartist -->
    <script src="backend/js/plugins/chartist/chartist.min.js"></script>
    <script>
        $(document).ready(function() {
            new Chartist.Pie('#ct-chart6', {
                series: [20, 10, 30, 40]
            }, {
                donut: true,
                donutWidth: 60,
                startAngle: 270,
                total: 200,
                showLabel: false
            });
        });
    </script>
