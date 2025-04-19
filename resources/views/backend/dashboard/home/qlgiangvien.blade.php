@include('backend.dashboard.home.style-table')

<style>
    table img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
        margin-left: 6px;
    }

    .table-responsive {
        margin-top: 30px;

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
                            <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
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
                    <form action="{{ route('teacher.index') }}" method="GET">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm kiếm theo mã lớp hoặc tên khóa học" value="{{ request('search') }}">
                        <button type="submit" class="search-icon"
                            style="background-color: white; left: 8px; padding: 6px;"><i
                                class="fa-solid fa-magnifying-glass" style="color: #3b6db3;"></i></button>
                    </form>
                </div>

                <button class="add-btn" onclick="toggleForm()">+ Thêm Giảng Viên</button>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>

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
                                <th colspan="2">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($teachers) && is_object($teachers))
                                @foreach ($teachers as $index => $teacher)
                                    <tr class="course-row">

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
                                        <td style="padding: 1px 24px;">
                                            <a href="{{ route('teacher.detail', $teacher->id) }}"
                                                title="Xem chi tiết"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('teacher.destroy', $teacher->id) }}" method="POST"
                                                class="delete-form"
                                                onsubmit="return confirm('Bạn có chắc muốn xoá giảng viên này không?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0" style="border: none;"
                                                    title="Xoá">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="12">Không có khóa học nào.</td>
                                </tr>
                            @endif

                            @if (isset($teachers))
                                <tr>
                                    <td colspan="12">
                                        {{ $teachers->links('pagination::bootstrap-4') }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-container" id="addForm">
    <button class="closebtn" onclick="toggleForm()">X</button>
    <h2 class="text-center">THÊM GIẢNG VIÊN</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('teacher.store') }}" method="POST" class="box" id="teacherForm"
        enctype="multipart/form-data">
        @csrf
        <div class="avatar">
            <div>
                <input name="avatar" type="file" class="image-input" accept="image/*" id="fileInput">
                <img src="https://static.vecteezy.com/system/resources/previews/009/292/244/large_2x/default-avatar-icon-of-social-media-user-vector.jpg"
                    class="img-circle img-avatar" id="avatarImage">
            </div>
        </div>


        <label>Họ tên: <span class="text-danger">(*)</span></label>
        <input type="text" name="fullname" value="{{ old('fullname') }}" required>

        <label>Giới tính: <span class="text-danger">(*)</span></label>
        <select name="gender" required>
            <option value="" disabled selected>Chọn giới tính</option>
            @foreach (['Nam', 'Nữ'] as $gender)
                <option value="{{ $gender }}" {{ old('gender') == $gender ? 'selected' : '' }}>
                    {{ $gender }}
                </option>
            @endforeach
        </select>

        <label>Ngày sinh: <span class="text-danger">(*)</span></label>
        <input type="date" name="birthday" value="{{ old('birthday') }}" required>

        <label>Email: <span class="text-danger">(*)</span></label>
        <input type="text" name="email" value="{{ old('email') }}" required>
        </select>

        <label>Số điện thoại: <span class="text-danger">(*)</span></label>
        <input type="text" name="phone" value="{{ old('phone') }}" required>

        <label>Địa chỉ:</label>
        <input type="text" name="address" value="{{ old('address') }}" required>

        <label>Bằng cấp:</label>
        <input type="text" name="expertise" value="{{ old('expertise') }}" required>

        <label>Ngày vào làm: <span class="text-danger">(*)</span></label>
        <input type="date" name="joining_date" value="{{ old('joining_date') }}" required>

        <label>Giới thiệu:</label>
        <textarea name="bio"></textarea>

        <label>Mật khẩu: <span class="text-danger">(*)</span></label>
        <input type="password" name="password" autocomplete="new-password" value="" required>

        <label>Nhập lại mật khẩu: <span class="text-danger">(*)</span></label>
        <input type="password" name="password_confirmation" autocomplete="new-password" value="" required>

        <div class="form-footer">
            <button type="submit" class="save-btn">Lưu</button>
        </div>
    </form>
    <script>
        document.getElementById('teacherForm').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted'); // Kiểm tra console
            this.submit(); // Gửi form
        });
    </script>
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
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Hàm xử lý thêm mới
    document.getElementById('teacherForm').addEventListener('submit', function(e) {
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
</script>

<script>
    $(document).ready(function() {
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();

            if (!confirm('Bạn có chắc chắn muốn xoá giảng viên này?')) {
                return false;
            }

            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: form.find('input[name="_token"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.success);
                        setTimeout(() => {
                            location.reload();
                        }, 1000); // đợi toastr hiển thị rồi reload
                    }
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.error || 'Có lỗi xảy ra');
                }
            });
        });
    });
</script>
