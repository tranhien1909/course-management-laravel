<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'phone',
        'email',
        'course_interested',
        'message',
        'status'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_interested', 'id');
    }
}
