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

    public function index() {

        $template = 'backend.dashboard.home.qlthuchi';
        $payments = Payment::all();
        return view('backend.dashboard.layout', compact('template', 'payments'));
    }

}
