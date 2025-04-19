<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\ClassSchedule;
use App\Models\Payment;
use App\Models\courseMaterial;
use App\Models\Quizz;
use App\Models\Review;

class Course extends Model
{
    // Đặt tên bảng tương ứng với Model
    protected $table = 'courses';

    protected $primaryKey = 'id'; // Đảm bảo đúng tên trường
    public $incrementing = false; // Vì ID là chuỗi, không tự động tăng
    protected $keyType = 'string'; // Kiểu khóa là string

    protected $fillable = [
        'id',
        'course_name',
        'level',
        'lessons',
        'status',
        'price',
        'image',
        'description'
    ];

    // Quan hệ với bảng classes
    public function classes() {
        return $this->hasMany(Classroom::class, 'course_id');
    }

        // Quan hệ với bảng classes
        public function courseMaterials() {
            return $this->hasMany(courseMaterial::class, 'course_id');
        }

        public function payments()
    {
        return $this->hasMany(Payment::class, 'course_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quizz::class, 'course_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'course_id');
    }

}
