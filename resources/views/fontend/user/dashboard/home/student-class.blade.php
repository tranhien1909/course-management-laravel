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
                            <strong>Lớp học của tôi</strong>
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
                                <th>Mã lớp học</th>
                                <th>Tên khoá học</th>
                                <th>Ngày khai giảng</th>
                                <th>Ngày kết thúc</th>
                                <th>Sĩ số</th>
                                <th>Phòng học</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $index => $enrollment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $enrollment->class->id }}</td>
                                    <td>{{ $enrollment->class->course->course_name ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($enrollment->class->start_date)->format('d/m/Y') }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($enrollment->class->end_date)->format('d/m/Y') }}</td>
                                    <td>{{ $enrollment->class->number_of_student }}</td>
                                    <td>
                                        @php
                                            $rooms = $enrollment->class->classSchedules
                                                ->pluck('room')
                                                ->unique()
                                                ->filter()
                                                ->implode(', ');
                                        @endphp
                                        {{ $rooms ?: 'Chưa xếp lịch' }}
                                    </td>
                                    <td>
                                        @php
                                            $status = $enrollment->status;
                                            $label = match ($status) {
                                                'pending' => 'Chờ duyệt',
                                                'active' => 'Đang học',
                                                'completed' => 'Hoàn thành',
                                                'cancelled' => 'Huỷ',
                                            };
                                        @endphp
                                        {{ $label }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
