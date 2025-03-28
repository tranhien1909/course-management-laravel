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
                        <a href="{{ route('dashboard.index') }}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('teacher.index') }}">QL Giảng viên</a>
                    </li>
                    <li class="active">
                        <strong>Nguyễn Văn A</strong>
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
                            <img src="data:image/jpeg;base64,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"
                                alt="Ảnh Giáo Viên" class="img-responsive">
                        </div>
                        <button class="btn btn-default btn-block">Mã Giáo Viên</button>
                    </div>

                    <!-- Cột thông tin giáo viên -->
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Tên Giáo Viên:</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Ngày sinh:</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Giới tính:</label>
                                <select class="form-control">
                                    <option>Nam</option>
                                    <option>Nữ</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Email:</label>
                                <input type="email" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Số điện thoại:</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Địa chỉ:</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Học vấn:</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Trình độ:</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Mô tả:</label>
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Ghi chú:</label>
                                <textarea class="form-control"></textarea>
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
