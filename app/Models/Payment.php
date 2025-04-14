<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\ClassSchedule;

class Payment extends Model {
    // Đặt tên bảng tương ứng với Model
    protected $table = 'payments';

    protected $fillable = [
        'course_id',
        'student_id',
        'amount',
        'payment_date',
        'payment_method',
        'status',
        'transaction_id',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

}
