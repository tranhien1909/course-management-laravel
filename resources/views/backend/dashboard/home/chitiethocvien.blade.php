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
                        <a href="{{ route('student.index') }}">QL Học viên</a>
                    </li>
                    <li class="active">
                        <strong>Nguyễn Văn B</strong>
                    </li>

                </ol>
            </div>
        </div>

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
                            <img src="data:image/jpeg;base64,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"
                                alt="Ảnh Học Viên" class="img-responsive">
                        </div>
                        <button class="btn btn-default btn-block">Mã Học Viên</button>
                    </div>

                    <!-- Cột thông tin giáo viên -->
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Tên Học Viên:</label>
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
                            <div class="col-md-12">
                                <label>Địa chỉ:</label>
                                <input type="text" class="form-control">
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
                                    <i class="fa-solid fa-calendar-plus-o"></i> Ngày khai giảng: <b>15/08/2023</b>
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
                                            <td><input type="checkbox" class="row-checkbox" onclick="updateButton()">
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
                                        <td><input type="checkbox" class="checkbox" onclick="updateButtons()"></td>
                                        <td>1</td>
                                        <td>Kiểm tra giữa kỳ</td>
                                        <td>15/08/2023</td>
                                        <td>Hoàn thành</td>
                                        <td>8.5</td>
                                        <td>Cần cải thiện phần tự luận</td>
                                    </tr>

                                    <tr class="course-row">
                                        <td><input type="checkbox" class="checkbox" onclick="updateButtons()"></td>
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
