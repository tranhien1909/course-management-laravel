<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StoreTeacherRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class TeacherController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request) {

        $search = $request->input('search');

        $teachers = Teacher::with(['user'])
            ->when($search, function ($query, $search) {
                $query->where('id', 'like', "%$search%")
                      ->orWhereHas('user', function ($q) use ($search) {
                          $q->where('fullname', 'like', "%$search%");
                      });
            })
            ->paginate(5);

        $template = 'backend.dashboard.home.qlgiangvien';
        return view('backend.dashboard.layout', compact('template', 'teachers'));
    }

    public function detail($id)
    {
        $teacher = Teacher::findOrFail($id);
        $template = 'backend.dashboard.home.chitietgiangvien';
        return view('backend.dashboard.layout', compact('template', 'teacher'));
    }

    public function store(StoreTeacherRequest $request)
    {
        // Validate dữ liệu người dùng nhập vào
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            // Kiểm tra nếu email đã tồn tại
            $existingUser = User::where('email', $validated['email'])->first();
            if ($existingUser) {
                return redirect()->back()->with('error', 'Email này đã được sử dụng. Vui lòng chọn email khác.');
            }

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
                'role' => 'teacher',
                'student_id' => null, 
                'status' => 'Active'
            ]);

            // Tạo id
            $userId = $user->id;
            $customId = 'SM' . str_pad($userId, 3, '0', STR_PAD_LEFT);

            // Tạo giáo viên mới
            $teacher = Teacher::create([
                'id' => $customId,
                'user_id' => $userId,
                'bio' => $request->input('bio'),
                'expertise' => $request->input('expertise'),
                'joining_date' => $request->input('joining_date'),
                'status' => 'Active',
            ]);

            DB::commit();
            return redirect()->route('teacher.index')->with('success', 'Giáo viên đã được thêm thành công!');


        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Lỗi hệ thống: '.$e->getMessage()
            ], 500);
        }
    }

        // Xóa 
        public function destroy($id)
        {
            try {
                $teacher = Teacher::findOrFail($id);
                // Lấy thông tin user liên quan đến giảng viên
                $user = $teacher->user;
                $teacher->delete();

                // Xoá tài khoản user
                if ($user) {
                    $user->delete();
                }
            
                return redirect()->route('teacher.index')->with('success', 'Xoá giảng viên thành công!');
            } catch (\Exception $e) {
                return redirect()->route('teacher.index')->with('error', 'Không thể xoá giảng viên');
            }
        }

    public function exportPDF()
    {
        $teachers = Teacher::all();
        $pdf = Pdf::loadView('exports.teacher_print', compact('teachers'))
        ->setPaper('a4', 'portrait');

        return $pdf->download('danh_sach_giang_vien.pdf');
    }
}
