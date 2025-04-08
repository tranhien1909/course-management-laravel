<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Flasher\Laravel\Facade\Flasher;

class AuthController extends Controller
{
    public function __construct() {
        
    }

    public function index() {
        if (Auth::id() > 0) {
            // Chuyển hướng theo role của user
            return $this->redirectToDashboard();
        }

        return view('backend.auth.login');
    }

    public function showRegisterForm() {
        return view('backend.auth.register');
    }

    public function showLoginForm(AuthRequest $request) {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
    
        if (Auth::attempt($credentials)) {
            Flasher::addSuccess('Đăng nhập thành công!');
            return $this->redirectToDashboard();
        } else {
            Flasher::addError('Email hoặc mật khẩu không đúng');
            return redirect()->route('auth.admin');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.admin');
    }

    /**
     * Redirect user to dashboard based on their role
     */
    protected function redirectToDashboard()
    {
        $user = Auth::user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'teacher' => redirect()->route('teacher.dashboard'),
            'student' => redirect()->route('student.dashboard'),
            default => redirect('/home'),
        };
        
        // if ($user->hasRole('admin')) {
        //     return redirect()->route('admin.dashboard');
        // }
        
        // if ($user->hasRole('teacher')) {
        //     return redirect()->route('teacher.dashboard');
        // }
        
        // if ($user->hasRole('student')) {
        //     return redirect()->route('student.dashboard');
        // }
        
        // // Default redirect if no role matches
        // return redirect()->route('/');
    }
}