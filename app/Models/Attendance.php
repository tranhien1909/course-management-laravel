<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\ClassSchedule;
use App\Models\Classroom;



class Attendance extends Model
{
    protected $table = 'attendances';


    protected $fillable = [
'student_id', 'schedule_id', 'status', 'notes'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class, 'schedule_id');
    }
}

