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
            </div>
            <div class="filter-bar">
                <a href="{{ route('studentExport.pdf') }}"><button>Export</button></a>

                <div class="search-container">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" placeholder="Nhập tên khóa học cần tìm ...">
                </div>

                <button class="add-btn" onclick="toggleForm()">+ Thêm Học viên</button>
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
                                <th>Mã học viên</th>
                                <th>Ảnh đại diện</th>
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Email</th>
                                <th>SĐT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($users) && is_object($users))
                                @foreach ($users as $index => $user)
                                    <tr class="course-row">
                                        <td><input type='checkbox' class='row-checkbox'></td>
                                        <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                                        <td>{{ $user->student_id }}</td>
                                        <td><img src="{{ $user->avatar ?? 'https://img.myloview.com/stickers/default-avatar-profile-icon-vector-social-media-user-image-700-205124837.jpg' }}"
                                                class="rounded-circle"
                                                style="width: 100px; height: 100px; object-fit: cover;"
                                                alt='Ảnh avatar'></td>
                                        <td>{{ $user->fullname }}</td>
                                        <td>{{ $user->gender }}</td>
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
            <h2 class="text-center">THÊM HỌC VIÊN</h2>
            {{-- Hiển thị thông báo thành công --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('student.store') }}" method="POST" class="box" enctype="multipart/form-data">
                {{-- CSRF token để bảo mật --}}
                @csrf
                <div class="avatar">
                    <div>
                        <input type="file" class="image-input" accept="image/*" id="fileInput">
                        <img src="https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of-social-media-user-vector.jpg"
                            class="img-circle img-avatar" id="avatarImage">
                    </div>
                </div>
                <form class="store">
                    <label>Username: <span class="text-danger">(*)</span></label>
                    <input type="text" name="username" value="{{ old('username') }}" required>

                    <label>Họ tên: <span class="text-danger">(*)</span></label>
                    <input type="text" name="fullname" value="{{ old('fullname') }}" required>

                    <label>Giới tính: <span class="text-danger">(*)</span></label>
                    <select name="gender">
                        <option value="Nam" {{ old('gender') == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ old('gender') == 'Nữ' ? 'selected' : '' }}>Nữ</option>

                    </select>

                    <label>Ngày sinh: <span class="text-danger">(*)</span></label>
                    <input type="date" name="birthday" value="{{ old('birthday') }}">

                    <label>Email: <span class="text-danger">(*)</span></label>
                    <input type="text" name="email" value="{{ old('email') }}">
                    </select>

                    <label>Số điện thoại: <span class="text-danger">(*)</span></label>
                    <input type="text" name="phone" value="{{ old('phone') }}">

                    <label>Địa chỉ:</label>
                    <input type="text" name="address" value="{{ old('address') }}">

                    <label>Mật khẩu: <span class="text-danger">(*)</span></label>
                    <input type="password" name="password" autocomplete="new-password" value="" required>

                    <label>Nhập lại mật khẩu: <span class="text-danger">(*)</span></label>
                    <input type="password" name="password_confirmation" autocomplete="new-password" value=""
                        required>

                    <div class="form-footer">
                        <button type="submit" class="save-btn">Lưu</button>
                    </div>
                </form>
                <script>
                    document.getElementById('studentForm').addEventListener('submit', function(e) {
                        e.preventDefault();
                        console.log('Form submitted'); // Kiểm tra console
                        this.submit(); // Gửi form
                    });
                </script>
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

        // Reset form khi load trang
        const form = document.querySelector('form');
        form.reset();

        // Validate client-side trước khi submit
        form.addEventListener('submit', function(e) {
            const pwd = form.querySelector('[name="password"]').value;
            const confirm = form.querySelector('[name="password_confirmation"]').value;

            if (pwd !== confirm) {
                e.preventDefault();
                alert('Mật khẩu xác nhận không khớp!');
            }
        });

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

    document.getElementById('avatarImage').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });

    document.getElementById('fileInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            // Kiểm tra kích thước file
            if (file.size > 2 * 1024 * 1024) { // 2MB
                alert('Kích thước ảnh không được vượt quá 2MB');
                return;
            }

            // Kiểm tra loại file
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Chỉ chấp nhận file ảnh (JPEG, PNG, JPG, GIF)');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
