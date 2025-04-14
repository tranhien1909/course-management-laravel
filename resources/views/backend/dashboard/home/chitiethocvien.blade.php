@include('backend.dashboard.home.style-table')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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


    .class-card {
        background: #cedbec;
        /* Màu xanh nhạt */
        padding: 15px 20px;
        border-radius: 10px;
        margin: 20px;
        position: relative;
        margin-bottom: 30px;
    }

    .class-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .class-title {
        font-size: 17px;
        font-weight: bold;
        color: #333;
    }

    .class-status {
        background: #28a745;
        /* Màu xanh nút */
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 13px;
    }

    .class-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 8px 20px;
    }

    .info-item {
        font-size: 15px;
        color: #333;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .info-item i {
        color: black;
        /* Icon màu xanh */
    }

    b {
        font-weight: bold;
    }

    .chuyencan {
        display: flex;
        justify-content: space-between;
        /* Căn hai phần tử sang hai bên */
        align-items: flex-start;
        /* Căn từ trên xuống */
        gap: 15px;
        padding: 10px;
        padding-top: 40px;
        margin-left: -20px;
    }

    .trai {
        flex: 1;
        /* Chiếm phần lớn không gian */
        display: flex;
        flex-direction: column;
    }

    .trai table {
        width: 92%;
        border-collapse: collapse;
    }

    .trai th,
    td {
        border: 1px solid #ddd;
        padding: 10px 8px;
        text-align: center;
    }

    .trai th {
        background-color: #3b6db3;
        color: white;
        font-weight: bold;
    }

    .trai td {
        max-height: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Bên trái: Thống kê */
    .stat-box {
        width: 280px;
    }

    .stat-item {
        background: #fff;
        border: 1px solid #ccc;
        padding: 16px;
        margin-bottom: 20px;
        font-family: Arial, sans-serif;
        font-size: 15px;
    }

    .stat-item .total {
        color: green;
        font-weight: bold;
        float: right;
    }

    .stat-item .small-text {
        font-size: 13.5px;
        color: gray;
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .actions {
        text-align: left;
        /* Căn chỉnh các nút sang phải */
        margin-right: 20px;
        margin-bottom: -10px;
    }

    /* Nút Sửa và Xóa */
    button {
        padding: 6px 15px;
        margin-left: 10px;
        /* Khoảng cách giữa các nút */
        background-color: #3b6db3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    button:hover {
        background-color: #0056b3;
    }

    .ketqua {
        display: flex;
        justify-content: flex-start;
        padding-left: 40px;
    }

    .stats-box {
        border: 2px solid #ddd;
        border-radius: 10px;
        padding: 12px;
        width: 280px;
        background: #fff;
        border: 1px solid black;
        height: 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin-top: 10px;
    }

    .stats-box p {
        margin: 10px 0;
        font-size: 16px;
    }

    .stats-box span {
        font-weight: bold;
    }

    .green {
        color: green;
    }

    .chart-container {
        width: 750px;
        height: 340px;
    }

    table {
        width: 95%;
        border-collapse: collapse;
        margin-top: 30px;
        margin-left: 40px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px 8px;
        text-align: center;
    }

    th {
        background-color: #3b6db3;
        color: white;
        font-weight: bold;
    }

    td {
        max-height: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Nút Sửa và Xóa */
    .action button {
        padding: 6px 15px;
        margin-left: 10px;
        /* Khoảng cách giữa các nút */
        background-color: #3b6db3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .action button:hover {
        background-color: #0056b3;
    }

    .edit-form {
        position: fixed;
        top: 400px;
        left: 56%;
        transform: translateX(-50%);
        width: 450px;
        background: white;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
        text-align: center;
        opacity: 0;
        visibility: hidden;
        transition: 0.4s;
        z-index: 1003;
        display: none;
    }

    .edit-form.active {
        opacity: 1;
        visibility: visible;
    }

    .edit-form p {
        font-weight: bold;
        margin: 15px 0;
        font-size: 17px;
    }

    .edit-form input,
    .edit-form textarea {
        width: 90%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 15px;
    }

    .edit-form button {
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        background: #3b6db3;
        color: white;
        cursor: pointer;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 20px;
        cursor: pointer;
        font-weight: bold;
        color: #555;
    }

    .mb-10 {
        margin-bottom: 10px;
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
                        <a href="{{ route('student.index') }}">QL Học viên</a>
                    </li>
                    <li class="active">
                        <strong>{{ $user->fullname }}</strong>
                    </li>

                </ol>
            </div>
        </div>

        <div class="ibox-content">
            <div class="ibox float-e-margins" style="background: white; overflow-x: auto;">
                <div class="tabs">
                    <div class="tab-item active" data-tab="tab1">Thông Tin Cá Nhân</div>
                    <div class="tab-item" data-tab="tab2">Chuyên Cần</div>
                    <div class="tab-item" data-tab="tab3">Kết Quả Học Tập</div>
                    <div class="tab-item" data-tab="tab4">Hóa Đơn</div>
                </div>

                <div class="tab-content-container">
                    <div id="tab1" class="tab-content active">
                        <!-- Cột ảnh học viên -->
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="{{ $user->avatar }}" alt="Ảnh Học Viên" class="img-responsive"
                                    style="width: 200px;">
                            </div>
                            <button class="btn btn-default btn-block mb-10">{{ $user->student_id }}</button>
                        </div>

                        <!-- Cột thông tin học viên -->
                        <div class="col-md-9">
                            <div class="row mb-10">
                                <div class="col-md-6">
                                    <label for="student_name">Họ và tên:</label>
                                    <input type="text" id="student_name" class="form-control" placeholder="Họ và tên"
                                        value="{{ $user->fullname }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" class="form-control" placeholder="Email"
                                        value="{{ $user->email }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-10">
                                <div class="col-md-6">
                                    <label for="birthday">Ngày sinh:</label>
                                    <input type="date" id="birthday" class="form-control" placeholder="Ngày sinh"
                                        value="{{ date('Y-m-d', strtotime($user->birthday)) }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">Số điện thoại:</label>
                                    <input type="number" id="phone" class="form-control" placeholder="Phone"
                                        value="{{ $user->phone }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-10">
                                <div class="col-md-6">
                                    <label for="gender">Giới tính:</label>
                                    <input type="text" id="gender" class="form-control" placeholder="Giới tính"
                                        value="{{ $user->gender }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="address">Địa chỉ:</label>
                                    <input type="text" id="address" class="form-control" placeholder="Address"
                                        value="{{ $user->address }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-10">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-success">Lưu</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div id="tab2" class="tab-content">
                        <div class="ibox float-e-margins">
                            <div class="class-card">
                                <div class="class-header">
                                    <span class="class-title">Lớp Sapling 1</span>
                                    <span class="class-status">Đang học</span>
                                </div>
                                <div class="class-info">
                                    <div class="info-item">
                                        <i class="fa-solid fa-line-chart"></i> Tiến độ lớp học: <b>27/37</b>
                                    </div>
                                    <div class="info-item">
                                        <i class="fa-solid fa-calendar-plus-o"></i> Ngày khai giảng: <b>110/08/2023</b>
                                    </div>
                                    <div class="info-item">
                                        <i class="fa-solid fa-calendar-check-o"></i> Ngày kết thúc: <b>02/01/2024</b>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="chuyencan">
                            <div class="col-md-9" style="overflow-x: auto; width: 100%;">
                                <div class="actions">
                                    <button id="edit-btn" style="display: none;">Sửa</button>
                                    <button id="delete-btn" style="display: none;">Xóa</button>
                                </div>

                                <div class="table-responsive">
                                    <table style="min-width: 98%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px;"></th>
                                                <th style="width: 50px;">STT</th>
                                                <th style="width: 170px;">Buổi học</th>
                                                <th style="width: 150px;">Giờ học</th>
                                                <th style="width: 150px;">Điểm danh</th>
                                                <th style="width: 250px;">Ghi chú</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="course-row">
                                                <td><input type="checkbox" class="row-checkbox"
                                                        onclick="updateButton()">
                                                </td>
                                                <td>1</td>
                                                <td>
                                                    <div style="margin-bottom: 10px;">Buổi 1</div>
                                                    <div>15/08/2023</div> <!-- Ngày học -->
                                                </td>
                                                <td>8:00 - 10:00</td>
                                                <td>Đi muộn</td>
                                                <td>Chuẩn bị bài tập chương 1</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="row">
                                    <div class="stat-item">
                                        Số buổi nghỉ: <span class="total">2</span>
                                        <div class="small-text">
                                            <span>Tháng này: 0</span>
                                            <span>Tháng trước: 1</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="stat-item">
                                        Số buổi muộn: <span class="total">2</span>
                                        <div class="small-text">
                                            <span>Tháng này: 0</span>
                                            <span>Tháng trước: 1</span>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>


                    </div>
                    <div id="tab3" class="tab-content" style="padding-bottom: 50px;">
                        <div class="ketqua">
                            <div class="chart-container">
                                <canvas id="myChart"></canvas>
                            </div>
                            <div class="stats-box">
                                <p>Số bài kiểm tra hoàn thành: <span class="green">0/12</span></p>
                                <p>Điểm kiểm tra trung bình: <span class="green">63/100</span></p>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="action-buttons">
                                <button class="btn-edit" id="editbtn" style="display: none;">Sửa</button>
                                <button class="btn-delete" id="deletebtn" style="display: none;">Xóa</button>
                            </div>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>STT</th>
                                            <th>Bài kiểm tra</th>
                                            <th>Ngày làm bài</th>
                                            <th>Trạng thái</th>
                                            <th>Điểm</th>
                                            <th>Ghi chú</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="course-row">
                                            <td><input type="checkbox" class="checkbox" onclick="updateButtons()">
                                            </td>
                                            <td>1</td>
                                            <td>Kiểm tra giữa kỳ</td>
                                            <td>15/08/2023</td>
                                            <td>Hoàn thành</td>
                                            <td>8.5</td>
                                            <td>Cần cải thiện phần tự luận</td>
                                        </tr>

                                        <tr class="course-row">
                                            <td><input type="checkbox" class="checkbox" onclick="updateButtons()">
                                            </td>
                                            <td>1</td>
                                            <td>Kiểm tra giữa kỳ</td>
                                            <td>15/08/2023</td>
                                            <td>Hoàn thành</td>
                                            <td>8.5</td>
                                            <td>Cần cải thiện phần tự luận</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div id="edit-form" class="edit-form">
                                <span class="close">&times;</span>
                                <p>CHỈNH SỬA ĐIỂM</p>
                                <input type="hidden" id="edit-row-index">
                                <input type="text" id="edit-baikt" placeholder="Bài kiểm tra">
                                <input type="date" id="edit-ngay-lb" placeholder="Ngày làm bài">
                                <input type="text" id="edit-diem" placeholder="Điểm">
                                <textarea id="edit-ghi-chu" placeholder="Ghi chú"></textarea>
                                <button onclick="">Lưu</button>
                            </div>
                        </div>


                    </div>
                    <div id="tab4" class="tab-content">
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ngày tạo</th>
                                            <th>Mã học viên</th>
                                            <th>Mã khóa học</th>
                                            <th>Học phí</th>
                                            <th>Phương thức thanh toán</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $index => $payment)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y H:i') }}
                                                </td>
                                                <td>{{ $payment->student_id }}</td>
                                                <td>{{ $payment->course_id }}</td>
                                                <td>{{ number_format($payment->amount, 0, ',', '.') }}</td>
                                                <td>{{ ucfirst($payment->payment_method) }}</td>
                                                <td>{{ ucfirst($payment->status) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
        const editForm = document.getElementById("edit-form");
        const closeButton = document.querySelector(".close");
        const editBtn = document.getElementById("editbtn");
        const deleteBtn = document.getElementById("deletebtn");
        const edit = document.getElementById("edit-btn");
        const deletebtn = document.getElementById("delete-btn");

        tabItems.forEach(tab => {
            tab.addEventListener("click", function() {
                document.querySelector(".tab-item.active").classList.remove("active");
                document.querySelector(".tab-content.active").classList.remove("active");

                this.classList.add("active");
                document.getElementById(this.dataset.tab).classList.add("active");
            });
        });

        editBtn.addEventListener("click", () => {
            if (document.querySelector(".checkbox:checked")) {
                editForm.classList.add("active");
                loadEditData();
            }
        });

        closeButton.addEventListener("click", () => editForm.classList.remove("active"));

        // Lắng nghe sự kiện cho bảng "Bài kiểm tra"
        document.querySelectorAll(".checkbox").forEach(checkbox => {
            checkbox.addEventListener("change", updateButtons);
        });

        // Lắng nghe sự kiện cho bảng "Chuyên cần"
        document.querySelectorAll(".row-checkbox").forEach(checkbox => {
            checkbox.addEventListener("change", updateButton);
        });

        // Hàm cập nhật nút cho bảng "Bài kiểm tra"
        function updateButtons() {
            let selectedRows = document.querySelectorAll(".checkbox:checked");
            editBtn.style.display = selectedRows.length === 1 ? "inline-block" : "none";
            deleteBtn.style.display = selectedRows.length > 0 ? "inline-block" : "none";

            if (selectedRows.length === 1) loadEditData();
        }

        // Hàm cập nhật nút cho bảng "Chuyên cần"
        function updateButton() {
            let selectedRows = document.querySelectorAll(".row-checkbox:checked");
            edit.style.display = selectedRows.length === 1 ? "inline-block" : "none";
            deletebtn.style.display = selectedRows.length > 0 ? "inline-block" : "none";

            if (selectedRows.length === 1) loadEditData();
        }

        // Hàm tải dữ liệu chỉnh sửa
        function loadEditData() {
            let row = document.querySelector(".checkbox:checked")?.closest("tr");
            if (row) {
                let ngayDay = row.cells[3].textContent.trim().split("/"); // Tách ngày theo dấu "/"
                document.getElementById("edit-ngay-lb").value =
                    `${ngayDay[2]}-${ngayDay[1]}-${ngayDay[0]}`; // Định dạng lại thành yyyy-mm-dd
                document.getElementById("edit-baikt").value = row.cells[2].textContent.trim();
                document.getElementById("edit-diem").value = row.cells[4].textContent.trim();
                document.getElementById("edit-ghi-chu").value = row.cells[5].textContent.trim();
            }
        }

        // Đóng form khi nhấn dấu "×"
        closeButton.addEventListener("click", () => editForm.classList.remove("active"));
    });
</script>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: [1, 2, 3, 4, 5],
            datasets: [{
                    label: 'Điểm kiểm tra định kỳ',
                    data: [90, 80, 70, 75, 85],
                    borderColor: 'red',
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',
                    tension: 0.3
                },
                {
                    label: 'Điểm kiểm tra kết khóa',
                    data: [100, 90, 75, 80, 95],
                    borderColor: 'green',
                    backgroundColor: 'rgba(0, 255, 0, 0.2)',
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
</script>
