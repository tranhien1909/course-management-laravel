@include('backend.dashboard.home.style-table')

<style>
    .ibox-content {
        position: relative;
    }

    table img {
        width: 100px;
        height: 100px;
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

    .image-input {
        display: none;
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
            </div>
            <div class="filter-bar">
                <a href="{{ route('teacherExport.pdf') }}"><button>Export</button></a>

                <div class="search-container">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" placeholder="Nhập hoặc mã giáo viên cần tìm ...">
                </div>

                <button class="add-btn" onclick="toggleForm()">+ Thêm Giảng Viên</button>
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
                                <th>Mã giáo viên</th>
                                <th>Ảnh đại diện</th>
                                <th>Tên giáo viên</th>
                                <th>Giới tính</th>
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
                                        <td>{{ $teacher->id }}</td>
                                        <td><img src="{{ $teacher->user->avatar }}" class="rounded-circle"
                                                alt='Ảnh avatar'></td>
                                        <td>{{ $teacher->user->fullname ?? 'N/A' }}</td>
                                        <td>{{ $teacher->user->gender }}</td>
                                        <td>{{ $teacher->expertise }}</td>
                                        <td>{{ $teacher->user->email ?? 'N/A' }}</td>
                                        <td>{{ $teacher->user->phone ?? 'N/A' }}</td>
                                        <td>{{ date('d/m/Y', strtotime($teacher->joining_date)) }}</td>
                                        <td>{{ $teacher->status }}</td>
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

<div class="form-container" id="addForm">
    <button class="closebtn" onclick="toggleForm()">X</button>
    <h2 class="text-center">THÊM GIẢNG VIÊN</h2>
    <div class="avatar">
        <div>
            <input type="file" class="image-input" accept="image/*" id="fileInput">
            <img src="https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of-social-media-user-vector.jpg"
                class="img-circle img-avatar" id="avatarImage">
        </div>
    </div>

    <form>
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Họ tên:</label>
        <input type="text" name="fullname" required>

        <label>Giới tính:</label>
        <select name="gender" required>
            <option value="male">Nam</option>
            <option value="female">Nữ</option>
        </select>

        <label>Ngày sinh:</label>
        <input type="date" name="birthday" required>

        <label>Email:</label>
        <input type="text" name="email" required>
        </select>

        <label>Số điện thoại:</label>
        <input type="text" name="phone" required>

        <label>Địa chỉ:</label>
        <input type="text" name="address" required>

        <label>Bằng cấp:</label>
        <input type="text" name="expertise" required>

        <label>Giới thiệu:</label>
        <textarea name="bio"></textarea>

        <label>Mật khẩu:</label>
        <input type="password" name="password" required>

        <label>Nhập lại mật khẩu:</label>
        <input type="password" name="password" required>

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

    document.getElementById('avatarImage').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });


    document.getElementById('fileInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
