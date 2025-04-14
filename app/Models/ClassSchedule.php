<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;

class ClassSchedule extends Model
{
    protected $table = 'class_schedules'; // Tên bảng trong cơ sở dữ liệu

        // Quan hệ với bảng classes
        public function class()
        {
            return $this->belongsTo(Classroom::class, 'class_id');
        }

        public function attendances()
    {
        return $this->hasMany(Attendance::class, 'schedule_id');
    }

        public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'schedule_id');
    }
}
