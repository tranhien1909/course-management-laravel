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
</style>


<div class="wrapper wrapper-content">
    <div class="row">
        <div class="overlay" id="overlay" onclick="toggleForm()"></div>
        <div class="ibox float-e-margins">

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


                <div class="ibox-content card" style="height: 620px;">
                    <h2 class="card-header">
                        Frofile
                    </h2>

                    <!-- Cột ảnh học viên -->
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="{{ Auth::check() ? Auth::user()->avatar : 'N/A' }}" alt="Ảnh Học Viên"
                                class="img-responsive" style="width: 200px;">
                        </div>
                        <button
                            class="btn btn-default btn-block mb-10">{{ Auth::check() ? Auth::user()->student_id : 'N/A' }}</button>
                    </div>

                    <!-- Cột thông tin học viên -->
                    <div class="col-md-9">
                        <div class="row mb-10">
                            <div class="col-md-6">
                                <label for="student_name">Họ và tên:</label>
                                <input type="text" id="student_name" class="form-control" placeholder="Họ và tên"
                                    value="{{ Auth::check() ? Auth::user()->fullname : 'N/A' }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email:</label>
                                <input type="email" id="email" class="form-control" placeholder="Email"
                                    value="{{ Auth::check() ? Auth::user()->email : 'N/A' }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-10">
                            <div class="col-md-6">
                                <label for="birthday">Ngày sinh:</label>
                                <input type="date" id="birthday" class="form-control" placeholder="Ngày sinh"
                                    value="{{ Auth::check() && Auth::user()->birthday ? date('Y-m-d', strtotime(Auth::user()->birthday)) : '' }}"
                                    disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Số điện thoại:</label>
                                <input type="number" id="phone" class="form-control" placeholder="Phone"
                                    value="{{ Auth::check() ? Auth::user()->phone : 'N/A' }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-10">
                            <div class="col-md-6">
                                <label for="gender">Giới tính:</label>
                                <input type="text" id="gender" class="form-control" placeholder="Giới tính"
                                    value="{{ Auth::check() ? Auth::user()->gender : 'N/A' }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="address">Địa chỉ:</label>
                                <input type="text" id="address" class="form-control" placeholder="Address"
                                    value="{{ Auth::check() ? Auth::user()->address : 'N/A' }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-10">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-success" style="margin-top: 30px;">Sửa</button>
                            </div>
                        </div>

                    </div>

                </div>


            </div>
        </div>
