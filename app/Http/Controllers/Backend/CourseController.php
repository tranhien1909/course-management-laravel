<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Services\Interfaces\CourseServiceInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseServiceInterface $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index() {

        $courses = $this->courseService->paginate();

        $template = 'backend.dashboard.home.qlkhoahoc';
        return view('backend.dashboard.layout', compact('template', 'courses'));
    }

    // Xem chi tiết
    public function detail($id) {
        $template = 'backend.dashboard.home.chitietkhoahoc';
    // Lấy course và load trước quan hệ classes + user
    $course = Course::with(['classes.user:id,fullname'])->findOrFail($id);

    // Lấy danh sách lớp từ quan hệ đã load sẵn
    $classes = $course->classes;

        return view('backend.dashboard.layout', compact('template', 'course', 'classes'));
    }

    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            // Xử lý avatar
            $avatarPath = $request->hasFile('avatar') 
                ? $request->file('avatar')->store('avatars', 'public') 
                : null;

            // Tạo course
            $course = Course::create([
                'id' => $validated['id'],
                'course_name' => $validated['course_name'],
                'level' => $validated['level'],
                'lessons' => $validated['lessons'],
                'description' => $validated['description'] ?? null,
                'price' => $validated['price'],
                'avatar' => $avatarPath,
            ]);

            DB::commit();
            
            return redirect()->route('course.index')
                ->with('success', 'Thêm khoá học thành công!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Lỗi hệ thống: '.$e->getMessage());
        }
    }

    public function uploadTempImage(StoreCourseRequest $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('image')->store('temp', 'public');
        
        return response()->json([
            'path' => $path
        ]);
    }

    // Cập nhật khóa học
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());
    
        return response()->json(['success' => 'Khóa học đã được cập nhật!', 'course' => $course]);
    }

    // Xóa khóa học
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
    
        return response()->json(['success' => 'Xoá thành công']);
    }
    

    // In pdf
    public function exportPDF()
    {
        $courses = Course::all();
        $pdf = Pdf::loadView('exports.course_print', compact('courses'))
        ->setPaper('a4', 'portrait');

        return $pdf->download('danh_sach_khoa_hoc.pdf');
    }
}
