<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\AdminTask;

class AdminTaskController extends Controller
{


    public function __construct()
    {
        
    }

    public function destroy($id)
    {
        $task = AdminTask::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task đã được xoá!');
    }


}
