<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\NotificationTarget;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {

        $template = 'backend.dashboard.home.qlthuchi';
        $payments = Payment::all();
        return view('backend.dashboard.layout', compact('template', 'payments'));
    }

    public function create()
    {
        // Lấy danh sách giáo viên và học viên để gửi thông báo cá nhân
        $teachers = User::where('role', 'teacher')->get();
        $students = User::where('role', 'student')->get();

        // Lấy danh sách lớp học
        $classes = Classroom::all(); 

        // Lấy danh sách khoá học
        $courses = Course::all();

        $notifications = Notification::latest()->get(); // Lấy thông báo đã gửi
        $template = 'backend.dashboard.home.guithongbao';


        return view('backend.dashboard.layout', compact('template', 'teachers', 'students', 'classes', 'courses', 'notifications'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'type' => 'required|in:all,user,class,course',
        ]);
    
        $notification = Notification::create([
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'sender_id' => Auth::id(),
        ]);
    
        switch ($request->type) {
            case 'user':
                foreach ($request->user_ids as $userId) {
                    NotificationTarget::create([
                        'notification_id' => $notification->id,
                        'user_id' => $userId,
                    ]);
                }
                break;
    
            case 'class':
                foreach ($request->class_ids as $classId) {
                    NotificationTarget::create([
                        'notification_id' => $notification->id,
                        'class_id' => $classId,
                    ]);
                }
                break;
    
            case 'course':
                foreach ($request->course_ids as $courseId) {
                    NotificationTarget::create([
                        'notification_id' => $notification->id,
                        'course_id' => $courseId,
                    ]);
                }
                break;
    
            case 'all':
                // Không cần lưu vào notification_targets vì áp dụng cho tất cả
                break;
        }
    
        return back()->with('success', 'Thông báo đã được gửi!');
    }
    

}
