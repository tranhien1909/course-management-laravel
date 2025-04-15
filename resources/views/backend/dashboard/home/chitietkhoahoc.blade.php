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

    .thongtinchung {
        display: flex;
        margin: auto;
        gap: 20px;
        width: 100%;
    }

    .left,
    .right {
        flex: 1;
    }

    .left {
        border-right: 1px solid silver;
        padding-right: 20px;
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

    .image-container {
        display: flex;
        gap: 30px;
        margin-top: 12px;
        margin-left: 20px;
        margin-bottom: 12px;
    }

    .image-box {
        width: 140px;
        height: 140px;
        border: 1px solid silver;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
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

    .image-actions .edit-icon,
    .image-actions .delete-icon {
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 2px 5px;
        font-size: 12px;
        border-radius: 3px;
        cursor: pointer;
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

    .feedback-container {
        display: flex;
        gap: 40px;
        /* Khoảng cách giữa các feedback */
        flex-wrap: wrap;
        margin-left: 30px;
    }

    .feedback-card {
        display: flex;
        flex-direction: column;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        width: 46%;
        /* Chia đôi hàng */
        box-sizing: border-box;
        /* Tính cả padding vào width */
        background-color: white;
    }

    .feedback-header {
        display: flex;
        gap: 15px;
        margin-bottom: 12px;
    }

    .avatar {
        width: 50px;
        height: 50px;
        background-color: #00bcd4;
        color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        position: relative;
        top: -10px;
    }

    .feedback-info h3 {
        margin: 0;
        font-size: 16px;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .rating span {
        color: #ff9800;
        font-size: 15px;
        margin-right: 10px;
    }

    .feedback-display {
        width: 100%;
        min-height: 80px;
        resize: none;
        white-space: pre-wrap;
        /* Để xuống dòng giống textarea */
        overflow-y: auto;
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
                        <a href="{{ route('course.index') }}">QL Khoá học</a>
                    </li>
                    <li class="active">
                        <strong>{{{$course->course_name}}}</strong>
                    </li>

                </ol>
            </div>
        </div>

        <div class="ibox float-e-margins" style="background: white">
            <div class="tabs">
                <div class="tab-item active" data-tab="tab1">Thông Tin Chung</div>
                <div class="tab-item" data-tab="tab2">Lớp Học</div>
                <div class="tab-item" data-tab="tab3">Tài liệu học tập</div>
                <div class="tab-item" data-tab="tab4">Bài kiểm tra</div>
                <div class="tab-item" data-tab="tab5">Đánh Giá Của Học Viên</div>
            </div>
            <div class="tab-content-container">
                <div id="tab1" class="tab-content active">
                    <div class="thongtinchung">
                        <div class="left">
                            <label for="course-name"><strong>Tên khoá học:</strong></label>
                            <input type="text" id="course-name" placeholder="Tên khoá học" value="{{$course->course_name}}" disabled>
                            <label for="description"><strong>Mô tả:</strong></label>
                            <textarea id="description" rows="5" placeholder="Mô tả" disabled>{{$course->description}}</textarea>
                            <label for="course-images">Ảnh Khóa Học:</label>
                            <div class="image-container">
                                <div class="image-box">
                                    <div class="image-actions">
                                        <span class="edit-icon"><i class="fa-solid fa-wrench"></i></span>
                                        <span class="delete-icon"><i class="fa-solid fa-x"></i></i></span>
                                    </div>
                                    <input type="file" class="image-input" accept="image/*">
                                    <img src="{{ $course->image }}" alt="Course Image" class="image-preview">
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="form-row">
                                    <label for="course-id" class="right"><strong>Mã khoá học:</strong></label>
                                    <label for="level" class="right"><strong>Level:</strong></label>
                            </div>
                            <div class="form-row">
                                <input type="text" id="course-id" placeholder="Mã khoá học" value="{{$course->id}}" disabled>
                                <input type="text" id="level" placeholder="Level" value="{{$course->level}}" disabled>
                            </div>
                            <div class="form-row">
                                <label for="lessons" class="right"><strong>Số buổi học:</strong></label>
                                <label for="start-date" class="right"><strong>Ngày tạo:</strong></label>
                            </div>
                            <div class="form-row">
                                <input type="number" id="lessons" placeholder="Số buổi học" value="{{$course->lessons}}" disabled>
                                <input type="date" id="start-date" value="{{ \Carbon\Carbon::parse($course->created_at)->format('Y-m-d') }}" disabled>

                            </div>
                            <div class="form-row">
                                <label for="price" class="right"><strong>Học phí:</strong></label>
                                <label for="status" class="right"><strong>Trạng thái:</strong></label>
                            </div>
                            <div class="form-row">
                                <input type="text" id="price" value="{{ number_format($course->price, 0, ',', '.') }} đ" disabled>
                                <input type="text" id="status" placeholder="Trạng thái" value="{{$course->status}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="button" class="save-button" id="edit-btn">Sửa</button>
                        <button type="submit" class="save-button" id="save-btn" style="display:none;">Lưu</button>
                    </div>
                </div>
                <div id="tab2" class="tab-content">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã lớp học</th>
                                    <th>Tên khoá học</th>
                                    <th>Ngày khai giảng</th>
                                    <th>Giáo viên phụ trách</th>
                                    <th>Sĩ số</th>
                                    <th>Trạng thái</th>
                                    <th colspan="2">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($classes->count() > 0)
                                    @foreach ($classes as $index => $class)
                                        <tr class="course-row">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $class->id }}</td>
                                            <td>{{ $course->course_name }}</td>
                                            <td>{{ date('d/m/Y', strtotime($class->start_date)) }}</td>
                                            <td>{{ $class->user->fullname ?? 'N/A' }}</td>
                                            <td>{{ $class->number_of_student }}</td>
                                            <td>{{ $class->status }}</td>
                                            <td style="padding: 1px 24px;">
                                                <a href="{{ route('class.detail', $class->id) }}" title="Xem chi tiết"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                            </td>
                                            <td>
                                                <form action="{{ route('class.destroy', $class->id) }}" method="POST"
                                                    class="delete-form">
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
                                        <td colspan="10">Không có lớp học nào thuộc khóa học này.</td>
                                    </tr>
                                @endif
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                <div id="tab3" class="tab-content">
                    <div class="filter-bar">
                        <button class="add-btn" onclick="toggleForm()">+ Thêm Tài liệu</button>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                <div id="tab4" class="tab-content">
                    <div class="filter-bar">
                        <button class="add-btn" onclick="toggleForm()">+ Thêm Bài thi</button>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã khoá học</th>
                                    <th>Tên kỳ thi</th>
                                    <th>Ngày thi</th>
                                    <th>Giáo viên phụ trách</th>
                                    <th colspan="2">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course->exams as $index => $exam)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $exam->course_id }}</td>
                                    <td>{{ $exam->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d/m/Y') }}</td>
                                    <td>{{ $exam->user->fullname ?? 'N/A' }}</td>
                                    <td style="padding: 1px 24px;">
                                        <a href="#" title="Xem chi tiết"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                    <td>
                                        <form action="#" method="POST"
                                            class="delete-form">
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
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                <div id="tab5" class="tab-content">
                    <div class="feedback-container">
                        <div class="feedback-card">
                            <div class="feedback-header">
                                <div class="avatar">
                                    <span class="initials">ÁN H</span>
                                </div>
                                <div class="feedback-info">
                                    <h3>Nguyễn Văn A</h3>
                                    <div class="rating">
                                        <span>★★★★★</span> – <span style="margin-left: 10px; color: black;">thời
                                            gian</span>
                                    </div>
                                </div>
                            </div>
                            <div class="feedback-content">
                                <div class="feedback-display">Phản hồi của người dùng sẽ hiển thị ở đây...</div>
                            </div>
                        </div>
                        <div class="feedback-card">
                            <div class="feedback-header">
                                <div class="avatar">
                                    <span class="initials">ÁN H</span>
                                </div>
                                <div class="feedback-info">
                                    <h3>Nguyễn Văn A</h3>
                                    <div class="rating">
                                        <span>★★★★★</span> – <span style="margin-left: 10px; color: black;">thời
                                            gian</span>
                                    </div>
                                </div>
                            </div>
                            <div class="feedback-content">
                                <div class="feedback-display">Phản hồi của người dùng sẽ hiển thị ở đây...</div>
                            </div>
                        </div>
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

    document.querySelectorAll(".image-input").forEach((input) => {
        input.addEventListener("change", function() {
            let file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    let imagePreview = this.closest(".image-box").querySelector(".image-preview");
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });

    document.querySelectorAll(".delete-icon").forEach((icon) => {
        icon.addEventListener("click", function(event) {
            event.stopPropagation();
            this.closest(".image-box").remove();
        });
    });
</script>

<script>
    document.getElementById('edit-btn').addEventListener('click', function () {
        // Kích hoạt các input và textarea
        var inputs = document.querySelectorAll('#edit-form input:not([type=button]), #edit-form textarea');
        inputs.forEach(function(input) {
            input.disabled = false;
        });
    
        // Hiện nút Lưu
        document.getElementById('save-btn').style.display = 'inline-block';
        this.style.display = 'none';
    });
    </script>
