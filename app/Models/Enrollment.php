<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\ClassSchedule;

class Enrollment extends Model
{
    protected $table = 'enrollments'; // Tên bảng trong cơ sở dữ liệu

    // Quan hệ với bảng classes
    public function class()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

}
