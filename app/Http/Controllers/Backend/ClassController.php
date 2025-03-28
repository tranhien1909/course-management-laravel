<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;

class ClassController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {
        // Lấy tất cả các khóa học
        $classes = Classroom::paginate(10);
        // $classes = Classroom::with('teacherUser')->get();

        $template = 'backend.dashboard.home.qllophoc';
        return view('backend.dashboard.layout', compact('template', 'classes'));
    }

    public function detail() {
        $template = 'backend.dashboard.home.chitietlophoc';
        return view('backend.dashboard.layout', compact('template'));
    }
}
