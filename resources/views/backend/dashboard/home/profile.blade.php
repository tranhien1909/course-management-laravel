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
        transform: scale(1.05);
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
                            <a href="{{ route('dashboard.index') }}">Trang chủ</a>
                        </li>
                        <li class="active">
                            <strong>Profile</strong>
                        </li>
                    </ol>
                </div>
            </div>

            {{-- User Profile  --}}
            <div class="col-lg-12">

                <div class="ibox-content card">
                    <div class="profile-image">
                        <img src="{{ Auth::check() ? Auth::user()->avatar : 'Khách' }}"
                            class="img-circle circle-border m-b-md" alt="profile">
                    </div>

                    <div class="sidebar-sticky">
                        <h2 class="mt-3"><strong>Hello,
                                {{ Auth::check() ? Auth::user()->fullname : 'Khách' }}</strong> <img
                                src="https://www.svgrepo.com/show/433961/waving-hand.svg"
                                style="width: 35px; padding-bottom: 15px;" alt=""></h2>
                        <p>Nice to have you back, what an exciting day!</p>
                        <p>Get ready and continue your lesson today.</p>
                    </div>
                </div>


                <div class="ibox-content card">
                    <h2 class="card-header">
                        Frofile
                    </h2>
                    <div class="col-12">
                        <div class="card-body">
                            <p>Họ tên: <strong>{{ Auth::check() ? Auth::user()->fullname : 'N/A' }}</strong></p>
                            <p>Ngày sinh: <strong>{{ Auth::check() ? Auth::user()->birthday : 'N/A' }}</strong></p>
                            <p>Email: <strong>{{ Auth::check() ? Auth::user()->email : 'N/A' }}</strong></p>
                            <p>Phone: <strong>{{ Auth::check() ? Auth::user()->phone : 'N/A' }}</strong></p>
                            <p>Địa chỉ: <strong>{{ Auth::check() ? Auth::user()->address : 'N/A' }}</strong></p>
                        </div>
                    </div>
                </div>


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
