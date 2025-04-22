<?php

namespace App\Http\Controllers\Frontend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function __construct()
    {

        
    }

    public function store(Request $request)
    {
        $classId = $request->input('class_id');
        $date = $request->input('date');
        $data = $request->input('attendance', []);
    
        foreach ($data as $studentId => $info) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'class_id' => $classId,
                    'date' => $date,
                ],
                [
                    'present' => isset($info['present']) ? 1 : 0,
                    'note' => $info['note'] ?? null,
                ]
            );
        }
    
        return back()->with('success', 'Điểm danh thành công!');
    }



}
