<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\NotificationTargetController;
use App\Http\Controllers\Frontend\Teacher\TeacherDashboardController;
use App\Http\Controllers\Frontend\User\StudentDashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AdminTaskController;
use App\Http\Controllers\Frontend\AttendanceController;
use App\Http\Controllers\Backend\ScheduleController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\CourseMaterialController;
use App\Http\Controllers\Backend\QuizzController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Backend\ClassController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\SpendingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ConsultationController;
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

    Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');

Route::get('profile', [DashboardController::class, 'profile']) 
    -> name('dashboard.profile')
    ->middleware(AdminMiddleware::class);

    Route::get('statistical', [DashboardController::class, 'thongke']) 
    -> name('dashboard.thongke')
    ->middleware(AdminMiddleware::class);

// Auth routes - không yêu cầu đăng nhập
Route::middleware([RedirectIfAuthenticated::class])->group(function () {

    // Route hiển thị form đăng nhập (GET)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

    // Route xử lý đăng nhập (POST)
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
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

    // Ql người tư vấn
    Route::get('/consultations', [ConsultationController::class, 'index']) 
    -> name('consultations.index');

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

Route::put('/course_management/{id}', [CourseController::class, 'update'])->name('course.update');

Route::get('course-pdf', [CourseController::class, 'exportPDF'])->name('courseExport.pdf');

//QL tài liệu
Route::post('/course-materials', [CourseMaterialController::class, 'store'])->name('course-materials.store');
Route::resource('course-materials', CourseMaterialController::class)->only(['store']);

// QL bìa thi
// Hiển thị form tạo bài thi
Route::get('/exams/create/{course}', [QuizzController::class, 'create'])->name('quizzes.create');

// Lưu bài thi mới
Route::post('/exams/store', [QuizzController::class, 'store'])->name('quizzes.store');

Route::delete('/quizzes/{id}', [QuizzController::class, 'destroy'])->name('quizzes.destroy');

// Lưu câu hỏi vào bài thi
Route::get('/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('questions.store');
Route::delete('/quizzes/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');





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

    Route::put('/class_management/{id}', [ClassController::class, 'update'])->name('class.update');

Route::delete('/class_management/{class}', [ClassController::class, 'destroy'])->name('class.destroy');


Route::get('/class-pdf', [ClassController::class, 'exportPDF'])->name('classExport.pdf');

// Quản lý giảng viên
Route::get('teacher_management/index', [TeacherController::class, 'index']) 
    -> name('teacher.index')
    ->middleware(AdminMiddleware::class);

Route::post('/upload-temp-image', [TeacherController::class, 'uploadTempImage']);


Route::get('teacher_management/{id}', [TeacherController::class, 'detail'])->name('teacher.detail');

Route::post('teacher_management/store', [TeacherController::class, 'store'])
    ->name('teacher.store')
    ->middleware(AdminMiddleware::class);

Route::put('/teacher_management/{id}', [TeacherController::class, 'update'])->name('teacher.update');


Route::delete('/teacher/{class}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

Route::get('/teacher-pdf', [TeacherController::class, 'exportPDF'])->name('teacherExport.pdf');

// Quản lý học viên

    // GET
    Route::get('student_management/index', [UserController::class, 'index'])->name('student.index')->middleware(AdminMiddleware::class);
    Route::get('student_management/{id}', [UserController::class, 'detail'])->name('student.detail');
    
    Route::get('student_management/student-pdf', [UserController::class, 'exportPDF'])->name('studentExport.pdf');
    
    // POST
    Route::post('student_management/store', [UserController::class, 'store'])->name('student.store');
    
    // DELETE
    Route::delete('student_management/{id}', [UserController::class, 'destroy'])->name('student.destroy');

    Route::put('student_management/{id}', [UserController::class, 'update'])->name('student.update');



// Quản lý thu chi
Route::get('spending/index', [SpendingController::class, 'index']) 
-> name('spending.index')
->middleware(AdminMiddleware::class);

Route::get('spending/detail', [SpendingController::class, 'detail']) 
-> name('spending.detail')
->middleware(AdminMiddleware::class);

// Quản lý thông báo
// Route::prefix('admin')->middleware(['auth', 'can:admin'])->group(function () {
    // Hiển thị form gửi thông báo
    Route::get('/notifications', [NotificationController::class, 'create'])->name('admin.notifications.create');
    Route::post('/notifications/send', [NotificationController::class, 'send'])->name('admin.notifications.send');
    Route::put('/notifications/{id}', [NotificationController::class, 'update'])->name('notifications.update');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

// });

// QL Admin Task
Route::post('/admin/tasks/add', [DashboardController::class, 'addTask'])->name('admin.tasks.add');
Route::post('/admin/tasks/toggle/{id}', [DashboardController::class, 'toggleTask'])->name('admin.tasks.toggle');
Route::delete('/admin/tasks/{id}', [AdminTaskController::class, 'destroy'])->name('admin.tasks.destroy');



// Frontend Routes
Route::get('my-class', [TeacherDashboardController::class, 'myClass']) 
    -> name('teacher.class');

    Route::get('my-class/{id}', [TeacherDashboardController::class, 'detail']) 
    -> name('myclass.detail');

    Route::get('my-calendar', [TeacherDashboardController::class, 'teachingSchedule']) 
    -> name('teacher.lichhoc');

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

Route::put('/student/{id}', [StudentDashboardController::class, 'update'])->name('myself.update');


    Route::get('/class-schedule/week', [ScheduleController::class, 'loadWeek'])->name('schedule.week');

    Route::get('/teacher-schedule/week', [ScheduleController::class, 'loadTeacherWeek']);

    
