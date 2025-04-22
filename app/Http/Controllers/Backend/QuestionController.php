<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Quizz;
use App\Models\Question;
use App\Models\Option;



class QuestionController extends Controller
{
    public function create($quizId)
    {
        $thongKe = [
            'thong_bao' => DB::table('notifications')->count(),
        ];
        $quiz = Quizz::findOrFail($quizId);
        $template = 'backend.dashboard.home.taobaithi';

        return view('backend.dashboard.layout', compact('template', 'thongKe', 'quiz'));
    }
    
    public function store(Request $request, $quizId)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,true_false,short_answer,essay',
            'points' => 'required|numeric|min:0',
            'explanation' => 'nullable|string',
            'options' => 'nullable|array',
            'options.*.option_text' => 'required_with:options|string',
        ]);
    
        // 1. Tạo câu hỏi
        $question = Question::create([
            'quiz_id' => $quizId,
            'question_text' => $validated['question_text'],
            'question_type' => $validated['question_type'],
            'points' => $validated['points'],
            'explanation' => $validated['explanation'] ?? null,
            'order' => 0,
        ]);
    
        // 2. Nếu là multiple_choice hoặc true_false thì tạo options
        if (in_array($validated['question_type'], ['multiple_choice', 'true_false'])) {
            foreach ($request->input('options', []) as $index => $option) {
                if (trim($option['option_text']) !== '') {
                    $question->options()->create([
                        'option_text' => $option['option_text'],
                        'is_correct' => isset($option['is_correct']),
                        'order' => $index,
                    ]);
                }
            }
        }
    
        return redirect()->back()->with('success', 'Đã thêm câu hỏi thành công!');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);

        // Tự động xóa options nhờ onDelete('cascade') trong migration
        $question->delete();

        return redirect()->back()->with('success', 'Đã xoá câu hỏi thành công!');
    }

    

}
