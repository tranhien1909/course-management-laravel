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

    public function index(Request $request) {

        $search = $request->input('search');
        $courses = Course::when($search, function ($query, $search) {
                $query->where('course_name', 'like', "%$search%")
                      ->orWhere('id', 'like', "%$search%")
                      ->orWhere('level', 'like', "%$search%")
                      ->orWhere('lessons', 'like', "%$search%")
                      ->orWhere('status', 'like', "%$search%")
                      ->orWhere('price', 'like', "%$search%");
            })
            ->paginate(5);

        $template = 'backend.dashboard.home.qlkhoahoc';
        return view('backend.dashboard.layout', compact('template', 'courses'));
    }

    // Xem chi tiết
    public function detail($id) {
        $template = 'backend.dashboard.home.chitietkhoahoc';
    // Lấy course và load trước quan hệ classes + user
    $course = Course::with([
        'classes.user:id,fullname',
        'exams.user',
        'courseMaterials'
    ])->findOrFail($id);

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

    // Xóa khóa học
    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();
        
            return redirect()->route('course.index')->with('success', 'Xoá khoá học thành công!');
        } catch (\Exception $e) {
            return redirect()->route('course.index')->with('error', 'Không thể xoá khoá học');
        }
    }

    public function update(Request $request, $id)
{
    $course = Course::findOrFail($id);

    $request->validate([
        'course_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'level' => 'nullable|string|max:100',
        'lessons' => 'nullable|integer',
        'created_at' => 'nullable|date',
        'price' => 'nullable|numeric',
        'status' => 'nullable|string|max:100',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $course->course_name = $request->course_name;
    $course->description = $request->description;
    $course->level = $request->level;
    $course->lessons = $request->lessons;
    $course->created_at = $request->created_at;
    $course->price = $request->price;
    $course->status = $request->status;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/course_images', $filename);
        $course->image = 'storage/course_images/' . $filename;
    }

    $course->save();

    return redirect()->back()->with('success', 'Cập nhật khóa học thành công!');
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
