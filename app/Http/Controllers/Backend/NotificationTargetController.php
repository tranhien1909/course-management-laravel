<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

class NotificationTargetController extends Controller
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
