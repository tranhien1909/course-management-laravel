<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Payment;
use App\Models\Course;

class ScheduleController extends Controller
{
    public function __construct()
    {
        
    }

    public function loadWeek(Request $request)
    {
        $selectedDate = Carbon::parse($request->get('date', now()));
        $classId = $request->get('class_id');
        $weekStart = $selectedDate->copy()->startOfWeek(Carbon::MONDAY);
    
        $classSchedules = ClassSchedule::with(['class.course', 'class.user'])
            ->where('class_id', $classId)
            ->get();
    
        $html = view('backend.dashboard.component.weekly_schedule', [
            'classSchedules' => $classSchedules,
            'weekStart' => $weekStart
        ])->render();
    
        return response()->json(['html' => $html]);
    }

    public function loadTeacherWeek(Request $request)
{
    $selectedDate = Carbon::parse($request->get('date', now()));
    $teacherId = $request->get('teacher_id');
    $weekStart = $selectedDate->copy()->startOfWeek(Carbon::MONDAY);

    $classSchedules = ClassSchedule::with(['class.course', 'class.user'])
        ->whereHas('class', function ($query) use ($teacherId) {
            $query->where('user_id', $teacherId);
        })
        ->get();

    $html = view('backend.dashboard.component.weekly_schedule', [
        'classSchedules' => $classSchedules,
        'weekStart' => $weekStart
    ])->render();

    return response()->json(['html' => $html]);
}

    

}
