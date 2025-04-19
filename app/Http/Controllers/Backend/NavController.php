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

class NavController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {
        $thongKe = [
            'thong_bao' => DB::table('notifications')->count(),
        ];

        return view('backend.dashboard.component.nav', compact('thongKe'));
    }

}
