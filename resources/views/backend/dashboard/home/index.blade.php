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
                        <img src="backend/img/online-course.png" alt="">
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
                        <img src="backend/img/school.png" alt="">
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
                        <img src="backend/img/teacher.png" alt="">
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
                        <img src="backend/img/graduated.png" alt="">
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Messages</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content ibox-heading">
                    <h3><i class="fa fa-envelope-o"></i> New messages</h3>
                    <small><i class="fa fa-tim"></i> You have 22 new messages and 16 waiting in draft
                        folder.</small>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list">

                        <div class="feed-element">
                            <div>
                                <small class="pull-right text-navy">1m ago</small>
                                <strong>Monica Smith</strong>
                                <div>Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry. Lorem Ipsum</div>
                                <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div>
                                <small class="pull-right">2m ago</small>
                                <strong>Jogn Angel</strong>
                                <div>There are many variations of passages of Lorem Ipsum available
                                </div>
                                <small class="text-muted">Today 2:23 pm - 11.06.2014</small>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div>
                                <small class="pull-right">5m ago</small>
                                <strong>Jesica Ocean</strong>
                                <div>Contrary to popular belief, Lorem Ipsum</div>
                                <small class="text-muted">Today 1:00 pm - 08.06.2014</small>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div>
                                <small class="pull-right">5m ago</small>
                                <strong>Monica Jackson</strong>
                                <div>The generated Lorem Ipsum is therefore </div>
                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                            </div>
                        </div>


                        <div class="feed-element">
                            <div>
                                <small class="pull-right">5m ago</small>
                                <strong>Anna Legend</strong>
                                <div>All the Lorem Ipsum generators on the Internet tend to repeat
                                </div>
                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                            </div>
                        </div>
                        <div class="feed-element">
                            <div>
                                <small class="pull-right">5m ago</small>
                                <strong>Damian Nowak</strong>
                                <div>The standard chunk of Lorem Ipsum used </div>
                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                            </div>
                        </div>
                        <div class="feed-element">
                            <div>
                                <small class="pull-right">5m ago</small>
                                <strong>Gary Smith</strong>
                                <div>200 Latin words, combined with a handful</div>
                                <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
