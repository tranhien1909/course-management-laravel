<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Payment;
use App\Models\Course;

class SpendingController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request) 
    {
        $thongKe = [
            'thong_bao' => DB::table('notifications')->count(),
        ];

        $search = $request->input('search');
        $tungay = $request->input('tungay');
        $denngay = $request->input('denngay');

        $template = 'backend.dashboard.home.qlthuchi';
        
        $payments = Payment::with(['student', 'course'])
            ->when($search, function ($query, $search) {
                $query->where('student_id', 'like', "%$search%")
                    ->orWhereHas('course', function ($q) use ($search) {
                        $q->where('course_id', 'like', "%$search%");
                    });
            })
            ->when($tungay, function ($query, $tungay) {
                $query->whereDate('payment_date', '>=', $tungay);
            })
            ->when($denngay, function ($query, $denngay) {
                $query->whereDate('payment_date', '<=', $denngay);
            })
            ->orderBy('payment_date', 'desc')
            ->paginate(5);

        return view('backend.dashboard.layout', compact('thongKe', 'template', 'payments'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->status = $request->input('status');
        $payment->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }

}
