<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\ClassSchedule;

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

}
