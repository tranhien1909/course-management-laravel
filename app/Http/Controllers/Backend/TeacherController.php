<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class TeacherController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {
        $teachers = Teacher::with(['user'])->paginate(5);

        $template = 'backend.dashboard.home.qlgiangvien';
        return view('backend.dashboard.layout', compact('template', 'teachers'));
    }

    public function detail($id)
    {
        $teacher = Teacher::findOrFail($id);
        $template = 'backend.dashboard.home.chitietgiangvien';
        return view('backend.dashboard.layout', compact('template', 'teacher'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu người dùng nhập vào
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bio' => 'nullable|string',
            'expertise' => 'nullable|string',
            'joining_date' => 'nullable|date',
            'status' => 'nullable|in:Active,Inactive',
        ]);

        // Kiểm tra user_id và tạo mã giáo viên tương ứng
        $userId = $request->input('user_id');
        $customId = 'SM' . str_pad($userId, 3, '0', STR_PAD_LEFT);

        // Tạo giáo viên mới
        $teacher = Teacher::create([
            'id' => $customId,
            'user_id' => $userId,
            'bio' => $request->input('bio'),
            'expertise' => $request->input('expertise'),
            'joining_date' => $request->input('joining_date'),
            'status' => $request->input('status', 'Active'), // mặc định là Active nếu không có giá trị
        ]);

        return redirect()->route('teachers.index')->with('success', 'Giáo viên đã được thêm thành công!');
    }

    public function exportPDF()
    {
        $teachers = Teacher::all();
        $pdf = Pdf::loadView('exports.teacher_print', compact('teachers'))
        ->setPaper('a4', 'portrait');

        return $pdf->download('danh_sach_giang_vien.pdf');
    }
}
