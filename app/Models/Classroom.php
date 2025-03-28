<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = 'classes';

    protected $primaryKey = 'id'; // Đảm bảo đúng tên trường
    public $incrementing = false; // Vì ID là chuỗi, không tự động tăng
    protected $keyType = 'string'; // Kiểu khóa là string

    // Relationship to Teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function teacherUser()
    {
        return optional($this->teacher)->user;
    }
    
    // Accessor to get the teacher's user info
    public function getTeacherUserAttribute()
    {
        return $this->teacher ? $this->teacher->user : null;
    }
}

