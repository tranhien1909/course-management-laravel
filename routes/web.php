<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\Teacher\TeacherDashboardController;
use App\Http\Controllers\Frontend\User\StudentDashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\ClassController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\SpendingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RoleMiddleware;


// Trang chủ
Route::get('/', [WelcomeController::class, 'index']) 
    -> name('welcome');

Route::get('/all', [WelcomeController::class, 'all']) 
    -> name('cackhoahoc');

Route::get('/detail/{id}', [WelcomeController::class, 'detail']) 
    -> name('chitiet');

Route::get('profile', [DashboardController::class, 'profile']) 
    -> name('dashboard.profile')
    ->middleware(AdminMiddleware::class);

// Auth routes - không yêu cầu đăng nhập
Route::middleware([RedirectIfAuthenticated::class])->group(function () {

    // Route hiển thị form đăng nhập (GET)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

    // Route xử lý đăng nhập (POST)
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

    // Logout route
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware('auth');

    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])
    ->name('teacher.dashboard')
    ->middleware('auth');

    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
    ->name('student.dashboard')
    ->middleware('auth');

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

Route::get('course-pdf', [CourseController::class, 'exportPDF'])->name('courseExport.pdf');

// Quản lý lớp học
Route::get('class_management/index', [ClassController::class, 'index']) 
    -> name('class.index')
    ->middleware(AdminMiddleware::class);

Route::get('class_management/{id}', [ClassController::class, 'detail']) 
    -> name('class.detail')
    ->middleware(AdminMiddleware::class);

Route::post('class_management/store', [ClassController::class, 'store'])
    ->name('class.store')
    ->middleware(AdminMiddleware::class);

Route::delete('/classes/{class}', [ClassController::class, 'destroy'])->name('class.destroy');


Route::get('/class-pdf', [ClassController::class, 'exportPDF'])->name('classExport.pdf');

// Quản lý giảng viên
Route::get('teacher_management/index', [TeacherController::class, 'index']) 
    -> name('teacher.index')
    ->middleware(AdminMiddleware::class);

Route::get('teacher_management/{id}', [TeacherController::class, 'detail'])->name('teacher.detail');

Route::post('teacher_management/store', [TeacherController::class, 'store'])
    ->name('teacher.store')
    ->middleware(AdminMiddleware::class);

Route::delete('/teacher/{class}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

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
Route::get('my-class', [TeacherDashboardController::class, 'myClass']) 
    -> name('teacher.class');

    Route::get('my-class/{id}', [TeacherDashboardController::class, 'detail']) 
    -> name('myclass.detail');

    Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');


//
Route::get('student-class', [StudentDashboardController::class, 'myClass']) 
    -> name('student.class');

    Route::get('student-diemdanh', [StudentDashboardController::class, 'diemdanh']) 
    -> name('student.diemdanh');

    Route::get('student-kqht', [StudentDashboardController::class, 'kqHT']) 
    -> name('student.kqht');

    Route::get('student-calendar', [StudentDashboardController::class, 'lichhoc']) 
    -> name('student.lichhoc');