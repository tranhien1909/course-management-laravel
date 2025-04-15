@php
    use Carbon\Carbon;

    // Nếu có biến $weekStart từ controller thì dùng, nếu không thì lấy từ request
    $weekStart = isset($weekStart)
        ? Carbon::parse($weekStart)
        : Carbon::parse(request('date', now()))->startOfWeek(Carbon::MONDAY);

    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    $weekDates = collect($daysOfWeek)->map(function ($day, $i) use ($weekStart) {
        return $weekStart->copy()->addDays($i);
    });

    function isMorning($time)
    {
        return Carbon::parse($time)->format('H:i') < '12:00';
    }
@endphp

<table class="schedule-table">
    <thead>
        <tr>
            <th>Buổi</th>
            @foreach ($weekDates as $date)
                <th>{{ $date->translatedFormat('l') }}<br>
                    {{ $date->format('d/m/Y') }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach (['Sáng', 'Chiều'] as $period)
            <tr>
                <td>{{ $period }}</td>
                @foreach ($weekDates as $date)
                    <td>
                        @foreach ($classSchedules as $schedule)
                            @php
                                $dayMatch = $schedule->day_of_week === $date->englishDayOfWeek;
                                $isMorningSession = isMorning($schedule->start_time);
                                $showInThisCell =
                                    ($period == 'Sáng' && $isMorningSession) ||
                                    ($period == 'Chiều' && !$isMorningSession);
                            @endphp

                            @if ($dayMatch && $showInThisCell)
                                <div class="schedule-box green">
                                    <strong>{{ $schedule->class_id ?? '---' }}</strong><br>
                                    {{ Carbon::parse($schedule->start_time)->format('H:i') }} -
                                    {{ Carbon::parse($schedule->end_time)->format('H:i') }}<br>
                                    Phòng: {{ $schedule->room ?? 'Online' }}<br>
                                    GV: {{ $schedule->class->user->fullname ?? '---' }}
                                </div>
                            @endif
                        @endforeach
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
