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
                            <a href="{{ route('student.dashboard') }}">Trang chủ</a>
                        </li>
                        <li class="active">
                            <strong>Công nợ</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="filter-bar">

                <div class="search-container">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" placeholder="Nhập tên hoặc mã học cần tìm ...">
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã lớp học</th>
                                <th>Tên lớp học</th>
                                <th>Học phí ban đầu</th>
                                <th>Miễn giảm</th>
                                <th>Mức nộp</th>
                                <th>Ngày nộp</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>IIG01</td>
                                <td>Toeic Mất Gốc</td>
                                <td>1.200.000</td>
                                <td>120.000</td>
                                <td>1.080.000</td>
                                <td>02/03/2025</td>
                                <td>Đã duyệt</td>
                            </tr>
                            {{-- @if (isset($classes) && is_object($classes))
                                @foreach ($classes as $index => $class)
                                    <tr class="course-row">
                                        <td><input type='checkbox' class='row-checkbox'></td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $class->id }}</td>
                                        <td>{{ $class->class_name }}</td>
                                        <td>{{ date('d/m/Y', strtotime($class->start_date)) }}</td>
                                        <td>{{ date('d/m/Y', strtotime($class->end_date)) }}</td>
                                        <td></td> --}}
                            {{-- <td>{{ $class->teacherUser->fullname ?? 'N/A' }}</td> --}}
                            {{-- <td>{{ $class->number_of_student }}</td>
                                        <td>{{ $class->room }}</td>
                                        <td>{{ $class->status }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">Không có khóa học nào.</td>
                                </tr>
                            @endif --}}
                        </tbody>
                    </table>
                    {{-- {{ $classes->links('pagination::bootstrap-4') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
