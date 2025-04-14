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
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .tenlop {
        display: flex;
        justify-content: center;
        /* Căn giữa theo chiều ngang */
        align-items: center;
        /* Căn giữa theo chiều dọc */
        height: 30px;
        /* Điều chỉnh chiều cao nếu cần */
        margin-bottom: 20px;
    }

    .table-container {
        width: 100%;
        background: white;
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px 8px;
        text-align: center;
    }

    th {
        background-color: #3b6db3;
        color: white;
        font-weight: bold;
    }

    td {
        max-height: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    td a {
        text-decoration: none;
        line-height: 1.5;
        color: black;
    }

    .add-btn {
        background: white;
        color: #3b6db3;
        font-size: 15px;
        padding: 6px 10px;
        border-radius: 3px;
        cursor: pointer;
        margin-bottom: -5px;
        border: 1px solid silver;
    }

    .anhhv img {
        width: 70px;
        /* Định kích thước ảnh */
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stu-list {
        max-height: 300px;
        /* hoặc chiều cao bạn muốn */
        overflow-y: auto;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 10px;
    }

    .addhv {
        background: white;
        color: #3b6db3;
        font-size: 15px;
        padding: 6px 10px;
        border-radius: 3px;
        cursor: pointer;
        margin-bottom: 20px;
        border: 1px solid silver;
    }

    .stu-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        width: 265px;
        position: relative;
        border: 1px solid silver;
        height: 83px;
    }

    .anh {
        background: #eee;
        border-radius: 5px;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
    }

    .stu-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-left: 5px;
        flex-grow: 1;
    }

    .stu-info h3 {
        font-size: 14.5px;
    }

    .stu-info p {
        font-size: 13px;
        color: #555;
    }

    button {
        padding: 5px 12px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
    }

    button:hover {
        opacity: 0.8;
    }

    /* Nút "Duyệt" - Màu xanh lá */
    button.approve-btn {
        background-color: #28a745;
        color: white;
    }

    /* Nút "Không duyệt" - Màu đỏ */
    button.reject-btn {
        background-color: #dc3545;
        color: white;
        margin-left: 7px;
    }

    .thongtinchung {
        display: flex;
        margin: auto;
        gap: 20px;
        width: 95%;
    }

    .left,
    .right {
        flex: 1;
    }

    .right {
        padding-left: 10px;
    }

    .left {
        border-right: 1px solid silver;
        padding-right: 30px;
    }

    .form-row {
        display: flex;
        gap: 10px;
    }

    .form-row input {
        flex: 1;
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

    .tenlop {
        display: flex;
        justify-content: center;
        /* Căn giữa theo chiều ngang */
        align-items: center;
        /* Căn giữa theo chiều dọc */
        height: 30px;
        /* Điều chỉnh chiều cao nếu cần */
        margin-bottom: 20px;
    }

    .button-container {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 35px;
        margin-right: 10px;
        margin-bottom: -20px;
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

    .edit-button {
        background-color: #008CBA;
        color: white;
    }

    .edit-form {
        position: fixed;
        top: 250px;
        left: 56%;
        transform: translateX(-50%);
        width: 450px;
        background: white;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
        text-align: center;
        opacity: 0;
        visibility: hidden;
        transition: 0.4s;
        z-index: 1003;
    }

    .edit-form.active {
        opacity: 1;
        visibility: visible;
    }

    .edit-form p {
        font-weight: bold;
        margin: 15px 0;
        font-size: 17px;
    }

    .edit-form input,
    .edit-form textarea {
        width: 90%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 15px;
    }

    .edit-form button {
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        background: #3b6db3;
        color: white;
        cursor: pointer;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 20px;
        cursor: pointer;
        font-weight: bold;
        color: #555;
    }

    .actions {
        text-align: right;
        /* Căn chỉnh các nút sang phải */
        margin-bottom: 15px;
        margin-top: -8px
            /* Thêm một chút khoảng cách từ bảng */
    }

    /* Nút Sửa và Xóa */
    .actions button {
        padding: 6px 15px;
        margin-left: 10px;
        /* Khoảng cách giữa các nút */
        background-color: #3b6db3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .actions button:hover {
        background-color: #0056b3;
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
                        <a href="{{ route('class.index') }}">Lớp học của tôi</a>
                    </li>
                    <li class="active">
                        <strong>{{ $class->id }}</strong>
                    </li>

                </ol>
            </div>
        </div>

        <div class="ibox float-e-margins" style="background: white">
            <div class="tabs">
                <div class="tab-item active" data-tab="tab1">Lịch Học</div>
                <div class="tab-item" data-tab="tab2">Danh Sách Học Viên</div>
                <div class="tab-item" data-tab="tab3">Tài Liệu Học Tập</div>
            </div>

            <div class="tab-content-container">
                <div id="tab1" class="tab-content active">
                    <div class="filter-bar">
                        <button class="add-btn" onclick="toggleForm()">+ Thêm lịch học</button>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 50px;">STT</th>
                                    <th style="width: 90px;">Ngày trong tuần</th>
                                    <th style="width: 110px;">Thời gian học</th>
                                    <th style="width: 230px;">Phòng học</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($class->classSchedules as $index => $classSchedule)
                                    <tr class="course-row">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($classSchedule->day_of_week)->translatedFormat('l') }}
                                        </td>
                                        <td>{{ $classSchedule->start_time }} - {{ $classSchedule->end_time }}</td>
                                        <td><a href="{{ $classSchedule->room }}"
                                                target="_blank">{{ $classSchedule->room ?? 'Online' }}</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Chưa có lịch học nào cho lớp này.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tab2" class="tab-content">
                    <div class="filter-bar">
                        <button>Export</button>
                    </div>
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
                                @forelse ($class->enrollments as $index => $enrollment)
                                    @php $user = $enrollment->student; @endphp
                                    @if ($user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->student_id }}</td>
                                            <td><img src="{{ $user->avatar }}" width="40" /></td>
                                            <td>{{ $user->fullname }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>{{ date('d/m/Y', strtotime($user->birthday)) }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td style="padding: 1px 24px;">
                                                <a href="{{ route('student.detail', $user->id) }}"
                                                    title="Xem chi tiết">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#"><i class="fa-solid fa-trash" title="Xoá"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="10">Không có học viên nào đăng ký lớp học này.</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
                <div id="tab3" class="tab-content">
                    <div class="filter-bar">
                        <button class="add-btn" onclick="toggleForm()">+ Thêm tài liệu</button>
                    </div>

                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">STT</th>
                                        <th style="width: 200px;">File/Link tài liệu</th>
                                        <th style="width: 200px;">Giáo viên phụ trách</th>
                                        <th style="width: 120px;">Ngày tải lên</th>
                                        <th style="width: 120px;">Trạng thái</th>
                                        <th style="width: 120px;">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($class->course->courseMaterials as $material)
                                        @php
                                            $teacher = $material->teacher;
                                            $user = $teacher ? $teacher->user : null; // Kiểm tra nếu có giáo viên phụ trách
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ Str::startsWith($material->file_url, 'http') ? $material->file_url : asset('storage/' . $material->file_url) }}"
                                                    target="_blank">
                                                    {{ $material->title }}
                                                </a>
                                            </td>
                                            <td>{{ $class->user->fullname ?? 'N/A' }}</td>
                                            <td>{{ $material->created_at->format('d/m/Y') }}</td>
                                            <td>Đã duyệt</td>
                                            <td>
                                                <a href="#"><i class="fa-solid fa-trash" title="Xoá"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="edit-form" class="edit-form">
            <span class="close">&times;</span>
            <p>CHỈNH SỬA LỊCH HỌC</p>
            <input type="hidden" id="edit-row-index">
            <input type="text" id="edit-buoi-hoc" placeholder="Buổi học">
            <input type="text" id="edit-noi-dung" placeholder="Nội dung">
            <input type="date" id="edit-ngay-day" placeholder="Ngày dạy">
            <input type="text" id="edit-thoi-gian" placeholder="Thời gian (hh:mm - hh:mm)">
            <textarea id="edit-phong-hoc" placeholder="Phòng học"></textarea>
            <button onclick="">Lưu</button>
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
</script>
