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
    }

    .tab-content.active {
        display: block;
    }

    .thongtinchung {
        display: flex;
        margin: auto;
        gap: 20px;
        width: 100%;
    }

    .left,
    .right {
        flex: 1;
    }

    .left {
        border-right: 1px solid silver;
        padding-right: 20px;
    }

    .form-row {
        display: flex;
        gap: 10px;
    }

    .form-row input {
        flex: 1;
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

    .image-container {
        display: flex;
        gap: 30px;
        margin-top: 12px;
        margin-left: 20px;
        margin-bottom: 12px;
    }

    .image-box {
        width: 140px;
        height: 140px;
        border: 1px solid silver;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-actions {
        position: absolute;
        top: 5px;
        left: 5px;
        display: flex;
        gap: 5px;
    }

    .image-input {
        display: none !important;
    }

    .image-actions .edit-icon,
    .image-actions .delete-icon {
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 2px 5px;
        font-size: 12px;
        border-radius: 3px;
        cursor: pointer;
    }

    .button-container {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 35px;
        margin-right: 10px;
        margin-bottom: -20px;
    }

    .button-container button {
        padding: 8px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .save-button {
        background-color: #3b6db3;
        color: white;
        margin-bottom: 30px;
    }

    .stu-list {
        max-height: 300px;
        /* hoặc chiều cao bạn muốn */
        overflow-y: auto;
        display: flex;
        flex-wrap: wrap;
        gap: 50px;
        margin-bottom: 10px;
        margin-left: 40px;
    }

    .stu-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        width: 310px;
        position: relative;
        border: 1px solid silver;
        height: 83px;
    }

    .anh {
        background: #eee;
        border-radius: 5px;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
    }

    .stu-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-left: 5px;
        flex-grow: 1;
    }

    .stu-info h3 {
        font-size: 14.5px;
    }

    .stu-info p {
        font-size: 13px;
        color: #555;
    }

    .feedback-container {
        display: flex;
        gap: 40px;
        /* Khoảng cách giữa các feedback */
        flex-wrap: wrap;
        margin-left: 30px;
    }

    .feedback-card {
        display: flex;
        flex-direction: column;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        width: 46%;
        /* Chia đôi hàng */
        box-sizing: border-box;
        /* Tính cả padding vào width */
        background-color: white;
    }

    .feedback-header {
        display: flex;
        gap: 15px;
        margin-bottom: 12px;
    }

    .avatar {
        width: 50px;
        height: 50px;
        background-color: #00bcd4;
        color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        position: relative;
        top: -10px;
    }

    .feedback-info h3 {
        margin: 0;
        font-size: 16px;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .rating span {
        color: #ff9800;
        font-size: 15px;
        margin-right: 10px;
    }

    .feedback-display {
        width: 100%;
        min-height: 80px;
        resize: none;
        white-space: pre-wrap;
        /* Để xuống dòng giống textarea */
        overflow-y: auto;
    }
</style>

<style>
    .tab-content {
        margin-top: 15px;
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
                                <button class="btn btn-success">Lưu</button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Tab Lịch Giảng Dạy -->
                <div id="schedule" class="tab-content">
                    <h3>Lịch Giảng Dạy</h3>
                    <table class="table table-bordered">
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
                    </table>
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
