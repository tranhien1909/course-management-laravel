<?php

namespace App\Http\Controllers\Frontend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Classroom;

class TeacherDashboardController extends Controller
{
    public function __construct()
    {

        
    }

    public function store(Request $request)
{
    $scheduleId = $request->input('schedule_id');
    $attendances = $request->input('attendance', []);

    foreach ($attendances as $studentId => $data) {
        Attendance::updateOrCreate(
            [
                'student_id' => $studentId,
                'schedule_id' => $scheduleId,
            ],
            [
                'status' => $data['status'],
                'notes' => $data['notes'] ?? null,
            ]
        );
    }

    return back()->with('success', 'Điểm danh đã được lưu!');
}



}
