<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {
    // Đặt tên bảng tương ứng với Model
    protected $table = 'teachers';

    // Relationship to User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // Relationship to Classes
    public function classes() {
        return $this->hasMany(ClassModel::class, 'teacher_id');
    }
}
