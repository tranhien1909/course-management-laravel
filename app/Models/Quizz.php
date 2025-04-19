<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\ClassSchedule;
use App\Models\Enrollment; 

class Quizz extends Model
{
    protected $table = 'quizzes'; // Tên bảng trong cơ sở dữ liệu

    protected $fillable = [
        'course_id',
        'title',
        'instructions',
        'passing_score',
        'max_attempts',
        'is_shuffle_questions',
        'available_from',
        'uploaded_by',
        'available_to',
        'time_limit',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }




}
