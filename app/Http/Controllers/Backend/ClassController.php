<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class ClassController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {
        // Load trước tất cả quan hệ cần thiết
        $classes = Classroom::with([
            'course:id,course_name',
            'user:id,fullname', // Chỉ lấy các trường cần thiết từ teacher
        ])->paginate(5);

        $template = 'backend.dashboard.home.qllophoc';
        return view('backend.dashboard.layout', compact('template', 'classes'));
    }

    public function detail($id)
    {
        $class = Classroom::findOrFail($id);
        $template = 'backend.dashboard.home.chitietlophoc';
        return view('backend.dashboard.layout', compact('template', 'class'));
    }

    public function exportPDF()
    {
        $classes = Classroom::all();
        $pdf = Pdf::loadView('exports.class_print', compact('classes'))
        ->setPaper('a4', 'portrait');

        return $pdf->download('danh_sach_lop_hoc.pdf');
    }
}
