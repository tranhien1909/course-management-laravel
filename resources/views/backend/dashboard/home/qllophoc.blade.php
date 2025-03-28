@include('backend.dashboard.home.style-table')

<style>
    table img {
        width: 120px;
    }


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
                            <strong>QL Lớp học</strong>
                        </li>
                        <h3 style="font-size: 18px; margin-top: 20px">DANH SÁCH LỚP HỌC</h3>
                    </ol>
                </div>
                <div class="col-lg-2">
                    <button class="add-btn" onclick="toggleForm()">+ Thêm</button>
                </div>
            </div>

            <div class="filter-bar">
                <button>Export</button>
                <select>
                    <option disabled>Lọc</option>
                    <option>Đang diễn ra</option>
                    <option>Sắp khai giảng</option>
                </select>

                <div class="search-container">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" placeholder="Nhập tên hoặc mã học cần tìm ...">
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
                                <th>Mã lớp học</th>
                                <th>Tên lớp học</th>
                                <th>Ngày khai giảng</th>
                                <th>Ngày kết thúc</th>
                                <th>Giáo viên phụ trách</th>
                                <th>Sĩ số</th>
                                <th>Phòng học</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($classes) && is_object($classes))
                                @foreach ($classes as $index => $class)
                                    <tr class="course-row">
                                        <td><input type='checkbox' class='row-checkbox'></td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $class->id }}</td>
                                        <td>{{ $class->class_name }}</td>
                                        <td>{{ date('d/m/Y', strtotime($class->start_date)) }}</td>
                                        <td>{{ date('d/m/Y', strtotime($class->end_date)) }}</td>
                                        <td></td>
                                        {{-- <td>{{ $class->teacherUser->fullname ?? 'N/A' }}</td> --}}
                                        <td>{{ $class->number_of_student }}</td>
                                        <td><a href="{{ $class->room }}">{{ $class->room }}</a></td>
                                        <td>{{ $class->status }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">Không có khóa học nào.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $classes->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-container" id="addForm">
    <button class="closebtn" onclick="toggleForm()">X</button>
    <h2 style="font-size: 17px;">LỚP HỌC</h2>
    <form>
        <label>Mã lớp học</label>
        <input type="text" name="ma_lop_hoc" required>

        <label>Tên lớp học</label>
        <input type="text" name="ten_lop_hoc" required>

        <label>Mã khóa học</label>
        <select name="ma_khoa_hoc" required>
        </select>

        <label>Số học viên</label>
        <input type="number" name="so_buoi_hoc" required>

        <label>Giảng viên phụ trách</label>
        <select name="ma_giang_vien" required>
        </select>

        <label>Ngày khai giảng</label>
        <input type="date" name="ngay_khai_giang" required>

        <label>Thời gian học</label>
        <input type="text" name="thoi_gian_hoc" required>

        <label>Trạng thái</label>
        <input type="text" name="trang_thai" required>

        <label>Mô tả</label>
        <textarea name="mo_ta"></textarea>

        <label>Ghi chú</label>
        <textarea name="ghi_chu"></textarea>

        <div class="form-footer">
            <button type="submit" class="save-btn">Thêm</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll(".row-checkbox");
        const btnEdit = document.querySelector(".btn-edit");
        const btnDelete = document.querySelector(".btn-delete");
        const selectAll = document.getElementById("select-all");

        function updateButtons() {
            let checkedCheckboxes = document.querySelectorAll(".row-checkbox:checked");
            let checkedCount = checkedCheckboxes.length;

            btnEdit.disabled = checkedCount !== 1;
            btnDelete.disabled = checkedCount === 0;

            checkboxes.forEach(checkbox => {
                let row = checkbox.closest("tr");
                if (checkbox.checked) {
                    row.classList.add("selected");
                } else {
                    row.classList.remove("selected");
                }
            });
        }

        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", updateButtons);
        });

        if (selectAll) {
            selectAll.checked = false; // Đảm bảo checkbox "Chọn tất cả" không được chọn khi tải trang
            selectAll.addEventListener("change", function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateButtons();
            });
        }
        updateButtons();
    });

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
</script>
