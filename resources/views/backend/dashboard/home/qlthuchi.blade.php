@include('backend.dashboard.home.style-table')

<style>
    .ibox-content {
        position: relative;
    }

    table img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 5px;
        margin-left: 6px;
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

    .course-row {
        background-color: white;
        opacity: 1;
        transition: background 0.3s ease, opacity 0.3s ease;
    }

    .course-row.selected {
        background-color: #f5fcff;
        opacity: 1;
    }

    .input-group {
        position: relative;
    }

    .input-group::before {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: gray;
        pointer-events: none;
    }

    .input-group input {
        padding-left: 100px;
        height: 40px;
        border-radius: 4px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        width: 250px;
        font-size: 15px;
    }

    .input-group.from::before {
        content: "Từ ngày:";
    }

    .input-group.to::before {
        content: "Đến ngày:";
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.4);
        /* Màu đen mờ */
        display: none;
        /* Mặc định ẩn */
        justify-content: center;
        align-items: center;
        z-index: 1001;
        /* Hiển thị trên cùng */
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
                            <strong>QL Thu Chi</strong>
                        </li>
                        <h3 style="font-size: 18px; margin-top: 20px">DANH SÁCH HÓA ĐƠN</h3>
                    </ol>
                </div>
            </div>
            <div class="filter-bar">
                <button>Export</button>

                <div class="input-group from">
                    <input type="date" id="tungay" name="tungay">
                </div>
                <div class="input-group to">
                    <input type="date" id="denngay" name="denngay">
                </div>

                <div class="search-container">
                    <form action="" method="GET">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm kiếm theo mã lớp hoặc tên khóa học" value="">
                        <button type="submit" class="search-icon"
                            style="background-color: white; left: 8px; padding: 6px;"><i
                                class="fa-solid fa-magnifying-glass" style="color: #3b6db3;"></i></button>
                    </form>
                </div>

                <button class="add-btn" onclick="toggleForm()">+ Thêm Hoá đơn</button>
            </div>
            <div class="ibox-content">
                <div class="action-buttons">
                    <button class="btn-edit">Sửa</button>
                    <button class="btn-delete">Xóa</button>
                </div>
                <div class="table-responsive" style="margin-top: 60px;">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>STT</th>
                                <th>Mã hóa đơn</th>
                                <th>Ngày tạo</th>
                                <th>Tên học viên</th>
                                <th>Khóa học</th>
                                <th>Số buổi học</th>
                                <th>Trạng thái học viên</th>
                                <th>Học phí</th>
                                <th>Giảm giá</th>
                                <th>Trạng thái thanh toán</th>
                                <th>Phương thức thanh toán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="course-row">
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td>1</td>
                                <td>HD0001</td>
                                <td>21/11/2023</td>
                                <td>Nguyễn Văn A</td>
                                <td class="word-wrap">DanceSport Cơ Bản</td>
                                <td>30/30</td>
                                <td>Đang học</td>
                                <td>5.000.000 VNĐ</td>
                                <td>10%</td>
                                <td>Đã thanh toán</td>
                                <td>Chuyển khoản</td>
                            </tr>
                            {{-- @if (isset($teachers) && is_object($teachers))
                                @foreach ($teachers as $index => $teacher)
                                    <tr class="course-row">
                                        <td><input type='checkbox' class='row-checkbox'></td>
                                        <td>{{ $index + 1 }}</td>
                                        <td><img src="" class="rounded-circle"
                                                style="width: 100px; height: 100px; object-fit: cover;"
                                                alt='Ảnh avatar'></td>
                                        <td></td> --}}
                            {{-- <td>{{ $teacher->teacher_name }}</td> --}}
                            {{-- <td>{{ $teacher->expertise }}</td> --}}
                            {{-- <td>{{ date('d/m/Y', strtotime($teacher->start_date)) }}</td>
                                        <td>{{ date('d/m/Y', strtotime($teacher->end_date)) }}</td> --}}
                            {{-- <td>{{ $teacher->teacherUser->fullname ?? 'N/A' }}</td> --}}
                            {{-- </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">Không có khóa học nào.</td>
                                </tr>
                            @endif --}}
                        </tbody>
                    </table>
                    {{-- {{ $teachers->links('pagination::bootstrap-4') }} --}}
                </div>
            </div>
        </div>
    </div>

</div>
<div class="form-container" id="addForm">
    <button class="closebtn" onclick="toggleForm()">X</button>
    <h2 class="text-center">THÊM HÓA ĐƠN</h2>
    <form>
        <label>Mã hóa đơn</label>
        <input type="text" name="ma_hoa_don" required>

        <label>Ngày tạo</label>
        <input type="date" name="ngay_tao" required>

        <label>Tên học viên</label>
        <input type="text" name="ten_hoc_vien" required>

        <label>Khóa học</label>
        <textarea type="text" name="khoa_hoc" required></textarea>

        <label>Số buổi học</label>
        <input type="number" name="so_buoi_hoc" required>

        <label>Trạng thái học viên</label>
        <select name="trang_thai_hoc_vien" required>
            <option value="dang_hoc">Đang học</option>
            <option value="hoan_thanh">Hoàn thành</option>
            <option value="ngung_hoc">Ngừng học</option>
        </select>

        <label>Học phí</label>
        <input type="text" name="hoc_phi" required>

        <label>Giảm giá</label>
        <input type="text" name="giam_gia" required>

        <label>Trạng thái thanh toán</label>
        <select name="trang_thai_thanh_toan" required>
            <option value="chua_thanh_toan">Chưa thanh toán</option>
            <option value="da_thanh_toan">Đã thanh toán</option>
        </select>

        <label>Phương thức thanh toán</label>
        <select name="phuong_thuc_thanh_toan" required>
            <option value="tien_mat">Tiền mặt</option>
            <option value="chuyen_khoan">Chuyển khoản</option>
        </select>

        <label>Ghi chú</label>
        <textarea name="ghi_chu"></textarea>

        <div class="form-footer">
            <button type="submit" class="save-btn">Lưu</button>
        </div>
    </form>
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
            selectAll.checked = false;
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
