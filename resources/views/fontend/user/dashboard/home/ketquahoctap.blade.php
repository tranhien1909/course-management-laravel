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
                            <a href="{{ route('dashboard.index') }}">Trang chủ</a>
                        </li>
                        <li class="active">
                            <strong>Kết quả học tập</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="filter-bar">
                <select>
                    <option disabled>Lọc</option>
                    <option>Đang diễn ra</option>
                    <option>Đã kết thúc</option>
                </select>

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
                                <th rowspan="2">Mã lớp học</th>
                                <th rowspan="2">Tên lớp học</th>
                                <th rowspan="2">Chuyên cần</th>
                                <th colspan="3">Điểm kiểm tra</th>
                                <th rowspan="2">Điểm tổng kết</th>
                            </tr>

                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>IIG1</td>
                                <td>Tin cơ sở</td>
                                <td>10</td>
                                <td>2</td>
                                <td>6,00</td>
                                <td>7,00</td>
                                <td>7,00</td>
                            </tr>

                            <tr>
                                <td>IIG2</td>
                                <td>Logic học</td>
                                <td>9</td>
                                <td>2</td>
                                <td>6,00</td>
                                <td>7,00</td>
                                <td>7,00</td>
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
