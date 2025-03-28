@include('backend.dashboard.home.style-table')

<style>
    table img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 5px;
        margin-left: 6px;
    }

    .action-buttons {
        position: absolute;
        right: -25px;
        top: -43px;
        /* Điều chỉnh khoảng cách với bảng */
        display: flex;
        gap: 15px;
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
                            <strong>QL Giảng viên</strong>
                        </li>
                        <h3 style="font-size: 18px; margin-top: 20px">DANH SÁCH GIẢNG VIÊN</h3>
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
                    <input type="text" placeholder="Nhập hoặc mã giáo viên cần tìm ...">
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
                                <th>Tên giáo viên</th>
                                <th>Bằng cấp</th>
                                <th>Email</th>
                                <th>SĐT</th>
                                <th>Ngày vào làm</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($teachers) && is_object($teachers))
                                @foreach ($teachers as $index => $teacher)
                                    <tr class="course-row">
                                        <td><input type='checkbox' class='row-checkbox'></td>
                                        <td>{{ $index + 1 }}</td>
                                        <td><img src="" class="rounded-circle"
                                                style="width: 100px; height: 100px; object-fit: cover;"
                                                alt='Ảnh avatar'></td>
                                        <td></td>
                                        {{-- <td>{{ $teacher->teacher_name }}</td> --}}
                                        <td>{{ $teacher->expertise }}</td>
                                        {{-- <td>{{ date('d/m/Y', strtotime($teacher->start_date)) }}</td>
                                        <td>{{ date('d/m/Y', strtotime($teacher->end_date)) }}</td> --}}
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        {{-- <td>{{ $teacher->teacherUser->fullname ?? 'N/A' }}</td> --}}
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">Không có khóa học nào.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $teachers->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.querySelectorAll(".row-checkbox").forEach(checkbox => {
        checkbox.addEventListener("change", function() {
            this.closest("tr").classList.toggle("selected", this.checked);
        });
    });
</script>

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
</script>
