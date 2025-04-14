<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use App\Models\CourseMaterial;
use App\Models\ClassSchedule;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StoreClassRequest;

class ClassController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $classes = Classroom::with(['course:id,course_name', 'user:id,fullname'])
            ->when($search, function ($query, $search) {
                $query->where('id', 'like', "%$search%")
                      ->orWhereHas('course', function ($q) use ($search) {
                          $q->where('course_name', 'like', "%$search%");
                      });
            })
            ->paginate(5);
    
        // Lấy tất cả khoá học và giáo viên (dùng cho dropdown lọc)
        $courses = Course::select('id', 'course_name')->get();
        $teachers = User::select('id', 'fullname')->where('role', 'teacher')->get();
    
        $template = 'backend.dashboard.home.qllophoc';
        return view('backend.dashboard.layout', compact('template', 'classes', 'courses', 'teachers'));
    }

    public function detail($id)
    {
        // Lấy lớp học với các quan hệ cần thiết
        $class = Classroom::with([
            'course',                               // Tên khóa học
            'user',                                 // Giảng viên phụ trách
            'enrollments.student', 
            'classSchedules'
            
        ])->findOrFail($id);

        $classSchedules = ClassSchedule::with(['class.course', 'class.user'])
        ->where('class_id', $id)
        ->get();
    
        $template = 'backend.dashboard.home.chitietlophoc';
        return view('backend.dashboard.layout', compact('template', 'class', 'classSchedules'));
    }
    

    public function store(StoreClassRequest $request)
    {
        $validated = $request->validated();
        // Nếu validation pass, bạn có thể tiếp tục lưu dữ liệu
        try {
            DB::beginTransaction();

            $class = Classroom::create([
                'id' => $validated['class_id'],
                'course_id' => $validated['course_id'],
                'teacher_id' => $validated['teacher_id'],
                'start_date' => $validated['start_date'],
                'description' => $validated['description'] ?? null,
                'number_of_student' => 0,
                'status' => 'Active',
            ]);

            DB::commit();
        
            // Redirect hoặc trả về thông báo thành công
            return redirect()->route('class.index')->with('success', 'Thêm lớp học thành công!');
        }

        catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Lỗi hệ thống: '.$e->getMessage()
            ], 500);
        }
    }

    public function destroy(Classroom $class)
    {
        try {
            DB::beginTransaction();
            
            // Kiểm tra nếu lớp học có học viên đang theo học
            if ($class->enrollments()->exists()) {
                return response()->json([
                    'error' => 'Không thể xoá lớp học vì có học viên đang theo học'
                ], 422);
            }
            
            $class->delete();
            
            DB::commit();
            
            return redirect()->route('class.index')->with('success', 'Xoá lớp học thành công!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Lỗi khi xoá lớp học: ' . $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
{
    $search = $request->input('search');

    $classes = Classroom::with(['course', 'user'])
        ->when($search, function ($query, $search) {
            $query->where('id', 'like', "%$search%")
                  ->orWhereHas('course', function ($q) use ($search) {
                      $q->where('course_name', 'like', "%$search%");
                  });
        })->paginate(10);

        $template = 'backend.dashboard.home.qllophoc';
        return view('backend.dashboard.layout', compact('template', 'classes'));
}


    public function exportPDF()
    {
        $classes = Classroom::all();
        $pdf = Pdf::loadView('exports.class_print', compact('classes'))
        ->setPaper('a4', 'portrait');

        return $pdf->download('danh_sach_lop_hoc.pdf');
    }
}
