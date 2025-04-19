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
        $thongKe = [
            'thong_bao' => DB::table('notifications')->count(),
        ];

        $template = 'backend.dashboard.home.guithongbao';
        $payments = Payment::all();
        return view('backend.dashboard.layout', compact('thongKe', 'template', 'payments'));
    }

    public function create(Request $request)
    {
        $teachers = User::where('role', 'teacher')->get();
        $students = User::where('role', 'student')->get();
        $classes = Classroom::all(); 
        $courses = Course::all();
        $notifications = Notification::latest()->get(); 
        $template = 'backend.dashboard.home.guithongbao';
    
        $editNotification = null;
        if ($request->has('edit')) {
            $editNotification = Notification::find($request->edit);
        }
    
        return view('backend.dashboard.layout', compact(
            'template',
            'teachers',
            'students',
            'classes',
            'courses',
            'notifications',
            'editNotification'
        ));
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

    // Cập nhật thông báo
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    
        $notification = Notification::findOrFail($id);
        $notification->title = $request->title;
        $notification->message = $request->message;
        $notification->save();
    
        return redirect()->route('admin.notifications.create')->with('success', 'Cập nhật thông báo thành công.');
    }
    

    // Xoá thông báo
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
    
        return redirect()->route('admin.notifications.create')->with('success', 'Đã xoá thông báo.');
    }

    

}
