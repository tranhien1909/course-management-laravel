<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\ClassSchedule;
use App\Models\Enrollment; 

class Exam extends Model
{
    protected $table = 'exams'; // Tên bảng trong cơ sở dữ liệu

    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

}
