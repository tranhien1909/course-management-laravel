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
            </div>

            <div class="filter-bar">
                <a href="{{ route('classExport.pdf') }}"><button>Export</button></a>
                <select>
                    <option disabled>Lọc</option>
                    <option>Đang diễn ra</option>
                    <option>Sắp khai giảng</option>
                </select>

                <div class="search-container">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" placeholder="Nhập tên hoặc mã học cần tìm ...">
                </div>

                <button class="add-btn" onclick="toggleForm()">+ Thêm Lớp học</button>
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
                                <th>Tên khoá học</th>
                                <th>Ngày khai giảng</th>
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
                                        <td>{{ $class->course->course_name ?? 'N/A' }}</td>
                                        <td>{{ date('d/m/Y', strtotime($class->start_date)) }}</td>
                                        <td>{{ $class->teacher->user->fullname ?? 'N/A' }}</td>
                                        <td>{{ $class->number_of_student }}</td>
                                        <td><a href="{{ $class->room }}" target="_blank">{{ $class->room }} </a></td>
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
    <h2 class="text-center">THÊM LỚP HỌC</h2>
    <form>
        <label>Mã lớp học:</label>
        <input type="text" name="id_class" required>

        <label>Tên khóa học:</label>
        <input type="text" name="name_course" required>

        <label>Giảng viên phụ trách:</label>
        <input type="text" name="name_teacher" required>

        <label>Ngày khai giảng</label>
        <input type="date" name="date_start" required>

        <label>Phòng học</label>
        <input type="text" name="room" required>

        <label>Ghi chú</label>
        <textarea name="ghi_chu"></textarea>

        <div class="form-footer">
            <button type="submit" class="save-btn">Lưu</button>
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
