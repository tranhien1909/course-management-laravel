@include('backend.dashboard.home.style-table')

<style>
    .ibox-content {
        position: relative;
    }

    /* Căn hai nút Sửa và Xóa về bên phải */
    .action-buttons {
        position: absolute;
        right: 23px;
        top: 20px;
        /* Điều chỉnh khoảng cách với bảng */
        display: flex;
        gap: 15px;
    }

    .table-responsive {
        margin-top: 65px;

    }

    .course-img {
        width: 140px;
    }

    /* Style cho nút */
    .btn-edit,
    .btn-delete {
        padding: 6px 12px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        border-radius: 5px;
    }

    .btn-edit:disabled,
    .btn-delete:disabled {
        background-color: #ccc;
        color: #888;
        cursor: not-allowed;
    }

    .btn-edit,
    .btn-delete {
        background: #3b6db3;
        color: white;
        font-size: 14px;
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
                            <a href="{{ route('dashboard.index') }}">Trang chủ</a>
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

                <select>
                    <option>Đang diễn ra</option>
                    <option>Sắp khai giảng</option>
                    <option>Đã kết thúc</option>
                </select>
                <select>
                    <option disabled>Mức độ</option>
                    <option>Lớp 1</option>
                    <option>Người đi làm</option>
                </select>
                <div class="search-container">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" placeholder="Nhập tên khóa học cần tìm ...">
                </div>

                <button class="add-btn" onclick="toggleForm()">+ Thêm Khoá học</button>
            </div>

            <div class="ibox-content">
                <div class="action-buttons">
                    <button class="btn-edit">Xem chi tiết</button>
                    <button class="btn-delete">Xóa</button>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>STT</th>
                                <th>Mã khóa học</th>
                                <th>Ảnh khóa học</th>
                                <th>Tên khóa học</th>
                                <th>Level</th>
                                <th>Số buổi học</th>
                                <th>Học phí</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($courses) && is_object($courses))
                                @foreach ($courses as $index => $course)
                                    <tr class="course-row">
                                        <td><input type='checkbox' class='row-checkbox'></td>
                                        <td>{{ ($courses->currentPage() - 1) * $courses->perPage() + $index + 1 }}</td>
                                        <td>{{ $course->id }}</td>
                                        <td><img src="{{ $course->image }}" class='course-img' alt='Ảnh khóa học'></td>
                                        <td>{{ $course->course_name }}</td>
                                        <td>{{ $course->level }}</td>
                                        <td>{{ $course->lessons }}</td>
                                        <td>{{ number_format($course->price, 0, ',', '.') }} đ</td>
                                        <td>{{ $course->status }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">Không có khóa học nào.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $courses->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Các trường hiện có -->
            <div class="form-container" id="addForm">
                <button class="closebtn" onclick="toggleForm()">X</button>
                <h2 class="text-center">THÊM KHÓA HỌC</h2>
                <div class="avatar">
                    <div>
                        <input type="file" class="image-input" accept="image/*" id="fileInput">
                        <img src="https://thudaumot.binhduong.gov.vn/Portals/0/images/default.jpg" class="img-avatar"
                            id="avatarImage">
                    </div>
                </div>
                <form>
                    <label>Mã khóa học:</label>
                    <input type="text" name="id" required>

                    <label>Tên khóa học:</label>
                    <input type="text" name="course_name" required>

                    <label>Mức độ:</label>
                    <select name="level" required>
                        <option value="A1">A1</option>
                        <option value="B1">B1</option>
                        <option value="C1">C1</option>
                    </select>

                    <label>Số buổi học:</label>
                    <input type="number" name="lessons" required>

                    <label>Mô tả:</label>
                    <textarea name="description"></textarea>

                    <label>Học phí:</label>
                    <input type="text" name="price" required>

                    <div class="form-footer">
                        <button type="submit" class="save-btn">Lưu</button>
                    </div>

                    <!-- Thêm trường ảnh ẩn để lưu path -->
                    <input type="hidden" name="image" id="imagePath">
                </form>
            </div>
        </form>
    </div>

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

    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll(".row-checkbox");
        const btnEdit = document.querySelector(".btn-edit");
        const btnDelete = document.querySelector(".btn-delete");
        const selectAll = document.getElementById("select-all");

        function updateButtons() {
            let checkedCheckboxes = document.querySelectorAll(".row-checkbox:checked");
            let checkedCount = checkedCheckboxes.length;

            // Vô hiệu hóa hoặc kích hoạt nút
            btnEdit.disabled = checkedCount !== 1;
            btnDelete.disabled = checkedCount === 0;

            // Cập nhật màu sắc của hàng
            checkboxes.forEach(checkbox => {
                let row = checkbox.closest("tr");
                if (checkbox.checked) {
                    row.classList.add("selected");
                } else {
                    row.classList.remove("selected");
                }
            });
        }

        // Đảm bảo tất cả checkbox đều bỏ chọn khi load trang
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        // Gán sự kiện change cho từng checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", updateButtons);
        });

        // Xử lý khi nhấn vào "Chọn tất cả"
        if (selectAll) {
            selectAll.checked = false; // Đảm bảo checkbox "Chọn tất cả" không được chọn khi tải trang
            selectAll.addEventListener("change", function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateButtons();
            });
        }

        // Gọi updateButtons() để vô hiệu hóa nút ngay khi trang tải xong
        updateButtons();
    });

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

    document.querySelector("#addCourseForm").addEventListener("submit", function(event) {
        event.preventDefault();
        let formData = new FormData(this);

        fetch("{{ route('courses.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.success);
                location.reload(); // Reload trang sau khi thêm
            });
    });

    function deleteCourse(courseId) {
        if (!confirm("Bạn có chắc muốn xóa khóa học này?")) return;

        fetch(`/courses/${courseId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.success);
                location.reload();
            });
    }

    document.addEventListener("DOMContentLoaded", function() {
        const checkboxes = document.querySelectorAll(".row-checkbox");
        const btnEdit = document.querySelector(".btn-edit");
        let selectedCourseId = null;

        function updateButtons() {
            let checkedCheckboxes = document.querySelectorAll(".row-checkbox:checked");

            if (checkedCheckboxes.length === 1) {
                btnEdit.disabled = false;
                selectedCourseId = checkedCheckboxes[0].closest("tr").dataset.id; // Lấy ID khóa học
            } else {
                btnEdit.disabled = true;
                selectedCourseId = null;
            }
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", updateButtons);
        });

        btnEdit.addEventListener("click", function() {
            if (selectedCourseId) {
                window.location.href = `/courses/${selectedCourseId}`;
            }
        });
    });
</script>
