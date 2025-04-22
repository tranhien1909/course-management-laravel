@include('backend.dashboard.home.style-table')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

    input,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 15px;
    }

    .button-container {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 57px;
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

    /* Tui them */

    .schedule-table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
    }

    .schedule-table th,
    .schedule-table td {
        border: 1px solid #ddd;
        text-align: center;
        vertical-align: top;
        padding: 8px;
        height: 60px;
    }

    .schedule-box {
        background-color: #5cb85c;
        color: #fff;
        padding: 5px;
        border-radius: 5px;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .filter-bar form {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        gap: 10px;
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
                        <a href="{{ route('class.index') }}">QL Lớp học</a>
                    </li>
                    <li class="active">
                        <strong>{{ $class->id }}</strong>
                    </li>

                </ol>
            </div>
        </div>

        <div class="ibox float-e-margins" style="background: white">
            <div class="tabs">
                <div class="tab-item active" data-tab="tab1">Thông Tin Chung</div>
                <div class="tab-item" data-tab="tab2">Lịch Học</div>
                <div class="tab-item" data-tab="tab3">Danh Sách Học Viên</div>
                <div class="tab-item" data-tab="tab4">Kết quả học tập</div>
            </div>

            <div class="tab-content-container">
                <div id="tab1" class="tab-content active" style="min-height: 80vh;">
                    <div class="ibox-content">
                        <form id="edit-form" method="POST" action="{{ route('class.update', $class->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label for="class_id">Mã lớp học:</label>
                                <input name="class_id" type="text" id="class-id" placeholder="Mã lớp học"
                                    value="{{ $class->id }}" disabled>
                                <label for="teacher_id" style="margin-top: 36px;">Giáo viên phụ trách:</label>
                                <select name="teacher_id" id="teacher_id" disabled style="width: 100%; height: 43px;">
                                    <option value="{{ $class->user->fullname }}" selected>{{ $class->user->fullname }}
                                    </option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">
                                            {{ $teacher->fullname }}</option>
                                    @endforeach
                                </select>

                                <label for="course_name">Tên khóa học:</label>
                                <input id="course-name" placeholder="Tên khoá học" disabled
                                    value="{{ $class->course->course_name ?? 'N/A' }}" readonly>
                                <label for="room">Phòng học:</label>
                                <input name="room" type="text" id="time" value="{{ $class->room }}"
                                    placeholder="Phòng Học" disabled>
                            </div>
                            <div class="col-md-6">

                                <label for="start_date"><strong>Ngày bắt đầu:</strong></label>
                                <input name="start_date" type="date" id="start-date"
                                    value="{{ \Carbon\Carbon::parse($class->start_date)->format('Y-m-d') }}" disabled>
                                <label for="number_of_student">Sĩ số:</label>
                                <input name="number_of_student" type="number" id="number_of_student"
                                    placeholder="Sĩ số" value="{{ $class->number_of_student }}" disabled readonly>
                                <label for="status">Trạng thái:</label>
                                <select name="status" id="status" disabled style="width: 100%; height: 43px;">
                                    <option value="{{ $class->status }}" selected>{{ $class->status }}</option>
                                    @foreach (['Active', 'Inactive'] as $status)
                                        <option value="{{ $status }}">
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="button-container">
                                    <button type="button" class="save-button" id="edit-btn">Sửa</button>
                                    <button type="submit" class="save-button" id="save-btn"
                                        style="display:none;">Lưu</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div id="tab2" class="tab-content">
                    <div class="filter-bar">
                        <button class="add-btn" onclick="toggleForm()">+ Thêm Lịch học</button>
                        <input style="width: 60%; margin-top: 20px;" class="" type="date" id="datePicker"
                            value="{{ now()->toDateString() }}">
                        <input type="hidden" id="classId" value="{{ $class->id }}">

                    </div>

                    <div class="table-responsive">
                        <div id="scheduleContainer">
                            @include('backend.dashboard.component.weekly_schedule', [
                                'classSchedules' => $classSchedules,
                            ])
                        </div>


                    </div>
                </div>
                <div id="tab3" class="tab-content">
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
                                                <a href="#"><i class="fa-solid fa-trash"
                                                        title="Xoá"></i></a>
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
                <div id="tab4" class="tab-content">
                    <div class="table-responsive">

                        <form action="{{ route('grades.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="class_id" value="{{ $class->id }}">

                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã học viên</th>
                                        <th>Họ tên học viên</th>
                                        <th>Điểm lần 1</th>
                                        <th>Điểm lần 2</th>
                                        <th>Điểm lần 3</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($class->enrollments as $index => $enrollment)
                                        @php
                                            $grade = $enrollment->student->grades
                                                ->where('class_id', $class->id)
                                                ->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $enrollment->student->student_id }}</td>
                                            <td>{{ $enrollment->student->fullname }}</td>

                                            <td><input type="number" step="0.01"
                                                    name="grades[{{ $enrollment->student->id }}][grade_1]"
                                                    class="form-control" value="{{ $grade->grade_1 ?? '' }}"></td>
                                            <td><input type="number" step="0.01"
                                                    name="grades[{{ $enrollment->student->id }}][grade_2]"
                                                    class="form-control" value="{{ $grade->grade_2 ?? '' }}"></td>
                                            <td><input type="number" step="0.01"
                                                    name="grades[{{ $enrollment->student->id }}][grade_3]"
                                                    class="form-control" value="{{ $grade->grade_3 ?? '' }}"></td>
                                            <td><input type="text"
                                                    name="grades[{{ $enrollment->student->id }}][note]"
                                                    class="form-control" value="{{ $grade->note ?? '' }}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>

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
        const editForm = document.getElementById("edit-form");
        const closeButton = document.querySelector(".close");
        const editBtn = document.getElementById("edit-btn");
        const deleteBtn = document.getElementById("delete-btn");

        // Chuyển đổi giữa các tab
        tabItems.forEach(tab => {
            tab.addEventListener("click", function() {
                document.querySelector(".tab-item.active").classList.remove("active");
                document.querySelector(".tab-content.active").classList.remove("active");
                tab.classList.add("active");
                document.getElementById(tab.dataset.tab).classList.add("active");
            });
        });

    });

    function approve(id) {
        document.getElementById('status-' + id).innerText = "Đã duyệt";
    }

    function reject(id) {
        document.getElementById('status-' + id).innerText = "Không duyệt";
    }
    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll(".checkbox");
        const approveBtn = document.getElementById("approve-btn");
        const deleteBtn = document.getElementById("dele-btn");

        function updateButtons() {
            let selectedCount = document.querySelectorAll(".checkbox:checked").length;

            if (selectedCount > 0) {
                approveBtn.style.display = "inline-block";
                deleteBtn.style.display = "inline-block";
            } else {
                approveBtn.style.display = "none";
                deleteBtn.style.display = "none";
            }
        }
    });
</script>

<script>
    document.getElementById('datePicker').addEventListener('change', function() {
        const selectedDate = this.value;
        const classId = document.getElementById('classId').value;

        fetch(`/class-schedule/week?date=${selectedDate}&class_id=${classId}`)
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
