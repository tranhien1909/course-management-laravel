<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // Đặt tên bảng tương ứng với Model
    protected $table = 'courses';

    protected $primaryKey = 'id'; // Đảm bảo đúng tên trường
    public $incrementing = false; // Vì ID là chuỗi, không tự động tăng
    protected $keyType = 'string'; // Kiểu khóa là string

    protected $fillable = [
        'description',
    ];

    // Quan hệ với bảng classes
    public function classes() {
        return $this->hasMany(Classroom::class, 'course_id');
    }

}
