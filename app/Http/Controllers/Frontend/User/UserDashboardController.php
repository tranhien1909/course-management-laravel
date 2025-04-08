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

        $template = 'fontend.user.dashboard.home.index';
        return view('fontend.user.dashboard.layout', compact('template'));

    }

    public function profile()
    {
        $template = 'fontend.user.dashboard.home.profile';
        return view('fontend.user.dashboard.layout', compact('template'));

    }
}
