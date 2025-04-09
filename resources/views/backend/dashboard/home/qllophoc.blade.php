@include('backend.dashboard.home.style-table')

<style>
    .table-responsive {
        margin-top: 30px;

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
                            <strong>QL Lớp học</strong>
                        </li>
                        <h3 style="font-size: 18px; margin-top: 20px">DANH SÁCH LỚP HỌC</h3>
                    </ol>
                </div>
            </div>

            {{-- Hiển thị thông báo thành công --}}
            @if (session('success'))
                <script>
                    toastr.success('{{ session('success') }}');
                </script>
            @endif

            <div class="filter-bar">
                <a href="{{ route('classExport.pdf') }}"><button>Export</button></a>
                <select>
                    <option disabled>Lọc</option>
                    <option>Đang diễn ra</option>
                    <option>Sắp khai giảng</option>
                </select>

                <div class="search-container">
                    <form action="{{ route('class.index') }}" method="GET">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm kiếm theo mã hoặc tên khóa học" value="{{ request('search') }}">
                        <button type="submit" class="search-icon"
                            style="background-color: white; left: 8px; padding: 6px;"><i
                                class="fa-solid fa-magnifying-glass" style="color: #3b6db3;"></i></button>
                    </form>
                </div>

                <button class="add-btn" onclick="toggleForm()">+ Thêm Lớp học</button>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã lớp học</th>
                                <th>Mã khoá học</th>
                                <th>Tên khoá học</th>
                                <th>Ngày khai giảng</th>
                                <th>Giáo viên phụ trách</th>
                                <th>Sĩ số</th>
                                <th>Trạng thái</th>
                                <th colspan="2">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($classes) && is_object($classes))
                                @foreach ($classes as $index => $class)
                                    <tr class="course-row">
                                        <td>{{ ($classes->currentPage() - 1) * $classes->perPage() + $index + 1 }}</td>
                                        <td>{{ $class->id }}</td>
                                        <td>{{ $class->course->id ?? 'N/A' }}</td>
                                        <td>{{ $class->course->course_name ?? 'N/A' }}</td>
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
                                    <td colspan="11">Không có khóa học nào.</td>
                                </tr>
                            @endif

                            @if (isset($classes))
                                <tr>
                                    <td colspan="11">
                                        {{ $classes->links('pagination::bootstrap-4') }}
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
    <h2 class="text-center">THÊM LỚP HỌC</h2>


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('class.store') }}">
        @csrf
        <label for="class_id">Mã lớp học:</label>
        <input type="text" name="class_id" value="{{ old('class_id') }}" required>

        <label for="course_id">Mã khóa học:</label>
        <select name="course_id" id="course_id" required>
            <option value="" disabled selected>Chọn khoá học</option>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                    {{ $course->course_name }}</option>
            @endforeach
        </select>

        <label for="teacher_id">Giảng viên phụ trách:</label>
        <select name="teacher_id" id="teacher_id">
            <option value="" disabled selected>Chọn giáo viên</option>
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                    {{ $teacher->fullname }}</option>
            @endforeach
        </select>

        <label for="start_date">Ngày khai giảng</label>
        <input type="date" name="start_date" value="{{ old('start_date') }}" required>

        <label for="description">Mô tả:</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>

        <div class="form-footer">
            <button type="submit" class="save-btn">Lưu</button>
        </div>
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
    $(document).ready(function() {
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();

            if (!confirm('Bạn có chắc chắn muốn xoá lớp học này?')) {
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
