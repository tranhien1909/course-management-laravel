<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    protected $table = 'course_materials';

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'file_url',
        'uploaded_by'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

}
