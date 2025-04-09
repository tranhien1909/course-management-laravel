<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\ClassSchedule;

class Teacher extends Model {
    // Đặt tên bảng tương ứng với Model
    protected $table = 'teachers';

    protected $primaryKey = 'id'; // Đảm bảo đúng tên trường
    public $incrementing = false; // Vì ID là chuỗi, không tự động tăng
    protected $keyType = 'string'; // Kiểu khóa là string

    protected $fillable = [
        'id',
        'user_id',
        'bio',
        'expertise',
        'joining_date',
        'status'
    ];

    // Quan hệ với bảng users
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // Quan hệ với bảng classes
    public function classes() {
        return $this->hasMany(Classroom::class, 'teacher_id');
    }

    // Quan hệ với bảng course_materials
    public function courseMaterials() {
        return $this->hasMany(CourseMaterial::class, 'uploaded_by');
    }

}
