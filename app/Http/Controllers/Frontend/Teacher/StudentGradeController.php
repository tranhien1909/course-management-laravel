<?php

namespace App\Http\Controllers\Frontend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Quizz;

class StudentGradeController extends Controller
{

    public function inputForm($quizId)
    {
        $quiz = Quizz::with('course.classes.enrollments.student')->findOrFail($quizId);
        $template = 'fontend.teacher.dashboard.home.nhapdiem';

        return view('fontend.teacher.dashboard.layout', compact('template', 'quiz'));
    }

    public function store(Request $request)
    {
        $classId = $request->input('class_id');
        $gradesData = $request->input('grades');
    
        foreach ($gradesData as $studentId => $data) {
            StudentGrade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'class_id' => $classId
                ],
                [
                    'grade_1' => $data['grade_1'] ?? null,
                    'grade_2' => $data['grade_2'] ?? null,
                    'grade_3' => $data['grade_3'] ?? null,
                    'note' => $data['note'] ?? null,
                ]
            );
        }
    
        return redirect()->back()->with('success', 'Đã lưu điểm thành công!');
    }
    
}
