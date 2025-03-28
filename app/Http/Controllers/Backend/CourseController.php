<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Services\Interfaces\CourseServiceInterface;

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
        // return view('backend.dashboard.lichhoc');
    }

    public function detail() {
        $template = 'backend.dashboard.home.chitietkhoahoc';
        return view('backend.dashboard.layout', compact('template'));
    }
}
