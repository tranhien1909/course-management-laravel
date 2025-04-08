<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;


class Classroom extends Model
{
    protected $table = 'classes';

    protected $primaryKey = 'id'; // Đảm bảo đúng tên trường
    public $incrementing = false; // Vì ID là chuỗi, không tự động tăng
    protected $keyType = 'string'; // Kiểu khóa là string

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

    // public function teacherUser()
    // {
    //     return optional($this->teacher)->user;
    // }
    
    // // Accessor to get the teacher's user info
    // public function getTeacherUserAttribute()
    // {
    //     return $this->teacher ? $this->teacher->user : null;
    // }
}

