<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\ClassSchedule;
use App\Models\Payment;
use App\Models\Attendance;
use App\Models\CourseMaterial;
use App\Models\Exam;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'student_id',
        'fullname',
        'gender',
        'birthday',
        'email',
        'phone',
        'address',
        'password',
        'avatar',
        'role'
    ];
    
    // Thêm cast cho gender và role
    protected $casts = [
        'gender' => 'string',
        'role' => 'string'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Đặt tên bảng tương ứng với Model
    protected $table = 'users';

    // Relationship to Teacher
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id');
    }

    // Quan hệ với bảng Enrollment
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    public function classes()
    {
        return $this->belongsToMany(Classroom::class, 'enrollments', 'student_id', 'class_id', 'student_id', 'id')
                    ->withPivot('status', 'enrollment_date', 'payment_id')
                    ->withTimestamps();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id', 'student_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'uploaded_by', 'id');
    }

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class, 'teacher_id');
    }

    public function grades()
    {
        return $this->hasMany(StudentGrade::class, 'student_id');
    }

}
