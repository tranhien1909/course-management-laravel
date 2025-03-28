<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {

        $template = 'backend.dashboard.home.qlthuchi';
        return view('backend.dashboard.layout', compact('template'));
    }

}
