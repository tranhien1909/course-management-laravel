<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationTarget extends Model
{
    protected $fillable = ['notification_id', 'user_id', 'class_id', 'course_id'];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
