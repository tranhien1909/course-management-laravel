@include('backend.dashboard.home.style-table')

<style>
    .ibox-content {
        position: relative;
    }

    /* Căn hai nút Sửa và Xóa về bên phải */
    .action-buttons {
        position: absolute;
        right: 23px;
        top: 20px;
        /* Điều chỉnh khoảng cách với bảng */
        display: flex;
        gap: 15px;
    }

    .table-responsive {
        margin-top: 65px;

    }

    .add-btn {
        position: absolute;
        right: 10px;
        top: 30px;

    }

    .course-img {
        width: 140px;
    }

    /* Style cho nút */
    .btn-edit,
    .btn-delete {
        padding: 6px 12px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        border-radius: 5px;
    }

    .btn-edit:disabled,
    .btn-delete:disabled {
        background-color: #ccc;
        color: #888;
        cursor: not-allowed;
    }

    .btn-edit,
    .btn-delete {
        background: #3b6db3;
        color: white;
        font-size: 14px;
    }

    .form-container {
        margin-top: 50px;
        position: fixed;
        top: 0;
        right: -520px;
        /* Ẩn ban đầu */
        width: 520px;
        height: calc(100% - 50px);
        background: white;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
        padding: 20px;
        transition: right 0.3s ease-in-out;
        z-index: 1001;
    }

    .form-container.active {
        right: 0;
        /* Hiện form */
    }

    .closebtn {
        background: none;
        color: #888;
        /* Màu xám */
        font-size: 17px;
        border: none;
        cursor: pointer;
        position: absolute;
        top: 20px;
        left: 20px;
        /* Cách khoảng 10px */
    }

    form {
        margin-left: 12px;
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 12px;
        align-items: center;
        margin-top: 15px;
    }

    .form-container h2 {
        margin-left: 25px;
    }

    label {
        width: 120px;
    }

    input,
    textarea,
    select {
        width: 93%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-footer {
        grid-column: span 2;
        display: flex;
        justify-content: flex-end;
    }

    .save-btn {
        background: #3b6db3;
        color: white;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        border: none;
        margin-right: 30px;
    }

    .delete-btn {
        background: none;
        border: none;
        color: black;
        font-size: 18px;
        cursor: pointer;
        margin-left: auto;
    }

    #addForm {
        max-height: 100vh;
        /* Giới hạn chiều cao modal */
        overflow-y: auto;
        /* Tạo thanh cuộn khi nội dung quá dài */
    }
</style>
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
                            <strong>QL Học viên</strong>
                        </li>
                        <h3 style="font-size: 18px; margin-top: 20px">DANH SÁCH HỌC VIÊN</h3>
                    </ol>
                </div>
                <div class="col-lg-2">
                    <button class="add-btn" onclick="toggleForm()">+ Thêm</button>
                </div>
            </div>
            <div class="filter-bar">
                <button>Export</button>

                <div class="search-container">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" placeholder="Nhập tên khóa học cần tìm ...">
                </div>
            </div>

            <div class="ibox-content">
                <div class="action-buttons">
                    <button class="btn-edit">Xem chi tiết</button>
                    <button class="btn-delete">Xóa</button>
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
                            @if (isset($users) && is_object($users))
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
                            @endif
                        </tbody>
                    </table>
                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        <div class="form-container" id="addForm">
            <button class="closebtn" onclick="toggleForm()">X</button>
            <h2 style="font-size: 17px;">THÊM KHÓA HỌC</h2>
            <form>
                <label>Mã khóa học</label>
                <input type="text" name="ma_khoa_hoc" required>

                <label>Tên khóa học</label>
                <input type="text" name="ten_khoa_hoc" required>

                <label>Mức độ</label>
                <select name="muc_do" required>
                    <option value="coban">Cơ bản</option>
                    <option value="trungcap">Trung cấp</option>
                    <option value="nangcao">Nâng cao</option>
                </select>

                <label>Số buổi học</label>
                <input type="number" name="so_buoi_hoc" required>

                <label>Ngày khai giảng</label>
                <input type="date" name="thoi_gian_bat_dau" required>

                <label>Thời gian học</label>
                <input type="text" name="thoi_gian_hoc" required>

                <label>Mô tả</label>
                <textarea name="mo_ta"></textarea>

                <label>Đối tượng</label>
                <textarea name="doituong"></textarea>

                <label>Ảnh khóa học</label>
                <input type="file" name="hinh_anh[]" multiple>

                <label>Học phí</label>
                <input type="text" name="hoc_phi" required>

                <label>Trạng thái học</label>
                <select name="trang_thai_hoc" required>
                    <option value="coban">Cơ bản</option>
                    <option value="trungcap">Trung cấp</option>
                    <option value="nangcao">Nâng cao</option>
                </select>

                <div class="form-footer">
                    <button type="submit" class="save-btn">Lưu</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function toggleForm() {
        var form = document.getElementById("addForm");
        var overlay = document.getElementById("overlay");
        var mainContent = document.getElementById("mainContent");

        if (form.classList.contains("active")) {
            form.classList.remove("active");
            overlay.classList.remove("active");
        } else {
            form.classList.add("active");
            overlay.classList.add("active");
            mainContent.style.filter = "blur(5px)";
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll(".row-checkbox");
        const btnEdit = document.querySelector(".btn-edit");
        const btnDelete = document.querySelector(".btn-delete");
        const selectAll = document.getElementById("select-all");

        function updateButtons() {
            let checkedCheckboxes = document.querySelectorAll(".row-checkbox:checked");
            let checkedCount = checkedCheckboxes.length;

            // Vô hiệu hóa hoặc kích hoạt nút
            btnEdit.disabled = checkedCount !== 1;
            btnDelete.disabled = checkedCount === 0;

            // Cập nhật màu sắc của hàng
            checkboxes.forEach(checkbox => {
                let row = checkbox.closest("tr");
                if (checkbox.checked) {
                    row.classList.add("selected");
                } else {
                    row.classList.remove("selected");
                }
            });
        }

        // Đảm bảo tất cả checkbox đều bỏ chọn khi load trang
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        // Gán sự kiện change cho từng checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", updateButtons);
        });

        // Xử lý khi nhấn vào "Chọn tất cả"
        if (selectAll) {
            selectAll.checked = false; // Đảm bảo checkbox "Chọn tất cả" không được chọn khi tải trang
            selectAll.addEventListener("change", function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateButtons();
            });
        }

        // Gọi updateButtons() để vô hiệu hóa nút ngay khi trang tải xong
        updateButtons();
    });
</script>
