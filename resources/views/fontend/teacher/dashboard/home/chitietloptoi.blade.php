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

    input,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 15px;
    }

    input[type="text"],
    input[type="file"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .file-upload {
        border: 2px dashed #ccc;
        padding: 20px;
        text-align: center;
        border-radius: 4px;
        background-color: #f9f9f9;
        margin-bottom: 10px;
    }

    .file-upload:hover {
        border-color: #999;
    }

    .btn {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #2980b9;
    }

    .file-info {
        font-size: 14px;
        color: #666;
        margin-top: 5px;
    }

    .required {
        color: #e74c3c;
    }
</style>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="overlay" id="overlay" onclick="toggleForm()" onclick="toggleFormQuizz()"></div>
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
                <div class="tab-item active" data-tab="tab1">Danh sách học viên</div>
                <div class="tab-item" data-tab="tab2">Tài liệu học tập</div>
                <div class="tab-item" data-tab="tab3">Bài thi</div>
                <div class="tab-item" data-tab="tab4">Điểm danh</div>
                <div class="tab-item" data-tab="tab5">Nhập điểm</div>
            </div>

            <div class="tab-content-container">
                <div id="tab1" class="tab-content active">

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
                                    <th>Thao tác</th>
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
                                            <td>
                                                <a href="{{ route('student.detail', $user->id) }}"
                                                    title="Kết quả học tập">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
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
                <div id="tab2" class="tab-content">
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
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($class->course->courseMaterials->count() > 0)
                                        @foreach ($class->course->courseMaterials as $material)
                                            @php
                                                $teacher = $material->teacher;
                                                $user = $teacher ? $teacher->user : null; // Kiểm tra nếu có giáo viên phụ trách
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{-- <a href="{{ Str::startsWith($material->file_url, 'http') ? $material->file_url : asset('storage/' . $material->file_url) }}"
                                                        target="_blank">
                                                        {{ $material->title }}
                                                    </a> --}}
                                                    <strong>{{ $material->title }}</strong> -
                                                    <a href="{{ asset($material->file_url) }}" target="_blank">Xem tài
                                                        liệu</a>
                                                </td>
                                                <td>{{ $class->user->fullname ?? 'N/A' }}</td>
                                                <td>{{ $material->created_at->format('d/m/Y') }}</td>
                                                <td>Đã duyệt</td>
                                                <td>
                                                    <a href="#"><i class="fas fa-trash text-danger"
                                                            title="Xoá"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">Chưa có tài liệu</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>
                <div id="tab3" class="tab-content">
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
                                    <th colspan="3">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($class->course->quizzes->count() > 0)
                                    @foreach ($class->course->quizzes as $index => $quizz)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $quizz->course_id }}</td>
                                            <td>{{ $quizz->title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($quizz->available_from)->format('d/m/Y') }}
                                            </td>
                                            <td>{{ $quizz->user->fullname ?? 'N/A' }}</td>
                                            <td style="padding: 1px 24px;">
                                                <a href="{{ route('questions.create', $quizz->id) }}"
                                                    title="Tạo câu hỏi"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </td>
                                            <td>
                                                <form action="#" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0"
                                                        style="border: none;" title="Xoá">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('grades.input', $quizz->id) }}" title="Nhập điểm">
                                                    <i class="fa-solid fa-clipboard-check text-success"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">Chưa có bài thi</td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
                <div id="tab4" class="tab-content">
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('attendance.store') }}">
                            @csrf
                            <input type="hidden" name="class_id" value="{{ $class->id }}">
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control mb-3"
                                required>

                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã học viên</th>
                                        <th>Họ tên</th>
                                        <th>Có mặt</th>
                                        <th>Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($class->enrollments as $index => $enrollment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $enrollment->student->student_id }}</td>
                                            <td>{{ $enrollment->student->fullname }}</td>
                                            <td>
                                                <input type="checkbox"
                                                    name="attendance[{{ $enrollment->student->id }}][present]"
                                                    value="1">
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="attendance[{{ $enrollment->student->id }}][note]"
                                                    class="form-control">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Lưu điểm
                                danh</button>
                        </form>

                    </div>
                </div>
                <div id="tab5" class="tab-content">
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

                            <div class="text-center" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-primary">Lưu điểm</button>
                            </div>
                        </form>

                    </div>
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
        <input type="hidden" name="course_id" value="{{ $class->course_id }}">
        <input type="hidden" name="uploaded_by" value="{{ Auth::user()->id }}">


        <div class="form-group">
            <label for="title">Tên tài liệu</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="file">Tải lên tài liệu <span class="required">*</span></label>
            <div class="file-upload-container">
                <div class="file-upload">
                    <input type="file" id="file" name="file" required>
                    <p>Kéo thả file vào đây hoặc click để chọn file</p>
                    <p class="file-info">Hỗ trợ định dạng: PDF, DOCX, PPTX, XLSX, ZIP (Tối đa 50MB)</p>
                </div>
                <div class="or-separator">HOẶC</div>
                <div class="form-group">
                    <input type="url" name="file_url" class="form-control" placeholder="Nhập URL tài liệu">
                </div>
            </div>
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

        <input type="hidden" name="course_id" value="{{ $class->course_id }}">
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
            <input type="number" name="passing_score" class="form-control" min="0" max="100"
                value="70" required>
        </div>

        <div class="form-group">
            <label>Số lần làm tối đa</label>
            <input type="number" name="max_attempts" class="form-control" min="1" value="1">
        </div>

        <div class="form-group d-flex align-items-center gap-2">
            <label>Xáo trộn câu hỏi?</label><br>
            <span class="d-flex align-items-center" style="margin-bottom: 6px; display: inline-block; width: 27px;">
                <input style="padding: 6px" type="checkbox" class="form-check-input" id="is_shuffle_questions"
                    name="is_shuffle_questions">
            </span>
            <label class="form-check-label fw-bold" for="is_shuffle_questions"
                style="color: black; display: contents">Có</label>
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
    </form>
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
    document.querySelector('form').addEventListener('submit', function(e) {
        const fileInput = document.getElementById('file');
        const urlInput = document.querySelector('input[name="file_url"]');

        if (!fileInput.files.length && !urlInput.value.trim()) {
            e.preventDefault();
            alert('Vui lòng chọn file hoặc nhập URL tài liệu');
        }
    });
</script>

<script>
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Xử lý upload file ở đây
        alert('Tài liệu đã được tải lên thành công!');
    });

    // Hiển thị tên file khi chọn
    document.getElementById('file').addEventListener('change', function(e) {
        if (this.files.length > 0) {
            const fileName = this.files[0].name;
            const fileInfo = document.querySelector('.file-info');
            fileInfo.innerHTML =
                `File đã chọn: <strong>${fileName}</strong> (${formatFileSize(this.files[0].size)})`;
        }
    });

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
</script>
