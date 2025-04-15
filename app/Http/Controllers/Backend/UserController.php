<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Enrollment;
use App\Models\Attendance;
use App\Models\ClassSchedule;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Teacher;
use Carbon\Carbon;


class UserController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request) {

        $search = $request->input('search');

        $users = User::where('role', 'student')
            ->when($search, function ($query, $search) {
                $query->where('fullname', 'like', "%$search%")
                      ->orWhere('student_id', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%")
                      ->orWhere('phone', 'like', "%$search%");
            })
            ->paginate(5);

        $template = 'backend.dashboard.home.qlhocvien';
        return view('backend.dashboard.layout', compact('template', 'users'));
    }

    public function store(StoreStudentRequest $request)
    {
        $validated = $request->validated();
        
        try {
            DB::beginTransaction();

            // Xử lý avatar
            $avatarPath = $request->hasFile('avatar') 
                ? $request->file('avatar')->store('avatars', 'public') 
                : null;

            // Tạo user
            $user = User::create([
                'fullname' => $validated['fullname'],
                'gender' => $validated['gender'],
                'birthday' => $validated['birthday'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'] ?? null,
                'password' => Hash::make($validated['password']),
                'avatar' => $avatarPath,
                'role' => 'student'
            ]);

            // Tạo student_id
            $studentId = 'RT' . str_pad($user->id, 4, '0', STR_PAD_LEFT);
            $user->update(['student_id' => $studentId]);

            DB::commit();

            return redirect()->route('student.index')->with('success', 'Thêm học viên thành công!');
        
                
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Lỗi hệ thống: '.$e->getMessage()
            ], 500);
        }
    }

    public function detail($id)
    {
        $user = User::with([
            'grades.exam' 
        ])->findOrFail($id);
        $enrollments = Enrollment::with('class')->where('student_id', $id)->get();
        $payments = $user->payments;
        $grades = $user->grades;

        $attendances = $user->attendances;

            // Tổng buổi nghỉ
        $absentCount = Attendance::where('student_id', $id)
        ->where('status', 'absent')
        ->count();

        // Tổng buổi đi muộn
        $lateCount = Attendance::where('student_id', $id)
            ->where('status', 'late')
            ->count();

        // Thống kê theo tháng hiện tại
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;

        $absentThisMonth = Attendance::whereMonth('date', $currentMonth)
            ->where('student_id', $id)
            ->where('status', 'absent')
            ->count();

        $absentLastMonth = Attendance::whereMonth('date', $lastMonth)
            ->where('student_id', $id)
            ->where('status', 'absent')
            ->count();

        $lateThisMonth = Attendance::whereMonth('date', $currentMonth)
            ->where('student_id', $id)
            ->where('status', 'late')
            ->count();

        $lateLastMonth = Attendance::whereMonth('date', $lastMonth)
            ->where('student_id', $id)
            ->where('status', 'late')
            ->count();

        $template = 'backend.dashboard.home.chitiethocvien';
        return view('backend.dashboard.layout', compact('template', 'user', 'payments', 'attendances', 'enrollments', 'absentCount', 'grades',
        'lateCount',
        'absentThisMonth',
        'absentLastMonth',
        'lateThisMonth',
        'lateLastMonth'));
    }

    // Xóa 
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('student.index')->with('success', 'Xoá học viên thành công!');
        } catch (\Exception $e) {
            return redirect()->route('student.index')->with('error', 'Không thể xoá học viên');
        }
    }

    // In pdf
    public function exportPDF()
    {
        $users = User::where('role', 'student')->get();
        $pdf = Pdf::loadView('exports.student_print', compact('users'))
        ->setPaper('a4', 'portrait');

        return $pdf->download('danh_sach_hoc_vien.pdf');
    }
}
