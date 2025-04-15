<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['title', 'message', 'type', 'sender_id'];

    public function targets()
    {
        return $this->hasMany(NotificationTarget::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
