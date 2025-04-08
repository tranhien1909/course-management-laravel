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

            <div class="filter-bar">
                <a href="{{ route('classExport.pdf') }}"><button>Export</button></a>
                <select>
                    <option disabled>Lọc</option>
                    <option>Đang diễn ra</option>
                    <option>Sắp khai giảng</option>
                </select>

                <div class="search-container">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" placeholder="Nhập tên hoặc mã cần tìm ...">
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
                                <th>Tên khoá học</th>
                                <th>Ngày khai giảng</th>
                                <th>Giáo viên phụ trách</th>
                                <th>Sĩ số</th>
                                <th>Phòng học</th>
                                <th>Trạng thái</th>
                                <th colspan="2">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($classes) && is_object($classes))
                                @foreach ($classes as $index => $class)
                                    <tr class="course-row">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $class->id }}</td>
                                        <td>{{ $class->course->course_name ?? 'N/A' }}</td>
                                        <td>{{ date('d/m/Y', strtotime($class->start_date)) }}</td>
                                        <td>{{ $class->user->fullname ?? 'N/A' }}</td>
                                        <td>{{ $class->number_of_student }}</td>
                                        <td><a href="{{ $class->room }}" target="_blank">{{ $class->room }} </a></td>
                                        <td>{{ $class->status }}</td>
                                        <td>
                                            <a href="{{ route('class.detail', $class->id) }}" title="Xem chi tiết"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td>
                                            <a href=""><i class="fa-solid fa-trash" title="Xoá"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="11">Không có khóa học nào.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $classes->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-container" id="addForm">
    <button class="closebtn" onclick="toggleForm()">X</button>
    <h2 class="text-center">THÊM LỚP HỌC</h2>
    <form>
        <label>Mã lớp học:</label>
        <input type="text" name="id_class" required>

        <label>Tên khóa học:</label>
        <input type="text" name="name_course" required>

        <label>Giảng viên phụ trách:</label>
        <input type="text" name="name_teacher" required>

        <label>Ngày khai giảng</label>
        <input type="date" name="date_start" required>

        <label>Phòng học</label>
        <input type="text" name="room" required>

        <label>Ghi chú</label>
        <textarea name="ghi_chu"></textarea>

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
