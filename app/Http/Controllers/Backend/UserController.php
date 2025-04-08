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
            
            return response()->json(['success' => 'Thêm học viên thành công!']);
                
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Lỗi hệ thống: '.$e->getMessage()
            ], 500);
        }
    }

    // public function search(Request $request)
    // {
    //     if(!$request->has('keyword')) {
    //         return redirect()->back();
    //     }
    //     dd($request->keyword);
    
    //     $users = User::where('role', 'student')
    //         ->where(function($query) use ($request) {
    //             $query->where('fullname', 'like', '%'.$request->keyword.'%')
    //                   ->orWhere('student_id', 'like', '%'.$request->keyword.'%')
    //                   ->orWhere('email', 'like', '%'.$request->keyword.'%')
    //                   ->orWhere('phone', 'like', '%'.$request->keyword.'%');
    //         })
    //         ->paginate(5);
    
    //     if ($request->ajax()) {
    //         return response()->json([
    //             'html' => view('backend.dashboard.partials.student_table', compact('users'))->render()
    //         ]);
    //     }
    
    //     return view('backend.dashboard.layout', [
    //         'template' => 'backend.dashboard.home.qlhocvien',
    //         'users' => $users
    //     ]);
    // }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        dd($request->all()); // Debug đơn giản
        
        $users = User::where('role', 'student')
            ->where(function($query) use ($keyword) {
                $query->where('fullname', 'like', "%$keyword%")
                      ->orWhere('student_id', 'like', "%$keyword%")
                      ->orWhere('email', 'like', "%$keyword%")
                      ->orWhere('phone', 'like', "%$keyword%");
            })
            ->paginate(5);
        
        $template = 'backend.dashboard.home.qlhocvien';
        
        if ($request->ajax()) {
            return response()->json([
                'html' => view('backend.dashboard.partials.student_table', compact('users'))->render()
            ]);
        }
        
        return view('backend.dashboard.layout', compact('template', 'users', 'keyword'));
    }

    public function detail($id)
    {
        $user = User::findOrFail($id);
        $template = 'backend.dashboard.home.chitiethocvien';
        return view('backend.dashboard.layout', compact('template', 'user'));
    }

    // Xóa khóa học
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            
            return response()->json(['success' => 'Xoá thành công']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không thể xoá học viên'], 500);
        }
    }

    // In pdf
    public function exportPDF()
    {
        $users = User::where('role', 'student')->get();
        $pdf = Pdf::loadView('exports.student_print', compact('users'))
        ->setPaper('a4', 'portrait');

        return $pdf->download('danh_sach_hoc_vien.pdf');
    }
}
