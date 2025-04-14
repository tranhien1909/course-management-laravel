@include('backend.dashboard.home.style-table')

<style>
    .table-responsive {
        margin-top: 30px;

    }

    .course-img {
        width: 140px;
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
                            <strong>QL Khoá học</strong>
                        </li>
                        <h3 style="font-size: 18px; margin-top: 20px">DANH SÁCH KHÓA HỌC</h3>
                    </ol>
                </div>
            </div>
            <div class="filter-bar">
                <a href="{{ route('courseExport.pdf') }}"><button>Export</button></a>

                <div class="search-container">
                    <form action="{{ route('course.index') }}" method="GET">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm kiếm theo mã hoặc tên khoá học" value="{{ request('search') }}">
                        <button type="submit" class="search-icon"
                            style="background-color: white; left: 8px; padding: 6px;"><i
                                class="fa-solid fa-magnifying-glass" style="color: #3b6db3;"></i></button>
                    </form>
                </div>

                <button class="add-btn" onclick="toggleForm()">+ Thêm Khoá học</button>
            </div>

            <div class="ibox-content">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã khóa học</th>
                                <th>Ảnh khóa học</th>
                                <th>Tên khóa học</th>
                                <th>Level</th>
                                <th>Số buổi học</th>
                                <th>Học phí</th>
                                <th>Trạng thái</th>
                                <th colspan="2">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($courses) && is_object($courses))
                                @foreach ($courses as $index => $course)
                                    <tr class="course-row">
                                        <td>{{ ($courses->currentPage() - 1) * $courses->perPage() + $index + 1 }}</td>
                                        <td>{{ $course->id }}</td>
                                        <td><img src="{{ $course->image }}" class='course-img' alt='Ảnh khóa học'></td>
                                        <td>{{ $course->course_name }}</td>
                                        <td>{{ $course->level }}</td>
                                        <td>{{ $course->lessons }}</td>
                                        <td>{{ number_format($course->price, 0, ',', '.') }} đ</td>
                                        <td>{{ $course->status }}</td>
                                        <td style="padding: 1px 24px;">
                                            <a href="{{ route('course.detail', $course->id) }}" title="Xem chi tiết"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('course.destroy', $course->id) }}" method="POST"
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
                                    <td colspan="10">Không có khóa học nào.</td>
                                </tr>
                            @endif

                            @if (isset($courses))
                                <tr>
                                    <td colspan="11">
                                        {{ $courses->links('pagination::bootstrap-4') }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="form-container" id="addForm">
            <button class="closebtn" onclick="toggleForm()">X</button>
            <h2 class="text-center">THÊM KHÓA HỌC</h2>
            {{-- Hiển thị thông báo thành công --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('course.store') }}" enctype="multipart/form-data" id="courseForm">
                @csrf
                <div class="avatar">
                    <div>
                        <input type="file" name="avatar" class="image-input" accept="image/*" id="fileInput">
                        <img src="https://thudaumot.binhduong.gov.vn/Portals/0/images/default.jpg" class="img-avatar"
                            id="avatarImage">
                    </div>
                </div>
                <div class="store">
                    <label>Mã khóa học: <span class="text-danger">(*)</span></label>
                    <input type="text" name="id" value="{{ old('id') }}" required>

                    <label>Tên khóa học: <span class="text-danger">(*)</span></label>
                    <input type="text" name="course_name" value="{{ old('course_name') }}" required>

                    <label>Mức độ:</label>
                    <select name="level" id="level" required>
                        <option value="" disabled selected>Chọn mức độ</option>
                        @foreach (['A1', 'A2', 'B1', 'B2', 'C1', 'C2'] as $level)
                            <option value="{{ $level }}" {{ old('level') == $level ? 'selected' : '' }}>
                                {{ $level }}
                            </option>
                        @endforeach
                    </select>

                    <label>Số buổi học: <span class="text-danger">(*)</span></label>
                    <input type="number" name="lessons" value="{{ old('lessons') }}" required>

                    <label>Mô tả:</label>
                    <textarea name="description" value="{{ old('description') }}"></textarea>

                    <label>Học phí: <span class="text-danger">(*)</span></label>
                    <input type="text" name="price" value="{{ old('price') }}" required>

                    <div class="form-footer">
                        <button type="submit" class="save-btn">Lưu</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>

<script>
    // Handle image preview
    document.getElementById('fileInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarImage').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Make avatar image clickable
    document.getElementById('avatarImage').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });

    // Handle form submission
    document.getElementById('courseForm').addEventListener('submit', function(e) {
        // You can add any pre-submission logic here if needed
        console.log('Form submitted');
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

    document.getElementById('avatarImage').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });


    document.getElementById('fileInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarImage').src = e.target.result;

                // Tạo form data và upload ảnh
                const formData = new FormData();
                formData.append('image', file);

                fetch('/upload-temp-image', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('imagePath').value = data.path;
                    });
            }
            reader.readAsDataURL(file);
        }
    });

    // document.querySelector("#addCourseForm").addEventListener("submit", function(event) {
    //     event.preventDefault();
    //     let formData = new FormData(this);

    //     fetch("{{ route('course.store') }}", {
    //             method: "POST",
    //             headers: {
    //                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
    //             },
    //             body: formData
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             alert(data.success);
    //             location.reload(); // Reload trang sau khi thêm
    //         });
    // });

    // function deleteCourse(courseId) {
    //     if (!confirm("Bạn có chắc muốn xóa khóa học này?")) return;

    //     const formData = new FormData();
    //     formData.append('_method', 'DELETE');
    //     formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

    //     fetch(`/management_laravel/CourseManagement/public/course_management/${courseId}`, {
    //             method: 'POST',
    //             body: formData
    //         })
    //         .then(response => {
    //             if (!response.ok) {
    //                 return response.text().then(text => {
    //                     throw new Error(text || 'Request thất bại');
    //                 });
    //             }
    //             return response.json();
    //         })
    //         .then(data => {
    //             alert(data.success || 'Xóa thành công!');
    //             location.reload();
    //         })
    //         .catch(error => {
    //             console.error('Lỗi:', error);
    //             alert("Không thể xoá khoá học. Vui lòng thử lại.");
    //         });
    // }
</script>

<script>
    $(document).ready(function() {
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();

            if (!confirm('Bạn có chắc chắn muốn xoá khoá học này?')) {
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
