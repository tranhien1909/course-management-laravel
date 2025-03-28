<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {
        $teachers = Teacher::paginate(10);

        $template = 'backend.dashboard.home.qlgiangvien';
        return view('backend.dashboard.layout', compact('template', 'teachers'));
    }

    public function detail() {
        $template = 'backend.dashboard.home.chitietgiangvien';
        return view('backend.dashboard.layout', compact('template'));
    }
}
