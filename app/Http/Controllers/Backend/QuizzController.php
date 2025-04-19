<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Quizz;

class QuizzController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'instructions' => 'nullable|string',
            'time_limit' => 'required|integer|min:1',
            'passing_score' => 'required|integer|min:0|max:100',
            'max_attempts' => 'nullable|integer|min:1',
            'is_shuffle_questions' => 'nullable|boolean',
            'available_from' => 'nullable|date',
            'available_to' => 'nullable|date|after_or_equal:available_from',
        ]);

        try {
            $quiz = Quizz::create([
                'course_id' => $request->course_id,
                'title' => $request->title,
                'instructions' => $request->instructions,
                'time_limit' => $request->time_limit,
                'passing_score' => $request->passing_score ?? 70,
                'max_attempts' => $request->max_attempts ?? 1,
                'is_shuffle_questions' => $request->has('is_shuffle_questions'),
                'available_from' => $request->available_from,
                'available_to' => $request->available_to,
                'uploaded_by' => auth()->id(),
            ]);

            return redirect()->route('course.detail', $request->course_id)
                            ->with('success', 'Tạo bài thi thành công! Hãy thêm câu hỏi.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Lỗi khi thêm bài thi: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $quiz = Quizz::findOrFail($id);
        $quiz->delete();

        return back()->with('success', 'Đã xoá bài thi thành công!');
    }


}
