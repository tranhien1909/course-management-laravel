@include('backend.dashboard.home.style-table')
<style>
    .card {
        margin-bottom: 20px;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        justify-content: center;
    }

    .card-header {
        text-transform: uppercase;
        text-align: center;
        text-size: 30px;
        font-weight: bold;
        color: #0056b3;
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
        margin-left: 15px;
    }

    .button-container {}
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
                            <strong>Profile</strong>
                        </li>
                    </ol>
                </div>
            </div>

            {{-- User Profile  --}}
            <div class="col-lg-12">

                <div class="ibox-content card">

                    <div class="sidebar-sticky" style="margin-left: 20px;">
                        <h2 class="mt-3"><strong>Hello,
                                {{ Auth::check() ? Auth::user()->fullname : 'Khách' }}</strong> <img
                                src="https://www.svgrepo.com/show/433961/waving-hand.svg"
                                style="width: 35px; padding-bottom: 15px;" alt=""></h2>
                        <p>Nice to have you back, what an exciting day!</p>
                        <p>Get ready and continue your lesson today.</p>
                    </div>
                </div>


                <div class="ibox-content card" style="height: 420px;">
                    <h2 class="card-header">
                        Profile
                    </h2>

                    <form id="edit-form" method="POST" action="{{ route('student.update', Auth::user()->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Cột ảnh học viên -->
                        <div class="col-md-3">
                            <div class="thumbnail image-box">
                                <div class="image-actions">
                                    <span class="edit-icon"><i class="fa-solid fa-wrench"></i></span>
                                </div>
                                <input name="image" type="file" class="image-input" accept="image/*">
                                <img src="{{ Auth::check() ? Auth::user()->avatar : 'N/A' }}" alt="Ảnh Học Viên"
                                    class="img-responsive" style="width: 200px;">
                            </div>

                        </div>

                        <!-- Cột thông tin học viên -->
                        <div class="col-md-9">
                            <div class="row mb-10">
                                <div class="col-md-6">
                                    <label for="student_name">Họ và tên:</label>
                                    <input name="student_name" type="text" id="student_name" class="form-control"
                                        placeholder="Họ và tên"
                                        value="{{ Auth::check() ? Auth::user()->fullname : 'N/A' }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" class="form-control" placeholder="Email"
                                        value="{{ Auth::check() ? Auth::user()->email : 'N/A' }}" disabled readonly>
                                </div>
                            </div>

                            <div class="row mb-10">
                                <div class="col-md-6">
                                    <label for="birthday">Ngày sinh:</label>
                                    <input name="birthday" type="date" id="birthday" class="form-control"
                                        placeholder="Ngày sinh"
                                        value="{{ Auth::check() && Auth::user()->birthday ? date('Y-m-d', strtotime(Auth::user()->birthday)) : '' }}"
                                        disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">Số điện thoại:</label>
                                    <input name="phone" type="number" id="phone" class="form-control"
                                        placeholder="Phone" value="{{ Auth::check() ? Auth::user()->phone : 'N/A' }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row mb-10">
                                <div class="col-md-6">
                                    <label for="gender">Giới tính:</label>
                                    <select name="gender" id="gender" disabled style="width: 100%; height: 35px;">
                                        <option value="{{ Auth::user()->gender }}" selected>
                                            {{ Auth::user()->gender }}</option>
                                        @foreach (['Nam', 'Nữ'] as $gender)
                                            <option value="{{ $gender }}">
                                                {{ $gender }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="address">Địa chỉ:</label>
                                    <input name="address" type="text" id="address" class="form-control"
                                        placeholder="Address"
                                        value="{{ Auth::check() ? Auth::user()->address : 'N/A' }}" disabled>
                                </div>
                            </div>

                            <div class="row mb-10">
                                <div class="col-md-12 text-right">
                                    <div class="button-container" style="margin-top: 15px;">
                                        <button type="button" class="save-button  btn-success" id="edit-btn"
                                            style="padding: 2px 12px;">Sửa</button>
                                        <button type="submit" class="save-button  btn-success" id="save-btn"
                                            style="display:none; padding: 2px 12px;">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.querySelectorAll(".edit-icon").forEach((icon) => {
                icon.addEventListener("click", function() {
                    let imageInput = this.closest(".image-box").querySelector(".image-input");
                    imageInput.click();
                });
            });

            // Xem trước ảnh
            document.querySelectorAll(".image-input").forEach((input) => {
                input.addEventListener("change", function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.nextElementSibling.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });

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
