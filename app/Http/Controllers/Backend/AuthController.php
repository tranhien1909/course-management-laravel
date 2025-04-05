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
            return redirect()->route('dashboard.index');
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
            return redirect()->route('dashboard.index');
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
}
