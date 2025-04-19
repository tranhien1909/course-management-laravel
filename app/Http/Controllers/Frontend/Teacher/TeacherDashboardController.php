<?php

namespace App\Http\Controllers\Frontend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Collection;

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

    public function myClass(Request $request)
    {
        $search = $request->input('search');

        $user = Auth::user();
        $classes = $user->classes()->with(['course', 'user'])
        ->when($search, function ($query, $search) {
            $query->where('id', 'like', "%$search%")
                  ->orWhereHas('course', function ($q) use ($search) {
                      $q->where('course_name', 'like', "%$search%");
                  });
        })
        ->get();
        $template = 'fontend.teacher.dashboard.home.myclass';
    
        return view('fontend.teacher.dashboard.layout', compact('template', 'classes'));

    }

    public function detail($id)
    {
        $user = Auth::user();
        // Lấy lớp học với các quan hệ cần thiết
        $class = Classroom::with([
            'course.quizzes',                               // Tên khóa học
            'user',                                 // Giảng viên phụ trách
            'enrollments.student', 
            'classSchedules'
            
        ])->findOrFail($id);
    
        $template = 'fontend.teacher.dashboard.home.chitietloptoi';
        return view('fontend.teacher.dashboard.layout', compact('template', 'class'));
    }

    public function teachingSchedule()
    {
        $user = Auth::user();
    
        // Lấy các lớp của giáo viên có kèm course và lịch học
        $classes = $user->classes()->with(['classSchedules', 'course', 'user'])->get();
    
        // Gom toàn bộ lịch học từ các lớp lại thành 1 danh sách chung
        $classSchedules = $classes->flatMap(function ($class) {
            return $class->classSchedules->map(function ($schedule) use ($class) {
                $schedule->class = $class; // gán thêm class để tiện dùng trong view
                return $schedule;
            });
        });
    
        $template = 'fontend.teacher.dashboard.home.lichday';
        return view('fontend.teacher.dashboard.layout', compact('template', 'classes', 'classSchedules'));
    }

    public function nhapdiem($id)
    {
        $user = Auth::user();
        // Lấy lớp học với các quan hệ cần thiết
        $class = Classroom::with([
            'course',                               // Tên khóa học
            'user',                                 // Giảng viên phụ trách
            'enrollments.student'
            
        ])->findOrFail($id);
    
        $template = 'fontend.teacher.dashboard.home.nhapdiem';
        return view('fontend.teacher.dashboard.layout', compact('template', 'class'));

    }
}
