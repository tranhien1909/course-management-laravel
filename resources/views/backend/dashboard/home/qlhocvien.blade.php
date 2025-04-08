@include('backend.dashboard.home.style-table')

<style>
    .table-responsive {
        margin-top: 30px;
    }

    .course-img {
        width: 140px;
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
                    <form id="searchForm" method="GET" action="{{ route('student.search') }}">
                        @csrf
                        <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="keyword" placeholder="Nhập tên hoặc mã cần tìm ..."
                            value="{{ request('keyword') }}">
                        <button type="submit" style="display: none;"></button>
                    </form>
                </div>

                <button class="add-btn" onclick="toggleForm()">+ Thêm Học viên</button>
            </div>

            <div class="ibox-content">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã học viên</th>
                                <th>Ảnh đại diện</th>
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Email</th>
                                <th>SĐT</th>
                                <th colspan="2">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('backend.dashboard.partials.student_table')
                        </tbody>
                    </table>
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
            <form action="{{ route('student.store') }}" method="POST" class="box" id="studentForm"
                enctype="multipart/form-data">
                {{-- CSRF token để bảo mật --}}
                @csrf
                <div class="avatar">
                    <div>
                        <input type="file" class="image-input" accept="image/*" id="fileInput">
                        <img src="https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of-social-media-user-vector.jpg"
                            class="img-circle img-avatar" id="avatarImage">
                    </div>
                </div>
                <div class="store">
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

    // Hàm xử lý thêm mới
    document.getElementById('studentForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw err;
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert(data.success);
                    location.reload();
                } else if (data.error) {
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert(error.message || "Lỗi khi thêm học viên");
            });
    });

    function deleteStudent(userId) {
        if (!confirm("Bạn có chắc muốn xóa học viên này?")) return;

        fetch(`{{ route('student.destroy', '') }}/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw err;
                    });
                }
                return response.json();
            })
            .then(data => {
                alert(data.success || 'Xóa thành công!');
                location.reload();
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert(error.message || "Không thể xoá học viên. Vui lòng thử lại.");
            });
    }

    // Hàm xử lý tìm kiếm k tải lại trang
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const keyword = this.querySelector('input[name="keyword"]').value;
        const url = `${this.action}?keyword=${encodeURIComponent(keyword)}`;

        fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.html) {
                    document.querySelector('table tbody').innerHTML = data.html;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Fallback: tải lại trang nếu AJAX thất bại
                window.location.href = url;
            });
    });

    function updateStudentTable(html) {
        const tbody = document.querySelector('table tbody');
        const pagination = document.querySelector('.pagination');

        // Tạo DOM tạm để phân tích HTML
        const tempDom = document.createElement('div');
        tempDom.innerHTML = html;

        // Cập nhật nội dung bảng
        const newTbody = tempDom.querySelector('table tbody');
        const newPagination = tempDom.querySelector('.pagination');

        if (newTbody) tbody.innerHTML = newTbody.innerHTML;
        if (newPagination) pagination.innerHTML = newPagination.innerHTML;
    }
</script>
