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
use App\Models\ClassSchedule;
use Carbon\Carbon;
use App\Models\Classroom;

class TeacherController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request) {
        $thongKe = [
            'thong_bao' => DB::table('notifications')->count(),
        ];

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
        return view('backend.dashboard.layout', compact('thongKe', 'template', 'teachers'));
    }

    public function detail($id)
    {
        $teacher = Teacher::findOrFail($id);
        $selectedDate = Carbon::parse(request('date', now()));
        $weekStart = $selectedDate->copy()->startOfWeek(Carbon::MONDAY);
    
        // Lấy lịch dạy theo teacher_id
        $classSchedules = ClassSchedule::with(['class.user'])
            ->whereHas('class', function ($query) use ($id) {
                $query->where('teacher_id', $id);
            })
            ->get();
    
        $template = 'backend.dashboard.home.chitietgiangvien';
        return view('backend.dashboard.layout', compact('template', 'teacher', 'classSchedules', 'weekStart'));
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
            $avatarPath = null;

            if ($request->hasFile('image')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
            } elseif ($request->filled('avatar_temp')) {
                // Di chuyển ảnh từ thư mục temp sang thư mục avatars
                $tempPath = storage_path('app/public/' . $request->input('avatar_temp'));
                $newPath = 'avatars/' . basename($tempPath);
                Storage::disk('public')->move($request->input('avatar_temp'), $newPath);
                $avatarPath = $newPath;
            }

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

        public function update(Request $request, $id)
        {
            $teacher = Teacher::findOrFail($id);
            $user = User::findOrFail($teacher->user_id);
        
            $request->validate([
                'teacher_name' => 'required|string|max:255',
                'birthday' => 'required|date',
                'gender' => 'required',
                'expertise' => 'nullable|string',
                'bio' => 'nullable|string',
                'address' => 'nullable|string',
                'phone' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
        
            $user->fullname = $request->teacher_name;
            $user->birthday = $request->birthday;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->updated_at = now();
            $user->phone = $request->phone;
            $teacher->expertise = $request->expertise;
            $teacher->bio = $request->bio;
            $teacher->status = $request->status;
        
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/avatars', $filename); // lưu đúng chỗ
                $user->avatar = 'avatars/' . $filename;
            }
        
            $user->save();
            $teacher->save();
        
            return redirect()->back()->with('success', 'Cập nhật giáo viên thành công!');
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

    public function exportPDF()
    {
        $teachers = Teacher::all();
        $pdf = Pdf::loadView('exports.teacher_print', compact('teachers'))
        ->setPaper('a4', 'portrait');

        return $pdf->download('danh_sach_giang_vien.pdf');
    }
}
