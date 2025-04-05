<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StoreStudentRequest;


class UserController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {

        // $users = User::paginate(5);
        $users = User::where('role', 'student')
        ->paginate(5);

        $template = 'backend.dashboard.home.qlhocvien';
        return view('backend.dashboard.layout', compact('template', 'users'));
    }

public function store(StoreStudentRequest $request)
{
    $validated = $request->validated();
    
    try {
        DB::beginTransaction();

        // Xử lý avatar
        $avatarPath = $request->hasFile('avatar') 
            ? $request->file('avatar')->store('avatars', 'public') 
            : null;

        // Tạo user
        $user = User::create([
            'username' => $validated['username'],
            'fullname' => $validated['fullname'],
            'gender' => $validated['gender'],
            'birthday' => $validated['birthday'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'] ?? null,
            'password' => Hash::make($validated['password']),
            'avatar' => $avatarPath,
            'role' => 'student'
        ]);

        // Tạo student_id
        $studentId = 'RT' . str_pad($user->id, 4, '0', STR_PAD_LEFT);
        $user->update(['student_id' => $studentId]);

        DB::commit();
        
        return redirect()->route('student.index')
            ->with('success', 'Thêm học viên thành công!');
            
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withInput()
            ->with('error', 'Lỗi hệ thống: '.$e->getMessage());
    }
}

    // Ham in pdf
    public function exportPDF()
    {
        $users = User::where('role', 'student')->get();
        $pdf = Pdf::loadView('exports.student_print', compact('users'))
        ->setPaper('a4', 'portrait');

        return $pdf->download('danh_sach_hoc_vien.pdf');
    }
}
