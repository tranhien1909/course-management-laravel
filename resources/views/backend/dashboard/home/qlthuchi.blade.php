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
                            <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
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
                            @forelse ($user->payments as $index => $payment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y H:i') }}</td>
                                    <td>{{ $payment->student_id }}</td>
                                    <td>{{ $payment->course->course_name ?? $payment->course_id }}</td>
                                    <td>{{ number_format($payment->amount, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($payment->payment_method) }}</td>
                                    <td>{{ ucfirst($payment->status) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Chưa có khoản thanh toán nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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

        <label>Mã học viên</label>
        <input type="text" name="ten_hoc_vien" required>

        <label>Mã khóa học</label>
        <textarea type="text" name="khoa_hoc" required></textarea>

        <label>Học phí</label>
        <input type="text" name="hoc_phi" required>

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
