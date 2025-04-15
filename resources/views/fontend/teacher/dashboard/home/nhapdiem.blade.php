@include('backend.dashboard.home.style-table')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="overlay" id="overlay" onclick="toggleForm()"></div>
        <div class="ibox float-e-margins">
            <div class="row wrapper border-bottom white-bg page-heading"
                style="margin-left: -9px; margin-bottom: 20px; position: relative;">
                <div class="col-lg-10">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('teacher.dashboard') }}">Trang chủ</a>
                        </li>
                        <li>
                            <a href="{{ route('teacher.index') }}">CL004</a>
                        </li>
                        <li class="active">
                            <strong>Bài kiểm tra 15'</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="ibox-content">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã học viên</th>
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Điểm</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
