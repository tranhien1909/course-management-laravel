<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Services\Interfaces\CourseServiceInterface;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $course = Course::findOrFail($id);
        return view('backend.dashboard.layout', compact('template', 'course'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|unique:courses,id',
            'course_name' => 'required|string|max:255',
            'level' => 'required|in:A1,B1,C1',
            'lessons' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('course_images', 'public');
            $validated['image'] = $imagePath;
        }

        try {
            $course = $this->courseService->create($validated);
            return redirect()->route('courses.index')->with('success', 'Thêm khóa học thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
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
    
        return response()->json(['success' => 'Khóa học đã được xóa!']);
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
