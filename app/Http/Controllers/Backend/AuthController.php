<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Flasher\Laravel\Facade\Flasher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct() {
        
    }

    public function showLoginForm() {
        if (Auth::id() > 0) {
            // Chuyển hướng theo role của user
            return $this->redirectToDashboard();
        }

        return view('backend.auth.login');
    }

    public function showRegisterForm() {
        return view('backend.auth.register');
    }


    public function login(AuthRequest $request) {
        $credentials = $request->validated();
    
        if (Auth::attempt($credentials)) {
            Flasher::addSuccess('Đăng nhập thành công!');
            return $this->redirectToDashboard();
        } else {
            Flasher::addError('Email hoặc mật khẩu không đúng');
            return redirect()->route('login.form');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
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
            default => redirect('/'),
        };
        
    }

    public function register(Request $request)
{
    $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'terms' => 'accepted',
    ]);

    $user = User::create([
        'fullname' => $request->fullname,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user); // đăng nhập tự động

    return redirect()->route('student.dashboard')->with('success', 'Đăng ký thành công!');
}
}