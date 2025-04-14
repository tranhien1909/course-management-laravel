<h3>Điểm danh buổi: {{ $classSchedules->day_of_week }} - {{ $classSchedules->start_time }} -
    {{ $classSchedules->end_time }}</h3>

<form method="POST" action="{{ route('attendance.store') }}">
    @csrf
    <input type="hidden" name="schedule_id" value="{{ $classSchedules->id }}">

    <table>
        <thead>
            <tr>
                <th>Học viên</th>
                <th>Trạng thái</th>
                <th>Ghi chú</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($class->enrollments as $enrollment)
                @php $student = $enrollment->student; @endphp
                <tr>
                    <td>{{ $student->fullname }}</td>
                    <td>
                        <select name="attendance[{{ $student->id }}][status]">
                            <option value="present">Có mặt</option>
                            <option value="absent">Vắng</option>
                            <option value="late">Đi trễ</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="attendance[{{ $student->id }}][notes]"
                            placeholder="Ghi chú (nếu có)">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit">Lưu điểm danh</button>
</form>
