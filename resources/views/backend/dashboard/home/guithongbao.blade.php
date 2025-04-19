@include('backend.dashboard.home.style-table')

<style>
    .content-wrapper {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }

    .send-notification {
        width: 35%;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 12px;
    }

    .form-group textarea {
        height: 250px;
        resize: none;
        line-height: 1.5;
    }

    .form-group:last-child {
        display: flex;
        justify-content: flex-end;
    }

    .danhsach {
        width: 64%;
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
                            <strong>Thông báo</strong>
                        </li>
                        <h3 style="font-size: 18px; margin-top: 20px">THÔNG BÁO</h3>
                    </ol>
                </div>
            </div>

            <div class="ibox-content">
                <div class="content-wrapper">
                    <div class="send-notification">
                        <form action="{{ route('admin.notifications.send') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <select name="type" id="type" onchange="toggleTargetFields()">
                                    <option value="" disabled selected>-- Chọn đối tượng --</option>
                                    <option value="all">Tất cả người dùng</option>
                                    <option value="user">Người dùng cụ thể</option>
                                    <option value="class">Theo lớp học</option>
                                    <option value="course">Theo khoá học</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div id="target-user" style="display: none;">
                                    <label>Chọn người dùng</label>
                                    <select name="user_ids[]" multiple>
                                        @foreach ($students as $user)
                                            <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="target-class" style="display: none;">
                                    <label>Chọn lớp học</label>
                                    <select name="class_ids[]" multiple>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->id }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="target-course" style="display: none;">
                                    <label>Chọn khoá học</label>
                                    <select name="course_ids[]" multiple>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input type="text" name="title" required>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="message" required></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn-success" type="submit">Gửi thông báo</button>
                            </div>
                        </form>
                    </div>
                    <div class="danhsach">
                        <div class="filter-bar" style="margin-left: 0px;">
                            <input type="date" id="tungay" name="tungay">
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ngày gửi</th>
                                            <th>Đối tượng</th>
                                            <th>Tiêu đề</th>
                                            <th>Nội dung</th>
                                            <th colspan="2">Thao tác</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notifications as $index => $notification)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $notification->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    @switch($notification->type)
                                                        @case('all')
                                                            Tất cả người dùng
                                                        @break

                                                        @case('user')
                                                            Người dùng cụ thể
                                                        @break

                                                        @case('class')
                                                            Theo lớp học
                                                        @break

                                                        @case('course')
                                                            Theo khoá học
                                                        @break

                                                        @default
                                                            Hệ thống
                                                    @endswitch
                                                </td>
                                                <td>{{ $notification->title }}</td>
                                                <td>{{ Str::limit($notification->message, 500) }}</td>
                                                <td style="padding: 1px 24px;">
                                                    <a href="{{ route('admin.notifications.create', ['edit' => $notification->id]) }}"
                                                        title="Sửa">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('notifications.destroy', $notification->id) }}"
                                                        method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link p-0" title="Xoá">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
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
    </div>
</div>

@if (isset($editNotification))
    <div class="form-container active" id="addForm">
        <button class="closebtn" onclick="toggleForm()">X</button>
        <h2 class="text-center">SỬA THÔNG BÁO</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('notifications.update', $editNotification->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $editNotification->title) }}" required>
            </div>

            <div class="form-group">
                <label for="message">Nội dung</label>
                <textarea name="message" id="message" class="form-control" rows="5" required>{{ old('message', $editNotification->message) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.notifications.create') }}" class="btn btn-secondary">Huỷ</a>
        </form>
    </div>
@endif


<script>
    function toggleTargetFields() {
        const type = document.getElementById('type').value;
        document.getElementById('target-user').style.display = type === 'user' ? 'block' : 'none';
        document.getElementById('target-class').style.display = type === 'class' ? 'block' : 'none';
        document.getElementById('target-course').style.display = type === 'course' ? 'block' : 'none';
    }
</script>

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
</script>
