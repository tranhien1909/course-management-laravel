<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');

        // Thêm middleware role:admin chỉ cho phương thức index
        // $this->middleware('role:admin')->only('index');
    }

    public function index()
    {
        // Chỉ admin mới có thể truy cập
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $thongKe = [
            'khoa_hoc' => DB::table('courses')->count(),
            'lop_hoc' => DB::table('classes')->count(),
            'giang_vien' => DB::table('teachers')->count(),
            'hoc_vien' => DB::table('users')->where('role', 'student')->count()
        ];

        $template = 'backend.dashboard.home.index';
        return view('backend.dashboard.layout', compact('template', 'thongKe'));

    }

    public function profile()
    {
        $template = 'backend.dashboard.home.profile';
        return view('backend.dashboard.layout', compact('template'));

    }
}
