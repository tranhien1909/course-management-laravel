@include('backend.dashboard.home.style-table')
<style>
    .tabs {
        display: flex;
        justify-content: space-around;
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
    }

    .tab-item {
        cursor: pointer;
        padding: 7px 12px;
        font-size: 16px;
        color: black;
        transition: 0.3s;
    }

    .tab-item.active {
        color: #3b6db3;
        border-bottom: 2px solid #3b6db3;
        font-weight: bold;
    }

    .tab-content-container {
        padding: 20px;
        overflow: hidden;
        /* Đảm bảo không có tràn nội dung */
        height: 100%;
        /* Hoặc chiều cao cố định nếu cần */
    }

    .tab-content {
        display: none;
        margin-top: 15px;

    }

    .tab-content.active {
        display: block;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 15px;
    }

    .image-actions {
        position: absolute;
        top: 5px;
        left: 5px;
        display: flex;
        gap: 5px;
    }

    .image-input {
        display: none !important;
    }

    .image-actions .edit-icon {
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 2px 5px;
        font-size: 12px;
        border-radius: 3px;
        cursor: pointer;
        margin-left: 15px;
    }

    .button-container button {
        padding: 8px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .save-button {
        background-color: #3b6db3;
        color: white;
        margin-bottom: 30px;
    }
</style>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="row wrapper border-bottom white-bg page-heading" style="margin-left: -9px; margin-bottom: 20px;">
            <div class="col-lg-10">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('teacher.index') }}">QL Giảng viên</a>
                    </li>
                    <li class="active">
                        <strong>{{ $teacher->user->fullname }}</strong>
                    </li>

                </ol>
            </div>
        </div>

        <div class="ibox float-e-margins" style="background: white">
            <div class="tabs">
                <div class="tab-item active" data-tab="info">Thông Tin Cá Nhân</div>
                <div class="tab-item" data-tab="schedule">Lịch Giảng Dạy</div>
            </div>

            <div class="tab-content-container">
                <!-- Tab Thông Tin Giáo Viên -->
                <div class="tab-content active" id="info">
                    <form id="edit-form" method="POST" action="{{ route('teacher.update', $teacher->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Cột ảnh giáo viên -->
                        <div class="col-md-3">
                            <div class="thumbnail image-box">
                                <div class="image-actions">
                                    <span class="edit-icon"><i class="fa-solid fa-wrench"></i></span>
                                </div>
                                <input name="image" type="file" class="image-input" accept="image/*">
                                <img src="{{ asset('storage/' . $teacher->user->avatar) }}" alt="Ảnh Giáo Viên"
                                    class="img-responsive">
                            </div>
                            <button class="btn btn-default btn-block">{{ $teacher->id }}</button>
                        </div>

                        <!-- Cột thông tin giáo viên -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="teacher_name">Họ và tên:</label>
                                    <input name="teacher_name" type="text" id="teacher_name" class="form-control"
                                        placeholder="Họ và tên" value="{{ $teacher->user->fullname }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="birthday">Ngày sinh:</label>
                                    <input name="birthday" type="date" id="birthday" class="form-control"
                                        placeholder="Ngày sinh"
                                        value="{{ date('Y-m-d', strtotime($teacher->user->birthday)) }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="gender">Giới tính:</label>
                                    <select name="gender" id="gender" disabled style="width: 100%; height: 35px;">
                                        <option value="{{ $teacher->user->gender }}" selected>
                                            {{ $teacher->user->gender }}</option>
                                        @foreach (['Nam', 'Nữ'] as $gender)
                                            <option value="{{ $gender }}">
                                                {{ $gender }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" class="form-control" readonly
                                        placeholder="Email" value="{{ $teacher->user->email }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="expertise">Học vấn:</label>
                                    <input name="expertise" type="text" id="expertise" class="form-control"
                                        placeholder="Học vấn" value="{{ $teacher->expertise }}" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="address">Địa chỉ:</label>
                                    <input name="address" type="text" id="address" class="form-control"
                                        placeholder="Address" value="{{ $teacher->user->address }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="joining_date">Ngày vào làm:</label>
                                    <input type="date" id="joining_date" class="form-control"
                                        placeholder="Ngày vào làm" readonly
                                        value="{{ date('Y-m-d', strtotime($teacher->joining_date)) }}" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone">Số điện thoại:</label>
                                    <input name="phone" type="number" id="phone" class="form-control"
                                        placeholder="Phone" value="{{ $teacher->user->phone }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Trạng thái:</label>
                                    <select name="status" id="status" disabled
                                        style="width: 100%; height: 35px;">
                                        <option value="{{ $teacher->status }}" selected>{{ $teacher->status }}
                                        </option>
                                        @foreach (['Active', 'Inactive'] as $status)
                                            <option value="{{ $status }}">
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="bio">Mô tả:</label>
                                    <textarea name="bio" id="bio" class="form-control" disabled>{{ $teacher->bio }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <div class="button-container">
                                        <button type="button" class="save-button" id="edit-btn">Sửa</button>
                                        <button type="submit" class="save-button" id="save-btn"
                                            style="display:none;">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>


                </div>

                <!-- Tab Lịch Giảng Dạy -->
                <div id="schedule" class="tab-content">
                    <input type="date" id="datePicker" value="{{ now()->toDateString() }}">
                    <input type="hidden" id="teacherId" value="{{ $teacher->id }}">

                    <div id="scheduleContainer">
                        @include('backend.dashboard.component.weekly_schedule', [
                            'classSchedules' => $classSchedules,
                            'weekStart' => $weekStart,
                        ])
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabItems = document.querySelectorAll(".tab-item");
        const tabContents = document.querySelectorAll(".tab-content");

        tabItems.forEach(tab => {
            tab.addEventListener("click", function() {
                document.querySelector(".tab-item.active").classList.remove("active");
                document.querySelector(".tab-content.active").classList.remove("active");

                this.classList.add("active");
                document.getElementById(this.dataset.tab).classList.add("active");
            });
        });
    });

    document.querySelectorAll(".edit-icon").forEach((icon) => {
        icon.addEventListener("click", function() {
            let imageInput = this.closest(".image-box").querySelector(".image-input");
            imageInput.click();
        });
    });

    // Xem trước ảnh
    document.querySelectorAll(".image-input").forEach((input) => {
        input.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.nextElementSibling.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>

<script>
    document.getElementById('datePicker').addEventListener('change', function() {
        const selectedDate = this.value;
        const teacherId = document.getElementById('teacherId').value;

        fetch(`/teacher-schedule/week?date=${selectedDate}&teacher_id=${teacherId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('scheduleContainer').innerHTML = data.html;
            })
            .catch(error => console.error('Error:', error));
    });
</script>

<script>
    document.getElementById('edit-btn').addEventListener('click', function() {
        // Kích hoạt các input và textarea
        var inputs = document.querySelectorAll(
            '#edit-form input:not([type=button]), #edit-form textarea, #edit-form select');

        inputs.forEach(function(input) {
            input.disabled = false;
        });

        // Hiện nút Lưu
        document.getElementById('save-btn').style.display = 'inline-block';
        this.style.display = 'none';
    });

    document.getElementById('save-btn').addEventListener('click', function() {
        // Sau khi submit, disable lại tất cả input
        setTimeout(() => {
            const inputs = document.querySelectorAll('#edit-form input, #edit-form textarea');
            inputs.forEach(input => {
                if (input.type !== 'button') {
                    input.disabled = true;
                }
            });
            document.getElementById('edit-btn').style.display = 'inline-block';
            this.style.display = 'none';
        }, 500);
    });
</script>
