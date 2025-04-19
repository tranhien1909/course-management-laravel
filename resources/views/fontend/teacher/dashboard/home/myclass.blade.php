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
                        <li class="active">
                            <strong>Lớp học của tôi</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="filter-bar">

                <div class="search-container">
                    <form action="{{ route('teacher.class') }}" method="GET">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm kiếm theo mã hoặc tên lớp học" value="{{ request('search') }}">
                        <button type="submit" class="search-icon"
                            style="background-color: white; left: 8px; padding: 6px;"><i
                                class="fa-solid fa-magnifying-glass" style="color: #3b6db3;"></i></button>
                    </form>
                </div>
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
                                <th>Sĩ số</th>
                                <th>Trạng thái</th>
                                <th>Xem chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($classes) && is_object($classes))
                                @foreach ($classes as $index => $class)
                                    <tr class="course-row">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $class->id }}</td>
                                        <td>{{ $class->course->id ?? 'N/A' }}</td>
                                        <td>{{ $class->course->course_name ?? 'N/A' }}</td>
                                        <td>{{ date('d/m/Y', strtotime($class->start_date)) }}</td>
                                        <td>{{ $class->number_of_student }}</td>
                                        <td>{{ $class->status }}</td>
                                        <td>
                                            <a href="{{ route('myclass.detail', $class->id) }}" title="Xem chi tiết"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">Không có khóa học nào.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
