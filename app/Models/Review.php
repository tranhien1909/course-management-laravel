<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\User;

class Review extends Model
{
    protected $table = 'course_reviews';
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
