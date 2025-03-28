<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Kiểm tra nếu user chưa đăng nhập
         if (!Auth::check()) {
            return redirect()->route('auth.admin')->with('error', 'Bạn cần đăng nhập để truy cập trang này');
        }

        // Kiểm tra nếu user không phải Admin
        if (Auth::user()->role !== 'admin') {
            return abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        return $next($request);
    }
}
