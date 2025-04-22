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

    .image-actions .edit-icon {
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
        <div class="overlay" id="overlay" onclick="toggleForm()" onclick="toggleFormQuiz()"></div>
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
                <div id="tab1" class="tab-content active" style="min-height: 100vh;">
                    <div class="ibox-content">
                        <form id="edit-form" method="POST" action="{{ route('course.update', $course->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label for="course_name"><strong>Tên khoá học:</strong></label>
                                <input name="course_name" type="text" id="course-name" placeholder="Tên khoá học" value="{{$course->course_name}}" disabled>
                                <label for="description"><strong>Mô tả:</strong></label>
                                <textarea name="description" id="description" rows="5" placeholder="Mô tả" disabled>{{$course->description}}</textarea>
                                <label for="course-images">Ảnh Khóa Học:</label>
                                <div class="image-container">
                                    <div class="image-box">
                                        <div class="image-actions">
                                            <span class="edit-icon"><i class="fa-solid fa-wrench"></i></span>
                                        </div>
                                        <input name="image" type="file" class="image-input" accept="image/*">
                                        <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" class="image-preview">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row">
                                        <label for="course_id" class="right"><strong>Mã khoá học:</strong></label>
                                        <label for="level" class="right"><strong>Level:</strong></label>
                                </div>
                                <div class="form-row">
                                    <input type="text" id="course-id" placeholder="Mã khoá học" value="{{$course->id}}" disabled readonly>
                                    <select name="level" id="level" disabled style="width: 50%; height: 43px;">
                                        <option value="{{$course->level}}" selected>{{$course->level}}</option>
                                        @foreach (['A1', 'A2', 'B1', 'B2', 'C1', 'C2'] as $level)
                                            <option value="{{ $level }}">
                                                {{ $level }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-row">
                                    <label for="lessons" class="right"><strong>Số buổi học:</strong></label>
                                    <label for="start-date" class="right"><strong>Ngày tạo:</strong></label>
                                </div>
                                <div class="form-row">
                                    <input name="lessons" type="number" id="lessons" placeholder="Số buổi học" value="{{$course->lessons}}" disabled>
                                    <input type="text" id="start-date" 
                                    value="{{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y') }}" 
                                    disabled readonly>    
                                </div>
                                <div class="form-row">
                                    <label for="price" class="right"><strong>Học phí:</strong></label>
                                    <label for="status" class="right"><strong>Trạng thái:</strong></label>
                                </div>
                                <div class="form-row">
                                    <input name="price" type="number" id="price" value="{{ $course->price }}" disabled>
                                    <select name="status" id="status" disabled style="width: 50%; height: 43px;">
                                        <option value="{{$course->status}}" selected>{{$course->status}}</option>
                                        @foreach (['Active', 'Inactive'] as $status)
                                            <option value="{{ $status }}">
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="button-container">
                                    <button type="button" class="save-button" id="edit-btn">Sửa</button>
                                    <button type="submit" class="save-button" id="save-btn" style="display:none;">Lưu</button>
                                </div>
                            </div>
                        </form>
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
                                        <th>STT</th>
                                        <th>File/Link tài liệu</th>
                                        <th>Giáo viên phụ trách</th>
                                        <th>Ngày tải lên</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($course->courseMaterials->count() > 0)
                                        @foreach ($course->courseMaterials as $index => $material)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <a href="{{ Str::startsWith($material->file_url, 'http') ? $material->file_url : asset('storage/' . $material->file_url) }}"
                                                        target="_blank">
                                                        {{ $material->title }}
                                                    </a>
                                                </td>
                                                <td>{{ $material->teacher->fullname ?? 'N/A' }}</td>
                                                <td>{{ $material->created_at->format('d/m/Y') }}</td>
                                                <td>Đã duyệt</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">Không có tài liệu nào thuộc khóa học này.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        

                    </div>
                </div>
                <div id="tab4" class="tab-content">
                    <div class="filter-bar">
                        <button class="add-btn" onclick="toggleFormQuiz()">+ Thêm Bài thi</button>
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
                                @if ($course->quizzes->count() > 0)
                                    @foreach ($course->quizzes as $index => $quizz)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $quizz->course_id }}</td>
                                        <td>{{ $quizz->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($quizz->available_from)->format('d/m/Y') }}</td>
                                        <td>{{ $quizz->user->fullname ?? 'N/A' }}</td>
                                        <td style="padding: 1px 24px;">
                                            <a href="{{route('questions.create', $quizz->id)}}" title="Tạo câu hỏi"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('quizzes.destroy', $quizz->id) }}" method="POST" class="delete-form"
                                                onsubmit="return confirm('Bạn có chắc muốn xoá bài thi này không?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0" style="border: none;" title="Xoá">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">Chưa có bài thi nào thuộc khóa học này.</td>
                                    </tr>
                                @endif
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                <div id="tab5" class="tab-content">
                    <div class="filter-bar">
        
                        <div class="search-container">
                            <form action="" method="GET">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Tìm kiếm theo mã hoặc số ⭐" value="{{ request('search') }}">
                                <button type="submit" class="search-icon"
                                    style="background-color: white; left: 8px; padding: 6px; top: 17px;"><i
                                        class="fa-solid fa-magnifying-glass" style="color: #3b6db3;"></i></button>
                            </form>
                        </div>
        
                    </div>
                    <div class="ibox-content">
                        <p>Đánh giá trung bình: {{ $averageRating }} ⭐ ({{ $totalReviews }} đánh giá)</p>
                    </div>

                    <ul>
                    @foreach ($course->reviews as $review)
                    <div class="ibox-content">
                        <li>
                            <strong>{{ $review->student->fullname }} (</strong> 
                            <strong>{{ $review->student->student_id }}): </strong> 
                            {{ $review->rating }}⭐<br>
                            <em>{{ $review->comment }}</em>
                        </li>
                    </div>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-container" id="addForm">
    <button class="closebtn" onclick="toggleForm()">X</button>
    <h2 class="text-center">THÊM TÀI LIỆU</h2>


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('course-materials.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course->id }}">
    
        <div class="form-group">
            <label for="title">Tên tài liệu</label>
            <input type="text" name="title" class="form-control" required>
        </div>
    
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
    
        <div class="form-group">
            <label for="file">Tài liệu (link)</label>
            <div class="file-upload-container">
                <div class="form-group">
                    <input type="url" name="file_url" class="form-control" placeholder="Nhập URL tài liệu">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="uploaded_by">Người tải</label>
                <input type="text" class="form-control" value="{{ Auth::user()->fullname }}" readonly>
        </div>
    
        <div class="form-footer">
            <button type="submit" class="save-btn">Lưu</button>
        </div>
    </form>
    
</div>

<div class="form-container" id="addFormQuiz">
    <button class="closebtn" onclick="toggleFormQuiz()">X</button>
    <h2 class="text-center">THÊM BÀI THI</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf

        <input type="hidden" name="course_id" value="{{ $course->id }}">
        <input type="hidden" name="uploaded_by" value="{{ auth()->id() }}">

        <div class="form-group">
            <label for="title">Tên bài thi</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="instructions">Hướng dẫn</label>
            <textarea name="instructions" class="form-control" rows="3" placeholder="Nhập hướng dẫn nếu có..."></textarea>
        </div>

        <div class="form-group">
            <label>Thời gian làm bài (phút)</label>
            <input type="number" name="time_limit" class="form-control" min="1" value="30" required>
        </div>

        <div class="form-group">
            <label>Điểm đạt (%)</label>
            <input type="number" name="passing_score" class="form-control" min="0" max="100" value="70" required>
        </div>

        <div class="form-group">
            <label>Số lần làm tối đa</label>
            <input type="number" name="max_attempts" class="form-control" min="1" value="1">
        </div>

        <div class="form-group d-flex align-items-center gap-2">
            <label>Xáo trộn câu hỏi?</label><br>
                <span class="d-flex align-items-center" style="margin-bottom: 6px; display: inline-block; width: 27px;">
                    <input style="padding: 6px" type="checkbox" class="form-check-input"
                        id="is_shuffle_questions" name="is_shuffle_questions">
                </span>
                <label class="form-check-label fw-bold" for="is_shuffle_questions" style="color: black; display: contents">Có</label>
        </div>

        <div class="form-group">
            <label>Thời gian mở bài thi</label>
            <input type="datetime-local" name="available_from" class="form-control">
        </div>

        <div class="form-group">
            <label>Thời gian đóng bài thi</label>
            <input type="datetime-local" name="available_to" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Tạo bài thi</button>
        <a href="{{ route('course.detail', $course->id) }}" class="btn btn-secondary">Quay lại</a>
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
</script>

<script>
    function toggleFormQuiz() {
        var form = document.getElementById("addFormQuiz");
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
</script>

<script>
    document.getElementById('edit-btn').addEventListener('click', function () {
        // Kích hoạt các input và textarea
        var inputs = document.querySelectorAll('#edit-form input:not([type=button]), #edit-form textarea, #edit-form select' );
        
        inputs.forEach(function(input) {
            input.disabled = false;
        });
    
        // Hiện nút Lưu
        document.getElementById('save-btn').style.display = 'inline-block';
        this.style.display = 'none';
    });

    document.getElementById('save-btn').addEventListener('click', function () {
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
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('file');
    const urlInput = document.querySelector('input[name="file_url"]');
    
    if (!fileInput.files.length && !urlInput.value.trim()) {
        e.preventDefault();
        alert('Vui lòng chọn file hoặc nhập URL tài liệu');
    }
});
</script>

