<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\ClassController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\SpendingController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;


// Trang chủ
Route::get('/', function () {
    return view('welcome');
});

Route::get('/thongtinkhoahoc', function () {
    return view('thongtinkhoahoc');
});

// Phân quyền theo vai trò
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard');
    });
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    });
});

Route::get('profile', [DashboardController::class, 'profile']) 
    -> name('dashboard.profile')
    ->middleware(AdminMiddleware::class);


// Backend Routes
Route::get('dashboard', [DashboardController::class, 'index']) 
    -> name('dashboard.index')
    ->middleware(AdminMiddleware::class);

Route::get('admin', [AuthController::class, 'index']) 
    -> name('auth.admin')
    ->middleware(RedirectIfAuthenticated::class);

Route::get('logout', [AuthController::class, 'logout']) 
    -> name('auth.logout');

// // Các trang quản lý
// Route::get('profile', [UserController::class, 'index']) 
//     -> name('profile')
//     ->middleware(AdminMiddleware::class);

// Quản lý khoá học
Route::get('course_management/index', [CourseController::class, 'index']) 
    -> name('course.index')
    ->middleware(AdminMiddleware::class);

Route::post('course_management/store', [CourseController::class, 'store'])
    ->name('courses.store')
    ->middleware(AdminMiddleware::class);

Route::post('/upload-temp-image', [CourseController::class, 'uploadTempImage']);

Route::get('course_management/detail', [CourseController::class, 'detail']) 
    -> name('course.detail')
    ->middleware(AdminMiddleware::class);

Route::get('courses_management/{id}', [CourseController::class, 'detail'])
    ->name('course.detail')    
    ->middleware(AdminMiddleware::class);


Route::get('course-pdf', [CourseController::class, 'exportPDF'])->name('courseExport.pdf');

// Quản lý lớp học
Route::get('class_management/index', [ClassController::class, 'index']) 
    -> name('class.index')
    ->middleware(AdminMiddleware::class);

Route::get('class_management/detail', [ClassController::class, 'detail']) 
    -> name('class.detail')
    ->middleware(AdminMiddleware::class);

Route::get('/class-pdf', [ClassController::class, 'exportPDF'])->name('classExport.pdf');

// Quản lý giảng viên
Route::get('teacher_management/index', [TeacherController::class, 'index']) 
    -> name('teacher.index')
    ->middleware(AdminMiddleware::class);

Route::get('teacher_management/detail', [TeacherController::class, 'detail']) 
    -> name('teacher.detail')
    ->middleware(AdminMiddleware::class);

Route::get('/teacher-pdf', [TeacherController::class, 'exportPDF'])->name('teacherExport.pdf');

// Quản lý học viên
Route::group(['prefix' => 'user'], function() {
    Route::get('student_management/index', [UserController::class, 'index']) 
        -> name('student.index')
        ->middleware(AdminMiddleware::class);

    Route::get('student_management/detail', [UserController::class, 'detail']) 
        -> name('student.detail')
        ->middleware(AdminMiddleware::class);

    Route::post('student_management/store', [UserController::class, 'store'])
        -> name('student.store')
        ->middleware(AdminMiddleware::class);

    Route::get('/student-pdf', [UserController::class, 'exportPDF'])->name('studentExport.pdf');

});

// Quản lý thu chi
Route::get('spending/index', [SpendingController::class, 'index']) 
-> name('spending.index')
->middleware(AdminMiddleware::class);

Route::get('spending/detail', [SpendingController::class, 'detail']) 
-> name('spending.detail')
->middleware(AdminMiddleware::class);

// Routes dành cho khách (chưa đăng nhập)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
});

// Frontend Routes
Route::get('home', function() {
    return view('frontend.dashboard.layout');
}) -> name('frontend.layout');

