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
        // $this->middleware('auth');
        // $this->middleware('role:teacher');
        
    }

    public function index()
    {

        $template = 'fontend.teacher.dashboard.home.index';
        return view('fontend.teacher.dashboard.layout', compact('template'));

    }

    public function myClass()
    {
        $user = Auth::user();
        $classes = $user->classes()->with('course')->get(); // nếu muốn kèm khóa học liên quan
        $template = 'fontend.teacher.dashboard.home.myclass';
    
        return view('fontend.teacher.dashboard.layout', compact('template', 'classes'));

    }

    public function detail($id)
    {
        $user = Auth::user();
        // Lấy lớp học với các quan hệ cần thiết
        $class = Classroom::with(['classSchedules'])->findOrFail($id);
    
        $template = 'fontend.teacher.dashboard.home.chitietlophoc';
        return view('fontend.teacher.dashboard.layout', compact('template', 'class'));
    }
}
