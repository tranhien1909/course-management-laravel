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
        $classes = $user->enrollments()->with(['class.course', 'class.classSchedules'])->get();

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
    
        // Lấy các lớp của học viên có kèm course và lịch học
        $classes = $user->myclasses()->with(['classSchedules', 'course', 'students', 'user'])->get();
    
        // Gom toàn bộ lịch học từ các lớp lại thành 1 danh sách chung
        $classSchedules = $classes->flatMap(function ($class) {
            return $class->classSchedules->map(function ($schedule) use ($class) {
                $schedule->class = $class; // gán thêm class để tiện dùng trong view
                return $schedule;
            });
        });
    
        $template = 'fontend.user.dashboard.home.calendar';
        return view('fontend.user.dashboard.layout', compact('template', 'classes', 'classSchedules'));
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

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $request->validate([
            'student_name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => 'required',
            'address' => 'nullable|string',
            'phone' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $user->fullname = $request->student_name;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->updated_at = now();
        $user->phone = $request->phone;
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/avatars', $filename); // lưu đúng chỗ
            $user->avatar = 'avatars/' . $filename;
        }
    
        $user->save();
    
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }

    public function uploadTempImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('image')->store('temp', 'public');
        
        return response()->json([
            'path' => $path
        ]);
    }
}
