<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class WelcomeController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $courses = Course::take(3)->get();
        $tuvans = Course::all();
        $template = 'welcome.index';
        return view('welcome.layout', compact('template', 'courses', 'tuvans'));
    }

    public function all()
    {
        $courses = Course::all(); // Lấy toàn bộ khóa học từ CSDL
        $template = 'welcome.courses';
        return view('welcome.layout', compact('template', 'courses'));
    }

    public function detail($id)
    {
        $template = 'welcome.thongtinkhoahoc';
        // Lấy course và load trước quan hệ classes + user
        $course = Course::with(['classes.user:id,fullname'])->findOrFail($id);

        return view('welcome.layout', compact('template', 'course'));
    }
}
