<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Course;
use Illuminate\Support\Facades\DB;



class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $thongKe = [
            'thong_bao' => DB::table('notifications')->count(),
        ];
        
        $search = $request->input('search');
    
        $template = 'backend.dashboard.home.qlnguoituvan';
        $courses = Course::all();
        
        $consultations = Consultation::query()
            ->when($search, function ($query, $search) {
                $query->where('id', 'like', "%$search%")
                      ->orWhere('fullname', 'like', "%$search%")
                      ->orWhere('phone', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%")
                      ->orWhereHas('course', function ($q) use ($search) {
                          $q->where('course_name', 'like', "%$search%");
                      });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    
        return view('backend.dashboard.layout', compact('thongKe', 'template', 'consultations', 'courses'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'course_interested' => 'required|exists:courses,id',
            'message' => 'nullable|string',
        ]);

        Consultation::create([
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'course_interested' => $validated['course_interested'],
            'message' => $validated['message'],
            'status' => 'pending'
        ]);

        return back()->with('success', 'Yêu cầu tư vấn của bạn đã được gửi thành công! Chúng tôi sẽ liên hệ sớm nhất.');
    }

    public function updateStatus(Request $request, $consultationId)
    {
        $consultation = Consultation::findOrFail($consultationId);
        $consultation->status = $request->input('status');
        $consultation->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    
}
