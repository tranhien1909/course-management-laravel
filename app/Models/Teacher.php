<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {
    // Đặt tên bảng tương ứng với Model
    protected $table = 'teachers';

    protected $primaryKey = 'id'; // Đảm bảo đúng tên trường
    public $incrementing = false; // Vì ID là chuỗi, không tự động tăng
    protected $keyType = 'string'; // Kiểu khóa là string

    // Quan hệ với bảng users
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // Quan hệ với bảng classes
    public function classes() {
        return $this->hasMany(ClassModel::class, 'teacher_id');
    }
}
