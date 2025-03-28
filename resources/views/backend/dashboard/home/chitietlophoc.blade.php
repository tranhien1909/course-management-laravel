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
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .tenlop {
        display: flex;
        justify-content: center;
        /* Căn giữa theo chiều ngang */
        align-items: center;
        /* Căn giữa theo chiều dọc */
        height: 30px;
        /* Điều chỉnh chiều cao nếu cần */
        margin-bottom: 20px;
    }

    .table-container {
        width: 100%;
        background: white;
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
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

    td a {
        text-decoration: none;
        line-height: 1.5;
        color: black;
    }

    .add-btn {
        background: white;
        color: #3b6db3;
        font-size: 15px;
        padding: 6px 10px;
        border-radius: 3px;
        cursor: pointer;
        margin-bottom: -5px;
        border: 1px solid silver;
    }

    .anhhv img {
        width: 70px;
        /* Định kích thước ảnh */
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stu-list {
        max-height: 300px;
        /* hoặc chiều cao bạn muốn */
        overflow-y: auto;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 10px;
    }

    .addhv {
        background: white;
        color: #3b6db3;
        font-size: 15px;
        padding: 6px 10px;
        border-radius: 3px;
        cursor: pointer;
        margin-bottom: 20px;
        border: 1px solid silver;
    }

    .stu-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        width: 265px;
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

    button {
        padding: 5px 12px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
    }

    button:hover {
        opacity: 0.8;
    }

    /* Nút "Duyệt" - Màu xanh lá */
    button.approve-btn {
        background-color: #28a745;
        color: white;
    }

    /* Nút "Không duyệt" - Màu đỏ */
    button.reject-btn {
        background-color: #dc3545;
        color: white;
        margin-left: 7px;
    }

    .thongtinchung {
        display: flex;
        margin: auto;
        gap: 20px;
        width: 95%;
    }

    .left,
    .right {
        flex: 1;
    }

    .right {
        padding-left: 10px;
    }

    .left {
        border-right: 1px solid silver;
        padding-right: 30px;
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

    .tenlop {
        display: flex;
        justify-content: center;
        /* Căn giữa theo chiều ngang */
        align-items: center;
        /* Căn giữa theo chiều dọc */
        height: 30px;
        /* Điều chỉnh chiều cao nếu cần */
        margin-bottom: 20px;
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

    .edit-button {
        background-color: #008CBA;
        color: white;
    }

    .edit-form {
        position: fixed;
        top: 250px;
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

    .actions {
        text-align: right;
        /* Căn chỉnh các nút sang phải */
        margin-bottom: 15px;
        margin-top: -8px
            /* Thêm một chút khoảng cách từ bảng */
    }

    /* Nút Sửa và Xóa */
    .actions button {
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

    .actions button:hover {
        background-color: #0056b3;
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
                        <a href="{{ route('teacher.index') }}">QL Lớp học</a>
                    </li>
                    <li class="active">
                        <strong>IIG001</strong>
                    </li>

                </ol>
            </div>
        </div>

        <div class="ibox float-e-margins" style="background: white">
            <div class="tabs">
                <div class="tab-item active" data-tab="tab1">Thông Tin Chung</div>
                <div class="tab-item" data-tab="tab2">Lịch Học</div>
                <div class="tab-item" data-tab="tab3">Danh Sách Học Viên</div>
                <div class="tab-item" data-tab="tab4">Tài Liệu Học Tập</div>
            </div>

            <div class="tab-content-container">
                <div id="tab1" class="tab-content active">
                    <div class="thongtinchung">
                        <div class="left">
                            <input type="text" id="class-id" placeholder="Mã Lớp Học">
                            <input type="text" id="class-name" placeholder="Tên Lớp Học">
                            <textarea id="course-name" rows="2" placeholder="Tên Khóa Học"></textarea>
                            <textarea id="description" rows="4" placeholder="Mô Tả"></textarea>
                        </div>
                        <div class="right">
                            <div class="form-row">
                                <input type="number" id="students" placeholder="Số Học Viên">
                                <input type="date" id="start-date">
                            </div>
                            <input type="text" id="teacher" placeholder="Giáo Viên Phụ Trách">
                            <input type="text" id="time" placeholder="Thời Gian Học">
                            <input type="text" id="status" placeholder="Trạng thái">
                            <textarea id="note" rows="2" placeholder="Ghi chú"></textarea>
                        </div>
                    </div>
                    <div class="button-container">
                        <button class="save-button">Lưu</button>
                    </div>
                </div>
                <div id="tab2" class="tab-content">
                    <button class="add-btn" onclick="toggleForm()">+ Thêm lịch học</button>
                    <div class="table-container">
                        <div class="actions">
                            <button id="edit-btn" style="display: none;">Sửa</button>
                            <button id="delete-btn" style="display: none;">Xóa</button>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 30px;"></th>
                                    <th style="width: 50px;">STT</th>
                                    <th style="width: 90px;">Buổi học</th>
                                    <th style="width: 250px;">Nội dung</th>
                                    <th style="width: 100px;">Ngày</th>
                                    <th style="width: 110px;">Thời gian học</th>
                                    <th style="width: 230px;">Phòng học</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="course-row">
                                    <td><input type="checkbox" class="row-checkbox"></td>
                                    <td>1</td>
                                    <td>Buổi 1</td>
                                    <td>Giới thiệu khóa học và phương pháp học tập</td>
                                    <td>21/11/2023</td>
                                    <td>18:00 - 20:00</td>
                                    <td><a href="https://meet.google.com/xyz-abc-def"
                                            target="_blank">https://meet.google.com/xyz-abc-def</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tab3" class="tab-content">
                    <div class="filter-bar">
                        <button>Export</button>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>STT</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Họ tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if (isset($users) && is_object($users))
                                    @foreach ($users as $index => $user)
                                        <tr class="course-row">
                                            <td><input type='checkbox' class='row-checkbox'></td>
                                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                                            <td><img src="{{ $user->avatar }}" class="rounded-circle"
                                                    style="width: 100px; height: 100px; object-fit: cover;"
                                                    alt='Ảnh avatar'></td>
                                            <td>{{ $user->fullname }}</td>
                                            <td>{{ date('d/m/Y', strtotime($user->birthday)) }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">Không có khóa học nào.</td>
                                    </tr>
                                @endif --}}
                            </tbody>
                        </table>
                        {{-- {{ $users->links('pagination::bootstrap-4') }} --}}
                    </div>
                </div>
                <div id="tab4" class="tab-content">
                    <div class="ibox-content">
                        <div class="actions">
                            <button id="approve-btn" onclick="approve(1)" style="display: none;">Duyệt</button>
                            <button id="dele-btn" onclick="reject(1)" style="display: none;">Xóa</button>
                        </div>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 30px;"><input type="checkbox" id="allCheckbox"></th>
                                        <th style="width: 50px;">STT</th>
                                        <th style="width: 110px;">Mã tài liệu</th>
                                        <th style="width: 200px;">File/Link tài liệu</th>
                                        <th style="width: 200px;">Lớp học</th>
                                        <th style="width: 200px;">Giáo viên phụ trách</th>
                                        <th style="width: 120px;">Ngày tải lên</th>
                                        <th style="width: 120px;">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="course-row">
                                        <td><input type="checkbox" class="checkbox"></td>
                                        <td>1</td>
                                        <td>TL001</td>
                                        <td><a href="https://example.com/tailieu1.pdf" target="_blank">Introduction to
                                                Machine Learning</a></td>
                                        <td>Toán 12 - Lớp A1</td>
                                        <td>Thầy Nguyễn Văn A</td>
                                        <td>10/03/2024</td>
                                        <td id="status-1">Chờ duyệt</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="edit-form" class="edit-form">
            <span class="close">&times;</span>
            <p>CHỈNH SỬA LỊCH HỌC</p>
            <input type="hidden" id="edit-row-index">
            <input type="text" id="edit-buoi-hoc" placeholder="Buổi học">
            <input type="text" id="edit-noi-dung" placeholder="Nội dung">
            <input type="date" id="edit-ngay-day" placeholder="Ngày dạy">
            <input type="text" id="edit-thoi-gian" placeholder="Thời gian (hh:mm - hh:mm)">
            <textarea id="edit-phong-hoc" placeholder="Phòng học"></textarea>
            <button onclick="">Lưu</button>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabItems = document.querySelectorAll(".tab-item");
        const tabContents = document.querySelectorAll(".tab-content");
        const editForm = document.getElementById("edit-form");
        const closeButton = document.querySelector(".close");
        const editBtn = document.getElementById("edit-btn");
        const deleteBtn = document.getElementById("delete-btn");

        // Chuyển đổi giữa các tab
        tabItems.forEach(tab => {
            tab.addEventListener("click", function() {
                document.querySelector(".tab-item.active").classList.remove("active");
                document.querySelector(".tab-content.active").classList.remove("active");
                tab.classList.add("active");
                document.getElementById(tab.dataset.tab).classList.add("active");
            });
        });

        // Mở form chỉnh sửa khi nhấn nút "Sửa"
        editBtn.addEventListener("click", () => {
            if (document.querySelector(".row-checkbox:checked")) {
                editForm.classList.add("active");
                loadEditData();
            }
        });

        // Đóng form khi nhấn dấu "×"
        closeButton.addEventListener("click", () => editForm.classList.remove("active"));

        // Lưu chỉnh sửa
        document.querySelector("#edit-form button").addEventListener("click", () => {
            alert("Lưu thông tin thành công!");
            editForm.classList.remove("active");
        });

        // Cập nhật các nút "Sửa" và "Xóa" khi chọn checkbox
        function updateButtons() {
            let selectedRows = document.querySelectorAll(".row-checkbox:checked");
            editBtn.style.display = selectedRows.length === 1 ? "inline-block" : "none";
            deleteBtn.style.display = selectedRows.length > 0 ? "inline-block" : "none";

            if (selectedRows.length === 1) loadEditData();
        }

        // Lấy dữ liệu từ hàng được chọn
        function loadEditData() {
            let row = document.querySelector(".row-checkbox:checked")?.closest("tr");
            if (row) {
                document.getElementById("edit-buoi-hoc").value = row.cells[2].textContent.trim();
                document.getElementById("edit-noi-dung").value = row.cells[3].textContent.trim();
                let ngayDay = row.cells[4].textContent.trim().split("/"); // Tách ngày theo dấu "/"
                document.getElementById("edit-ngay-day").value =
                    `${ngayDay[2]}-${ngayDay[1]}-${ngayDay[0]}`; // Định dạng lại thành yyyy-mm-dd

                document.getElementById("edit-thoi-gian").value = row.cells[5].textContent.trim();
                document.getElementById("edit-phong-hoc").value = row.cells[6].textContent.trim();
            }
        }

        // Gọi updateButtons() khi checkbox thay đổi
        document.querySelectorAll(".row-checkbox").forEach(checkbox => checkbox.addEventListener("change",
            updateButtons));
    });

    function approve(id) {
        document.getElementById('status-' + id).innerText = "Đã duyệt";
    }

    function reject(id) {
        document.getElementById('status-' + id).innerText = "Không duyệt";
    }
    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll(".checkbox");
        const approveBtn = document.getElementById("approve-btn");
        const deleteBtn = document.getElementById("dele-btn");

        function updateButtons() {
            let selectedCount = document.querySelectorAll(".checkbox:checked").length;

            if (selectedCount > 0) {
                approveBtn.style.display = "inline-block";
                deleteBtn.style.display = "inline-block";
            } else {
                approveBtn.style.display = "none";
                deleteBtn.style.display = "none";
            }
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function() {
                updateButtons();
                allCheckbox.checked = checkboxes.length === document.querySelectorAll(
                    ".checkbox:checked").length;
            });
        });
        allCheckbox.addEventListener("change", function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = allCheckbox.checked;
            });
            updateButtons();
        });
    });
</script>
