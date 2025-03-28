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
        <!-- Left Column: User Profile -->
        <div class="col-lg-6">
            <div class="" style="height: 57px;">
            </div>

            <div class="ibox-content card">
                <div class="profile-image">
                    <img src="https://people.com/thmb/CmsxPiMfak-G7Y5GI1rqgnBrPhc=/4000x0/filters:no_upscale():max_bytes(150000):strip_icc():focal(511x0:513x2):format(webp)/charlotte-triggs-headshot-7ef4504afc244ec99096e5fc0c1a3b63.jpg"
                        class="img-circle circle-border m-b-md" alt="profile">
                </div>

                <div class="sidebar-sticky">
                    <h2 class="mt-3"><strong>Hello, Trần Văn A </strong> <img
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
                        <p>Họ tên: Trần Văn A</p>
                        <p>Ngày sinh: 01/01/2000</p>
                        <p>Email: test@gmail.com</p>
                        <p>Phone: 0395751903</p>
                        <p>Giới thiệu: 900 Toeic, 8.0 Ielts</p>
                        <p>Bằng cấp: Th.S Ngành Ngôn Ngữ Học NeU</p>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-lg-6">
            <h2 class="card-header">
                My Class
            </h2>
            <a href="#">
                <div class="ibox-content card my-class">
                    <div class="col-12">
                        <h3 class="card-header">
                            Toeic Mất Gốc
                        </h3>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="img-circle">
                                    <img src="https://people.com/thmb/CmsxPiMfak-G7Y5GI1rqgnBrPhc=/4000x0/filters:no_upscale():max_bytes(150000):strip_icc():focal(511x0:513x2):format(webp)/charlotte-triggs-headshot-7ef4504afc244ec99096e5fc0c1a3b63.jpg"
                                        class="img-circle circle-border mb-3" alt="profile">
                                </div>
                                <div class="class-text">
                                    <div class="d-flex">
                                        <i class="fas fa-book"></i>
                                        <p class="mb-0">20 lessons</p>
                                    </div>
                                    <div class="d-flex">
                                        <i class="fas fa-graduation-cap"></i>
                                        <p class="mb-0">45 students</p>
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

            <a href="#">
                <div class="ibox-content card my-class">
                    <div class="col-12">
                        <h3 class="card-header">
                            Toeic A1
                        </h3>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="img-circle">
                                    <img src="https://people.com/thmb/CmsxPiMfak-G7Y5GI1rqgnBrPhc=/4000x0/filters:no_upscale():max_bytes(150000):strip_icc():focal(511x0:513x2):format(webp)/charlotte-triggs-headshot-7ef4504afc244ec99096e5fc0c1a3b63.jpg"
                                        class="img-circle circle-border mb-3" alt="profile">
                                </div>
                                <div class="class-text">
                                    <div class="d-flex">
                                        <i class="fas fa-book"></i>
                                        <p class="mb-0">20 lessons</p>
                                    </div>
                                    <div class="d-flex">
                                        <i class="fas fa-graduation-cap"></i>
                                        <p class="mb-0">45 students</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 50%;">50%</div>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#">
                <div class="ibox-content card my-class">
                    <div class="col-12">
                        <h3 class="card-header">
                            Toeic A1
                        </h3>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="img-circle">
                                    <img src="https://people.com/thmb/CmsxPiMfak-G7Y5GI1rqgnBrPhc=/4000x0/filters:no_upscale():max_bytes(150000):strip_icc():focal(511x0:513x2):format(webp)/charlotte-triggs-headshot-7ef4504afc244ec99096e5fc0c1a3b63.jpg"
                                        class="img-circle circle-border mb-3" alt="profile">
                                </div>
                                <div class="class-text">
                                    <div class="d-flex">
                                        <i class="fas fa-book"></i>
                                        <p class="mb-0">20 lessons</p>
                                    </div>
                                    <div class="d-flex">
                                        <i class="fas fa-graduation-cap"></i>
                                        <p class="mb-0">45 students</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 60%;">60%</div>
                        </div>
                    </div>
                </div>
            </a>
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
