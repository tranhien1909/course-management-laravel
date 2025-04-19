<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseMaterial;
use Illuminate\Support\Facades\Storage;

class CourseMaterialController extends Controller
{


    public function __construct()
    {
        
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'course_id' => 'required|exists:courses,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar|max:10240',
        'file_url' => 'nullable|url',
        'uploaded_by' => 'required|exists:teachers,id'
    ]);

    // Kiểm tra có file hoặc URL không
    if (!$request->hasFile('file') && empty($request->file_url)) {
        return back()->withErrors(['file' => 'Vui lòng chọn file hoặc nhập URL'])->withInput();
    }

    $filePath = null;
    
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('course_materials', $fileName, 'public');
    } else {
        $filePath = $request->file_url;
    }

    CourseMaterial::create([
        'course_id' => $validated['course_id'],
        'title' => $validated['title'],
        'description' => $validated['description'],
        'file_url' => $filePath,
        'uploaded_by' => $validated['uploaded_by']
    ]);

    return redirect()->back()->with('success', 'Tài liệu đã được thêm thành công!');
}

}
