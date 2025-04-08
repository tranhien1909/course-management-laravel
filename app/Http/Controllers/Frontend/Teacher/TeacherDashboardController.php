<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {

        $template = 'fontend.teacher.dashboard.home.index';
        return view('fontend.teacher.dashboard.layout', compact('template'));

    }

    public function profile()
    {
        $template = 'fontend.teacher.dashboard.home.profile';
        return view('fontend.teacher.dashboard.layout', compact('template'));

    }
}
