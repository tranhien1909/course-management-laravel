<?php

namespace App\Http\Controllers\Frontend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGrade;
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
            // Tính điểm TB riêng cho từng học viên
            $grades = collect([
                $data['grade_1'] ?? null,
                $data['grade_2'] ?? null,
                $data['grade_3'] ?? null
            ])->filter(fn($grade) => $grade !== null);
    
            $finalGrade = $grades->count() === 3 ? round($grades->avg(), 2) : null;
    
            StudentGrade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'class_id' => $classId
                ],
                [
                    'grade_1' => $data['grade_1'] ?? null,
                    'grade_2' => $data['grade_2'] ?? null,
                    'grade_3' => $data['grade_3'] ?? null,
                    'final_grade' => $finalGrade,
                    'note' => $data['note'] ?? null,
                ]
            );
        }
    
        return redirect()->back()->with('success', 'Đã lưu điểm thành công!');
    }
    
}
