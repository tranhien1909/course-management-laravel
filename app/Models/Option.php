<?php

namespace App\Models;
use App\Models\Quizz;
use App\Models\Question;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['question_id', 'option_text', 'is_correct', 'order'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
