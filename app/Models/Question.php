<?php

namespace App\Models;
use App\Models\Course;
use App\Models\Option;
use App\Models\Quizz;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = ['quiz_id', 'question_text', 'question_type', 'points', 'order', 'explanation'];

    public function quizz()
    {
        return $this->belongsTo(Quizz::class, 'quiz_id', 'id');
    }

    public function options()
{
    return $this->hasMany(Option::class);
}
}
