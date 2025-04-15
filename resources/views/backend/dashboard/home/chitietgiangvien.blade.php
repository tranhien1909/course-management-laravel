@include('backend.dashboard.home.style-table')
<style>
    .tabs {
        display: flex;
        justify-content: space-around;
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
    }

    .tab-item {
        cursor: pointer;
        padding: 7px 12px;
        font-size: 16px;
        color: black;
        transition: 0.3s;
    }

    .tab-item.active {
        color: #3b6db3;
        border-bottom: 2px solid #3b6db3;
        font-weight: bold;
    }

    .tab-content-container {
        padding: 20px;
        overflow: hidden;
        /* Đảm bảo không có tràn nội dung */
        height: 100%;
        /* Hoặc chiều cao cố định nếu cần */
    }

    .tab-content {
        display: none;
        margin-top: 15px;

    }

    .tab-content.active {
        display: block;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 15px;
    }
</style>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="row wrapper border-bottom white-bg page-heading" style="margin-left: -9px; margin-bottom: 20px;">
            <div class="col-lg-10">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('teacher.index') }}">QL Giảng viên</a>
                    </li>
                    <li class="active">
                        <strong>{{ $teacher->user->fullname }}</strong>
                    </li>

                </ol>
            </div>
        </div>

        <div class="ibox float-e-margins" style="background: white">
            <div class="tabs">
                <div class="tab-item active" data-tab="info">Thông Tin Cá Nhân</div>
                <div class="tab-item" data-tab="schedule">Lịch Giảng Dạy</div>
            </div>

            <div class="tab-content-container">
                <!-- Tab Thông Tin Giáo Viên -->
                <div class="tab-content active" id="info">
                    <!-- Cột ảnh giáo viên -->
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="{{ $teacher->user->avatar }}" alt="Ảnh Giáo Viên" class="img-responsive">
                        </div>
                        <button class="btn btn-default btn-block">{{ $teacher->id }}</button>
                    </div>

                    <!-- Cột thông tin giáo viên -->
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="teacher_name">Họ và tên:</label>
                                <input type="text" id="teacher_name" class="form-control" placeholder="Họ và tên"
                                    value="{{ $teacher->user->fullname }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label for="birthday">Ngày sinh:</label>
                                <input type="date" id="birthday" class="form-control" placeholder="Ngày sinh"
                                    value="{{ date('Y-m-d', strtotime($teacher->user->birthday)) }}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label for="gender">Giới tính:</label>
                                <input type="text" id="gender" class="form-control" placeholder="Giới tính"
                                    value="{{ $teacher->user->gender }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="email">Email:</label>
                                <input type="email" id="email" class="form-control" placeholder="Email"
                                    value="{{ $teacher->user->email }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="expertise">Học vấn:</label>
                                <input type="text" id="expertise" class="form-control" placeholder="Học vấn"
                                    value="{{ $teacher->expertise }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="address">Địa chỉ:</label>
                                <input type="text" id="address" class="form-control" placeholder="Address"
                                    value="{{ $teacher->user->address }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="joining_date">Ngày vào làm:</label>
                                <input type="date" id="joining_date" class="form-control" placeholder="Ngày vào làm"
                                    value="{{ date('Y-m-d', strtotime($teacher->joining_date)) }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="phone">Số điện thoại:</label>
                                <input type="number" id="phone" class="form-control" placeholder="Phone"
                                    value="{{ $teacher->user->phone }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="status">Trạng thái:</label>
                                <input type="text" id="status" class="form-control" placeholder="Trạng thái"
                                    value="{{ $teacher->status }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="bio">Mô tả:</label>
                                <textarea id="bio" class="form-control" disabled>{{ $teacher->bio }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-success">Sửa</button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Tab Lịch Giảng Dạy -->
                <div id="schedule" class="tab-content">
                    <input type="date" id="datePicker" value="{{ now()->toDateString() }}">
                    <input type="hidden" id="teacherId" value="{{ $teacher->id }}">
                    {{-- <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ngày dạy</th>
                                <th>Buổi học</th>
                                <th>Giờ học</th>
                                <th>Lớp học</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>10/03/2024</td>
                                <td>Buổi 1</td>
                                <td>8:00 - 10:00</td>
                                <td>Toán 12 - Lớp A1</td>
                                <td>Chuẩn bị bài tập chương 1</td>
                            </tr>
                        </tbody>
                    </table> --}}

                    <div id="scheduleContainer">
                        @include('backend.dashboard.component.weekly_schedule', [
                            'classSchedules' => $classSchedules,
                            'weekStart' => $weekStart,
                        ])
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabItems = document.querySelectorAll(".tab-item");
        const tabContents = document.querySelectorAll(".tab-content");

        tabItems.forEach(tab => {
            tab.addEventListener("click", function() {
                document.querySelector(".tab-item.active").classList.remove("active");
                document.querySelector(".tab-content.active").classList.remove("active");

                this.classList.add("active");
                document.getElementById(this.dataset.tab).classList.add("active");
            });
        });
    });
</script>

<script>
    document.getElementById('datePicker').addEventListener('change', function() {
        const selectedDate = this.value;
        const teacherId = document.getElementById('teacherId').value;

        fetch(`/teacher-schedule/week?date=${selectedDate}&teacher_id=${teacherId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('scheduleContainer').innerHTML = data.html;
            })
            .catch(error => console.error('Error:', error));
    });
</script>
