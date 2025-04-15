<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTask extends Model
{
    protected $fillable = [
        'title',
        'note',
        'is_done',
    ];
}
