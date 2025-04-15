<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\ClassSchedule;
use App\Models\Enrollment; 

class StudentGrade extends Model
{
    protected $table = 'student_grades'; // Tên bảng trong cơ sở dữ liệu

    
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }


}
