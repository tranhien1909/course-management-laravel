<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'student_id',
        'username',
        'fullname',
        'gender',
        'birthday',
        'email',
        'phone',
        'address',
        'password',
        'avatar',
        'role'
    ];
    
    // Thêm cast cho gender và role
    protected $casts = [
        'gender' => 'string',
        'role' => 'string'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Đặt tên bảng tương ứng với Model
    protected $table = 'users';

    // Relationship to Teacher
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id');
    }
}
