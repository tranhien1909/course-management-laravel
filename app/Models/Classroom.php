<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\ClassSchedule;


class Classroom extends Model
{
    protected $table = 'classes';

    protected $primaryKey = 'id'; // Đảm bảo đúng tên trường
    public $incrementing = false; // Vì ID là chuỗi, không tự động tăng
    protected $keyType = 'string'; // Kiểu khóa là string

    protected $fillable = [
        'id', // Thêm id vào danh sách fillable
        'course_id',
        'teacher_id',
        'start_date',
        'description',
        'number_of_student',
        'status'
    ];

    // Quan hệ với bảng teachers
    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Quan hệ với bảng courses
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // Quan hệ với bảng classe_schedules
    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class, 'class_id');
    }

    // Quan hệ với bảng enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'class_id', 'id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'class_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'class_id', 'student_id', 'id', 'student_id')
                    ->withPivot('status', 'enrollment_date', 'payment_id')
                    ->withTimestamps();
    }
}

