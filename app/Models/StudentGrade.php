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

    protected $fillable = [
        'student_id', 'class_id',
        'grade_1', 'grade_2', 'grade_3',
        'note'
    ];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }


}
