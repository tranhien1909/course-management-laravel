<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Classroom;

class StudentDashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('role:student');
    }

    public function index()
    {

        $template = 'fontend.user.dashboard.home.index';
        return view('fontend.user.dashboard.layout', compact('template'));

    }

    public function profile()
    {
        $template = 'fontend.user.dashboard.home.profile';
        return view('fontend.user.dashboard.layout', compact('template'));

    }

    public function myClass()
    {
        $user = Auth::user();
        $classes = $user->classes()->with('course')->get(); // nếu muốn kèm khóa học liên quan
        $template = 'fontend.user.dashboard.home.student-class';
    
        return view('fontend.user.dashboard.layout', compact('template', 'classes'));

    }

    public function diemdanh()
    {
        $user = Auth::user();
        $classes = $user->classes()->with('course')->get(); // nếu muốn kèm khóa học liên quan
        $template = 'fontend.user.dashboard.home.diemdanh';
    
        return view('fontend.user.dashboard.layout', compact('template', 'classes'));

    }

    public function lichhoc()
    {
        $user = Auth::user();
        $classes = $user->classes()->with('course')->get(); // nếu muốn kèm khóa học liên quan
        $template = 'fontend.user.dashboard.home.calendar';
    
        return view('fontend.user.dashboard.layout', compact('template', 'classes'));

    }

    public function kqHT()
    {
        $user = Auth::user();
        $classes = $user->classes()->with('course')->get(); // nếu muốn kèm khóa học liên quan
        $template = 'fontend.user.dashboard.home.ketquahoctap';
    
        return view('fontend.user.dashboard.layout', compact('template', 'classes'));

    }

    public function detail($id)
    {
        $user = Auth::user();
        // Lấy lớp học với các quan hệ cần thiết
        $class = Classroom::with(['classSchedules'])->findOrFail($id);
    
        $template = 'fontend.user.dashboard.home.chitietlophoc';
        return view('fontend.user.dashboard.layout', compact('template', 'class'));
    }
}
