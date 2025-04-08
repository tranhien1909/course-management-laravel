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
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard');
    })->name('teacher.dashboard');
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});

Route::get('profile', [DashboardController::class, 'profile']) 
    -> name('dashboard.profile')
    ->middleware(AdminMiddleware::class);

// Auth routes - không yêu cầu đăng nhập
Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
    Route::post('admin/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
});

// Routes yêu cầu đăng nhập
// Route::middleware(['auth'])->group(function () {
//     // Logout route
//     Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    
//     // Profile route - chung cho tất cả roles
//     Route::get('profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    
//     // Admin routes
//     Route::prefix('admin')->middleware('role:admin')->group(function () {
//         Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
//     });
    
//     // Teacher routes
//     Route::prefix('teacher')->middleware('role:teacher')->group(function () {
//         Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
//     });
    
//     // Student routes
//     Route::prefix('student')->middleware('role:student')->group(function () {
//         Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
//     });
// });

// Backend Routes
Route::get('dashboard', [DashboardController::class, 'index']) 
    -> name('dashboard.index')
    ->middleware(AdminMiddleware::class);

Route::get('admin', [AuthController::class, 'index']) 
    -> name('auth.admin')
    ->middleware(RedirectIfAuthenticated::class);

Route::get('logout', [AuthController::class, 'logout']) 
    -> name('auth.logout');

    // Routes dành cho khách (chưa đăng nhập)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
});

// // Các trang quản lý
// Route::get('profile', [UserController::class, 'index']) 
//     -> name('profile')
//     ->middleware(AdminMiddleware::class);

// Quản lý khoá học
Route::get('course_management/index', [CourseController::class, 'index']) 
    -> name('course.index')
    ->middleware(AdminMiddleware::class);

Route::post('course_management/store', [CourseController::class, 'store'])
    ->name('course.store')
    ->middleware(AdminMiddleware::class);

Route::post('/upload-temp-image', [CourseController::class, 'uploadTempImage']);

Route::get('course_management/{id}', [CourseController::class, 'detail'])
    ->name('course.detail')    
    ->middleware(AdminMiddleware::class);

Route::delete('course_management/{id}', [CourseController::class, 'destroy'])
    ->name('course.destroy')
    ->middleware(AdminMiddleware::class);

Route::post('course_management/{id}', [CourseController::class, 'destroy'])
    ->middleware(AdminMiddleware::class);



Route::get('course-pdf', [CourseController::class, 'exportPDF'])->name('courseExport.pdf');

// Quản lý lớp học
Route::get('class_management/index', [ClassController::class, 'index']) 
    -> name('class.index')
    ->middleware(AdminMiddleware::class);

Route::get('class_management/{id}', [ClassController::class, 'detail']) 
    -> name('class.detail')
    ->middleware(AdminMiddleware::class);

Route::get('/class-pdf', [ClassController::class, 'exportPDF'])->name('classExport.pdf');

// Quản lý giảng viên
Route::get('teacher_management/index', [TeacherController::class, 'index']) 
    -> name('teacher.index')
    ->middleware(AdminMiddleware::class);

Route::get('teacher_management/{id}', [TeacherController::class, 'detail'])->name('teacher.detail');

Route::get('/teacher-pdf', [TeacherController::class, 'exportPDF'])->name('teacherExport.pdf');

// Quản lý học viên
Route::group(['prefix' => 'user/student_management', 'middleware' => [AdminMiddleware::class]], function() {
    // GET
    Route::get('index', [UserController::class, 'index'])->name('student.index');
    Route::get('{id}', [UserController::class, 'detail'])->name('student.detail');
    Route::get('search', [UserController::class, 'search'])->name('student.search');
    Route::get('student-pdf', [UserController::class, 'exportPDF'])->name('studentExport.pdf');
    
    // POST
    Route::post('store', [UserController::class, 'store'])->name('student.store');
    
    // DELETE
    Route::delete('{id}', [UserController::class, 'destroy'])->name('student.destroy');
});


// Quản lý thu chi
Route::get('spending/index', [SpendingController::class, 'index']) 
-> name('spending.index')
->middleware(AdminMiddleware::class);

Route::get('spending/detail', [SpendingController::class, 'detail']) 
-> name('spending.detail')
->middleware(AdminMiddleware::class);


// Frontend Routes
Route::get('home', function() {
    return view('frontend.dashboard.layout');
}) -> name('frontend.layout');

