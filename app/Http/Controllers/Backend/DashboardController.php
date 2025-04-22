<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AdminTask;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Classroom;


class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');

        // Thêm middleware role:admin chỉ cho phương thức index
        // $this->middleware('role:admin')->only('index');
    }

    public function index()
    {
        // Chỉ admin mới có thể truy cập
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $thongKe = [
            'khoa_hoc' => DB::table('courses')->count(),
            'lop_hoc' => DB::table('classes')->count(),
            'giang_vien' => DB::table('teachers')->count(),
            'hoc_vien' => DB::table('users')->where('role', 'student')->count(),
            'thong_bao' => DB::table('notifications')->count(),
        ];

        $tasks = AdminTask::orderBy('created_at', 'desc')->get();

        $template = 'backend.dashboard.home.index';
        $pageTask = 'backend.dashboard.component.task';
        return view('backend.dashboard.layout', compact('template', 'thongKe', 'tasks', 'pageTask'));

    }

    public function addTask(Request $request)
    {
        AdminTask::create($request->only('title', 'note'));
        return back()->with('success', 'Đã thêm ghi chú mới');
    }

    public function toggleTask($id)
    {
        $task = AdminTask::findOrFail($id);
        $task->is_done = !$task->is_done;
        $task->save();

        return back();
    }

    public function profile()
    {
        $thongKe = [
            'thong_bao' => DB::table('notifications')->count(),
        ];
        $template = 'backend.dashboard.home.profile';
        return view('backend.dashboard.layout', compact('template', 'thongKe'));

    }

    public function thongke()
    {
        $thongKe = [
            'thong_bao' => DB::table('notifications')->count(),
        ];

        // Học viên mới theo tháng
        $studentsPerMonth = User::where('role', 'student')
            ->whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');
    
        $studentData = [];
        for ($i = 1; $i <= 12; $i++) {
            $studentData[] = $studentsPerMonth[$i] ?? 0;
        }
    
        // Lớp học theo trạng thái
        $classStats = Classroom::selectRaw("status, COUNT(*) as count")
            ->groupBy('status')
            ->pluck('count', 'status');

            $year = now()->year;

            // Tổng tiền học phí thu được theo từng tháng
            $tuitionStats = DB::table('payments')
                ->selectRaw('MONTH(payment_date) as month, SUM(amount) as total')
                ->whereYear('payment_date', $year)
                ->where('status', 'completed')
                ->groupByRaw('MONTH(payment_date)')
                ->pluck('total', 'month');
        
            // Đảm bảo đủ 12 tháng
            $tuitionData = [];
            for ($i = 1; $i <= 12; $i++) {
                $tuitionData[] = $tuitionStats[$i] ?? 0;
            }
    
        return view('backend.dashboard.layout', [
            'thongKe' => $thongKe, 
            'template' => 'backend.dashboard.home.thongke',
            'studentData' => $studentData,
            'classStats' => $classStats,
            'tuitionData' => $tuitionData,
        ]);
    }


}
