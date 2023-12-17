<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Task_User extends Pivot
{
    use HasFactory;

    protected $table = 'task_user';

    protected $fillable = [
        'user_id',
        'task_id',
        'time_spent',
        'activatedOn'
    ];
}
